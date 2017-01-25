<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<article class="item" data-key="<?= $model->id; ?>">
    <h2 class="title">
    <?= Html::a(Html::encode($model->titulo), Url::toRoute(['entradas/view', 'id' => $model->id]), ['titulo' => $model->titulo]) ?>
    </h2>
    <p><?= Html::encode($model->texto) ?></p>
</article>
