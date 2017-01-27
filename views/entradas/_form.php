<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="entrada-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'texto')->textarea(['maxlength' => true, 'rows' => 5]) ?>
    <!-- , ['itemOptions' => ['class' => 'prueba']] -->
    <?= $form->field($model, 'categoria_id')->radioList($categorias)->label('Elige una categoria') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Enviar' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
