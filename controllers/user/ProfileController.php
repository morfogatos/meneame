<?php

namespace app\controllers\user;

use app\models\Entrada;
use dektrium\user\controllers\ProfileController as BaseProfileController;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use app\models\UploadForm;
use Yii;
use yii\web\UploadedFile;

class ProfileController extends BaseProfileController
{

/**
 * Shows user's profile.
 *
 * @param int $id
 *
 * @return \yii\web\Response
 * @throws \yii\web\NotFoundHttpException
 */

    public function actionShow($id)
    {
        $dataProvider =  new ActiveDataProvider([
            'query' => Entrada::find()->where(['usuario_id' => $id])->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        $model = new UploadForm;

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
        }

        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        $suPerfil = Yii::$app->user->id === $profile->user_id;

        return $this->render('show', [
            'profile' => $profile,
            'model' => $model,
            'dataProvider' => $dataProvider,
            'suPerfil' => $suPerfil,
        ]);
    }
}
