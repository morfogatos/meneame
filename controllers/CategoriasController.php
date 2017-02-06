<?php

namespace app\controllers;

use Yii;
use app\models\Categoria;
use app\models\CategoriaSearch;
use phpDocumentor\Reflection\Types\Integer;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * CategoriasController implementa las acciones CRUD para el modelo Categoria.
 */
class CategoriasController extends Controller
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
     * Lista todos los modelos Categoria.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = Categoria::find()->all();
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categorias' => $model,
        ]);
    }

    /**
     * Muestra un modelo Categoria.
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
     * Crea un nuevo modelo Categoria.
     * Si la creación es exitosa, el navegador será redireccionado a la página 'view'.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Categoria();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Actualiza un modelo Categoria existente.
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
     * Borra un modelo Categoria existente.
     * Si la actialización es exitosa, el navegador será redireccionado a la página 'view'.
     * @param Integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Busca el modelo Categoria basado en el valor de su clave primaria.
     * Si el modelo no es encontrado, una excepcion 404 HTTP será lanzada.
     * @param Integer $id
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Categoria::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
