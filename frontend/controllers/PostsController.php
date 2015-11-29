<?php

namespace frontend\controllers;

use common\models\Tag;
use Yii;
use common\models\Category;
use common\models\Post;
use Exception;
use yii\data\Pagination;
use frontend\helpers\Utils;

class PostsController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;

    public function actionCategory($id)
    {
        $category = Category::findOne($id);
        if (!$category){
            throw new \yii\web\HttpException(400, 'Wrong category id', 405);
        }
        $query = Post::find()->where(['category_id' => $category->id]);
        $count = $query->count();
        if ($count == 1){
            return $this->redirect(array('posts/view','id'=>$query->all()[0]->id));
        }
        $countQuery = clone $query;
        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();
        return $this->render('category', [
            'category' => $category->title,
            'posts' => $posts,
            'pagination' => $pages,
        ]);
    }

    public function actionView($id)
    {
        $post = Post::findOne($id);
        if (!$post){
            throw new \yii\web\HttpException(400, 'Wrong post id', 405);
        }
        return $this->render('view', [
            'post' => $post,
        ]);
    }

    public function actionTag($ids){
        $arr_ids = explode('_', $ids);
        $tags = Tag::find()->all();

        $query = Post::find()->joinWith('tags')->where(['tags.id' => $arr_ids]);
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();
        return $this->render('category', [
            'ids' => $arr_ids,
            'tags' => $tags,
            'posts' => $posts,
            'pagination' => $pages,
        ]);

    }

    public function actionSearch()
    {
        $search = Yii::$app->request->post('query');
        $trans_search = Utils::encodestring($search);
        $query = Post::find()
            ->joinWith('tags')
            ->where(['like', 'post.content', $search])
            ->orWhere(['like', 'post.content', $trans_search])
            ->orWhere(['like', 'post.title', $search])
            ->orWhere(['like', 'post.title', $trans_search])
            ->orWhere(['like', 'tags.title', $search])
            ->orWhere(['like', 'tags.title', $trans_search]);
            //->all();
        $countQuery = clone $query;

        $pages = new Pagination(['totalCount' => $countQuery->count(), 'pageSize' => 10]);
        $pages->pageSizeParam = false;
        $posts = $query->offset($pages->offset)
            ->limit($pages->limit)
            ->orderBy('id desc')
            ->all();
        return $this->render('category', [
            'category' => 'Пошук: "' . $search . '"',
            'posts' => $posts,
            'pagination' => $pages,
            'search_query' => $search
        ]);

    }

    public function actionAdd_tag($id){
        try{
            $url = Yii::$app->request->getReferrer();
            $url = explode('ids=', $url);
            $ids = explode('_', end($url)) ? explode('_', end($url)) : end($url);
            if (in_array($id,$ids)){
                unset($ids[array_search($id, $ids)]);
            }else{
                array_push($ids, $id);
            }
            $ids = implode('_', $ids);
            $url[0] .= 'ids='. $ids;
            return $this->redirect($url[0]);
        }catch (Exception $e){
            throw new \yii\web\HttpException(400, 'Помилка при обробці даних.', 405);
        }

    }



}
