<?php

namespace app\controllers;

use Yii;
use app\models\Entrada;
use app\models\Categoria;
use app\models\EntradaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;

/**
 * EntradasController implements the CRUD actions for Entrada model.
 */
class EntradasController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Entrada models.
     * @return mixed
     */
    public function actionIndex($categoria_id = null)
    {
        $searchModel = new EntradaSearch();
        if ($categoria_id != null) {
            $dataProvider = new ActiveDataProvider([
                'query' => Entrada::find()->where(['categoria_id' => $categoria_id])->orderBy(['created_at' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);
        } else {
            $dataProvider = new ActiveDataProvider([
                'query' => Entrada::find()->orderBy(['created_at' => SORT_DESC]),
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Entrada model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Entrada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Entrada();
        $categorias = Categoria::find()->select('nombre')->indexBy('id')->column();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'categorias' => $categorias,
            ]);
        }
    }

    /**
     * Updates an existing Entrada model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Entrada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Entrada model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Entrada the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Entrada::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
