<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */

$this->title = 'Enviar Entrada';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrada-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'entrada' => $entrada,
        'categorias' => $categorias,
        'etiquetas' => $etiquetas,
    ]) ?>

</div>
