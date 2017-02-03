<?php

namespace app\controllers;

use Yii;
use app\models\Meneo;
use app\models\Entrada;
use app\models\Etiqueta;
use app\models\Categoria;
use phpDocumentor\Reflection\Types\String_;
use phpDocumentor\Reflection\Types\Integer;
use yii\filters\AccessControl;
use yii\helpers\Url;
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
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['admin'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['@', 'admin'],
                        'matchCallback' => function ($rule, $action) {
                            return Entrada::findOne(Yii::$app->request->get('id'))->usuario_id == Yii::$app->user->id;
                        },
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Entrada models.
     * @param Integer $categoria_id
     * @param Integer $etiqueta_id
     * @return mixed
     */
    public function actionIndex($categoria_id = null, $etiqueta_id = null)
    {
        if ($etiqueta_id != null) {
            $etiqueta = Etiqueta::find()->where(['id' => $etiqueta_id])->one();

            $dataProvider = new ActiveDataProvider([
                'query' => $etiqueta->getEntradas(),
                'pagination' => [
                    'pageSize' => 10,
                ]
            ]);
        } elseif ($categoria_id != null) {
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
            'dataProvider' => $dataProvider,
            'titulo' => null
        ]);
    }

    /**
     * Realiza el meneo a la entrada
     * @return [type] [description]
     */
    public function actionMeneo()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(Url::toRoute(['user/login']));
        }
        $entrada = $this->findModel(Yii::$app->request->get('submit'));

        $meneo = new Meneo;
        $meneo->usuario_id = Yii::$app->user->id;
        $meneo->entrada_id = $entrada->id;
        if (!Meneo::findOne(['entrada_id' => $meneo->entrada_id, 'usuario_id' => $meneo->usuario_id])) {
            $meneo->save();
        }
    }

    /**
     * Realiza la busqueda por titulo de las Entradas
     * @param  String_ $q la cadena que correspondera con la busqueda del titulo
     * @return mixed
     */
    public function actionSearch($q = null)
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Entrada::find()
                ->where(['ilike', 'titulo', $q])
                ->orderBy(['created_at' => SORT_DESC]),
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'titulo' => $q,
        ]);
    }

    /**
     * Displays a single Entrada model.
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
     * Creates a new Entrada model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $entrada = new Entrada;
        $etiquetas = new Etiqueta;
        $categorias = Categoria::find()->select('nombre')->indexBy('id')->column();

        if ($entrada->load(Yii::$app->request->post()) && $etiquetas->load(Yii::$app->request->post())) {
            if ($entrada->save()) {
                $etiquetas->guardar($entrada);
                return $this->redirect(['view', 'id' => $entrada->id]);
            }
        } else {
            return $this->render('create', [
                'entrada' => $entrada,
                'categorias' => $categorias,
                'etiquetas' => $etiquetas,
            ]);
        }
    }

    /**
     * Updates an existing Entrada model.
     * If update is successful, the browser will be redirected to the 'view' page.
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
     * Deletes an existing Entrada model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param Integer $id
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
     * @param Integer $id
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
