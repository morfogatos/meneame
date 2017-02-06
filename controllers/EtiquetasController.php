<?php

namespace app\controllers;

use Yii;
use app\models\Etiqueta;
use app\models\EtiquetaSearch;
use phpDocumentor\Reflection\Types\Integer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EtiquetasController implementa las acciones CRUD para el modelo Etiqueta.
 */
class EtiquetasController extends Controller
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
     * Lista todos los modelos Etiqueta.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EtiquetaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra un modelo Etiqueta.
     * @param Integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Crea un nuevo modelo Etiqueta.
     * Si la creación es exitosa, el navegador será redireccionado a la página 'view'.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Etiqueta();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Actualiza un modelo Etiqueta existente.
     * Si la actialización es exitosa, el navegador será redireccionado a la página 'view'.
     * @param Integer $id
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
     * Borra un modelo Etiqueta existente.
     * Si la actialización es exitosa, el navegador será redireccionado a la página 'index'.
     * @param Integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo Etiqueta basado en el valor de su clave primaria.
     * Si el modelo no es encontrado, una excepcion 404 HTTP será lanzada.
     * @param Integer $id
     * @return Etiqueta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Etiqueta::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
