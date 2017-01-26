<?php


use app\assets\CategoriaAsset;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
CategoriaAsset::register($this);

$this->title = 'Categorias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-index">
    <div class="">
        Categorías
    </div>
    <?php foreach ($categorias as $categoria) {
    ?>
        <div class="">
            <a href=<?= Url::to(['entradas/index', 'categoria_id' => $categoria->id])?>><?= $categoria->nombre ?></a>
        </div>
    <?php

} ?>
</div>
