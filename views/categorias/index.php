<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\assets\CategoriaAsset;
use Yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CategoriaAsset::register($this);

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">

    <!--<h1> Html::encode($this->title)</h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!-- <p>
        Html::a('Create Categoria', ['create'], ['class' => 'btn btn-success'])
        </p>
        GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);-->
    <table>
        <th>
            Categorías
        </th>
        <?php foreach ($model as $categoria) { ?>
            <tr>
                <td>
                    <a href=<?= Url::to(['entradas/index', 'categoria_id' => $categoria->id])?>><?= $categoria->nombre ?></a>
                </td>
            </tr>
        <?php } ?>
    </table>

</div>
