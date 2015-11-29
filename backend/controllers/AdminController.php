<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;


/**
 * Site controller
 */
class AdminController extends Controller
{
    /**
     * @inheritdoc
     */

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && $action->controller->action->id != 'login' ){
            $this->redirect('/backend/site/login',302);
            return false;
        }
        return true;
    }

}
