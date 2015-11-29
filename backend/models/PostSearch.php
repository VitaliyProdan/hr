<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;

/**
 * PostSeatch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'content', 'created_at','category_id', 'created_by'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Post::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params))) {
            $query->joinWith('category');
            $query->joinWith('user');
            return $dataProvider;
        }


        $query->andFilterWhere(['like', 'post.title', $this->title]);
        $query->joinWith(['category' => function ($q) {
            $q->where('category.title LIKE "%' . $this->category_id . '%"');
        }]);
        $query->joinWith(['user' => function ($q) {
            $q->where('user.username LIKE "%' . $this->created_by . '%"');
        }]);


        return $dataProvider;

    }
}
