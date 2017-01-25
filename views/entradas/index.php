<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Entradas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrada-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Entrada', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'options' => [
        'tag' => 'div',
        'class' => 'list-wrapper',
        'id' => 'list-wrapper',
        ],
        'layout' => "{items}\n{pager}",
        'itemView' => '_view.php',
    ]) ?>
</div>
