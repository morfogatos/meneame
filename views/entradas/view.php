<?php

use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrada-view">

    <article class="entrada" data-key="<?= $model->id; ?>"style="font-size: 20px; font-family: Verdana;" >
        <h2 class="title" >
        <?= Html::a(Html::encode($model->titulo), $model->url, ['titulo' => $model->titulo]) ?>
        </h2>
        <p>por <?= $model->usuario->username ?> el <?= Yii::$app->formatter->asDate($model->created_at) ?>
        publicado <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?> </p>
        <p><?= Html::encode($model->texto) ?></p>
        <?php foreach ($model->etiquetas as $etiqueta) : ?>
            <?= Html::a(Html::encode($etiqueta->nombre), Url::to(['/entrada/etiqueta/' . $etiqueta->id])) ?>
        <?php endforeach ?>

    </article>

    <?php if ($model->usuario->id == Yii::$app->user->id) : ?>
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p> <?php endif ?>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
        'model' => $model,
        'maxLevel' => 2,
        // set `pageSize` with custom sorting
        'dataProviderConfig' => [
            'sort' => [
                'attributes' => ['id'],
                'defaultOrder' => ['id' => SORT_ASC],
            ],
            'pagination' => [
                'pageSize' => 10
            ],
        ],
        // your own config for comments ListView, for example:
        'listViewConfig' => [
            'emptyText' => Yii::t('app', 'Ningún comentario encontrado.'),
        ]
    ]); ?>

</div>
