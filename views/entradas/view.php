<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Entrada */

$this->title = $model->titulo;
$this->params['breadcrumbs'][] = ['label' => 'Entradas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="entrada-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'url:url',
            'titulo',
            'texto',
            'created_at:datetime',
            [
                'label' => 'Categoría',
                'attribute' => 'categoria.nombre',
            ]
        ],
    ]) ?>

    <?php echo \yii2mod\comments\widgets\Comment::widget([
      'model' => $model,
      'maxLevel' => 2,
      // set `pageSize` with custom sorting
      'dataProviderConfig' => [
          'sort' => [
              'attributes' => ['id'],
              'defaultOrder' => ['id' => SORT_DESC],
          ],
          'pagination' => [
              'pageSize' => 10
          ],
      ],
       // your own config for comments ListView, for example:
      'listViewConfig' => [
          'emptyText' => Yii::t('app', 'No comments found.'),
      ]
]); ?>

</div>
