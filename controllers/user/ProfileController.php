<?php

namespace app\controllers\user;

use app\models\EntradaSearch;
use dektrium\user\controllers\ProfileController as BaseProfileController;
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
        $searchModel = new EntradaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $model = new UploadForm;

        if (Yii::$app->request->isPost) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            $model->upload();
        }

        $profile = $this->finder->findProfileById($id);

        if ($profile === null) {
            throw new NotFoundHttpException();
        }

        return $this->render('show', [
            'profile' => $profile,
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}
