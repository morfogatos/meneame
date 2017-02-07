<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-form">

    <?php $form = ActiveForm::begin(['id' => 'form-enviar']); ?>

    <?= $form->field($entrada, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($entrada, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($entrada, 'texto')->textarea(['maxlength' => true, 'rows' => 5]) ?>
    <!-- , ['itemOptions' => ['class' => 'prueba']] -->
    <?= $form->field($entrada, 'categoria_id')->radioList($categorias)->label('Elige una categoria') ?>

    <?= $form->field($etiquetas, 'nombre')->textInput(['maxlength' => true])->label('Pon etiquetas separadas por coma (Ej: ryan gosling, cine, pelicula)') ?>

    <div class="form-group">
        <?= Html::submitButton($entrada->isNewRecord ? 'Enviar' : 'Update', ['class' => $entrada->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
