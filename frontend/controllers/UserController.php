<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $old_photo = $model->photo;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->setTagIds(Yii::$app->request->post('User')['tagIds']);
            $model->save();
            $this->savePhoto($model, $old_photo);
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function savePhoto($model, $old_photo=null){
        $photo = UploadedFile::getInstance($model, 'photo');

        if (!empty($photo)) {
            $path = realpath('.'.Yii::$app->params['photos_path']);
            if (!file_exists($path)){
                mkdir ($path);
            }
            $newPhotoName = '/photo_user_'. $model->id;
            $model->photo = Yii::$app->params['photos_path'] . $newPhotoName . '.' . $photo->extension;
            $photo->saveAs($path. '/' . $newPhotoName . '.' . $photo->extension);
        }elseif($_POST['User']['image_is_removed'] != 1){
            $model->photo = $old_photo;
        }
        $model->save();
    }
}
