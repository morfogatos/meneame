<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EntradaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Menéame Doñana';
?>
<div class="entrada-index">

    <p>
        <?= Html::a('ENVIAR ENTRADA', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php if ($titulo !== null) : ?>
        <p>Buscando entradas por título: <?= $titulo ?></p>
    <?php endif ?>
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
