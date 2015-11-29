<?php
namespace backend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use backend\models\PasswordResetRequestForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;
use common\models\LoginForm;
use yii\filters\VerbFilter;
use common\models\Category;
use common\models\Post;
use common\models\Tag;
/**
 * Site controller
 */
class SiteController extends AdminController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['*'],
                'rules' => [
                    [
                        'actions' => ['*'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        $lastPosts = Post::find()->orderBy('created_at desc')->limit(10)->all();
        $featured = Post::featured();
        $drafts = Post::drafts();
        $mostPopularCategory = Category::find()
            ->joinWith('posts')
            ->select('category.id, post.category_id, count(distinct post.title) as qty, category.title')
            ->groupBy('post.category_id')
            ->orderBy('qty desc')
            ->one();
        $mostPopularTag = Tag::find()
            ->joinWith('posts')
            ->select('tags.id, posts_tags.tag_id, count(distinct posts_tags.post_id) as qty, tags.title')
            ->groupBy('posts_tags.tag_id')
            ->orderBy('qty desc')
            ->one();
        $postsCount = Post::find()->where('active = 1')->count();
        $categoryCount = Category::find()->count();

        return $this->render('index', [
            'lastPosts' => $lastPosts,
            'featured' => $featured,
            'drafts' => $drafts,
            'mostPopularCategory' => $mostPopularCategory,
            'mostPopularTag' => $mostPopularTag,
            'postsCount' => $postsCount,
            'categoryCount' => $categoryCount
        ]);

    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $this->redirect('/backend/site/login',302);
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'New password was saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


}
