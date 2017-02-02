<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<article class="entrada" data-key="<?= $model->id; ?>">
    <h2 class="title">
    <?= Html::a(Html::encode($model->titulo), $model->url, ['titulo' => $model->titulo]) ?>
    </h2>
    <p><?= Html::img($model->usuario->getAvatar(), ['width' => 25, 'height' => 25, 'class' => 'img-circle']) ?>
         por <?= Html::a(Html::encode($model->usuario->username), Url::to(['/user/' . $model->usuario_id])) ?> 
         el <?= Yii::$app->formatter->asDate($model->created_at) ?>
    publicado: <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?> </p>
    <p><?= Html::encode($model->texto) ?></p>

    <?= Html::a(Html::encode($model->getComentarios() . ' comentarios'), Url::to(['entradas/view', 'id' => $model->id])) ?>
</article>
