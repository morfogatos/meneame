<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\ActiveForm;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Menéame',
        'brandUrl' => Yii::$app->homeUrl,
        'brandOptions' => [
            'class' => 'blancoBrand'
        ],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top fondoNav',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            Yii::$app->user->isGuest ?
            ['label' => 'Login', 'url' => ['/user/security/login'], 'linkOptions' => ['class' => 'blanco']]:
            [
                'label' => Html::img(Yii::getAlias('@uploads/') . '1.jpg', ['class' => 'img-rounded little']),
                'url' => ['/user/profile/show', 'id' => Yii::$app->user->id],
                'encode' => false,
                'items' => [
                    [
                       'label' => 'Mi Perfil',
                       'url' => ['/user/profile/show', 'id' => Yii::$app->user->id],
                    ],
                    [
                       'label' => 'Configuración',
                       'url' => ['/user/settings/profile', 'id' => Yii::$app->user->id]
                    ],
                    '<li class="divider"></li>',
                    [
                       'label' => 'Logout',
                       'url' => ['/user/security/logout'],
                       'linkOptions' => ['data-method' => 'post'],
                    ],
                ],
            ],
            ['label' => 'Registrarse', 'url' => ['/user/registration/register'], 'linkOptions' => ['class' =>'blanco'],'visible' => Yii::$app->user->isGuest]
        ],
    ]);
    $form = ActiveForm::begin(['action' =>  ['entradas/search'], 'method' => 'get', 'options' => ['class' => 'navbar-form','role' => 'search']]);?>
        <div class="input-group">
            <div class="input-group-btn">
                <input type="text" class="form-control" placeholder="Search" name="q">
                <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
        </div>
    <?php ActiveForm::end();
    NavBar::end();
    NavBar::begin([
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-lower lower',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => [
            ['label' => 'Cultura', 'url' => ['/entradas/index', 'categoria_id' => 1], 'linkOptions' => ['class' => 'blanco']],
            ['label' => 'Deporte', 'url' => ['/entradas/index', 'categoria_id' => 2], 'linkOptions' => ['class' => 'blanco']],
            ['label' => 'Política', 'url' => ['/entradas/index', 'categoria_id' => 3], 'linkOptions' => ['class' => 'blanco']],
            ['label' => 'Actualidad', 'url' => ['/entradas/index', 'categoria_id' => 4], 'linkOptions' => ['class' => 'blanco']],
            ['label' => 'Videojuegos', 'url' => ['/entradas/index', 'categoria_id' => 5], 'linkOptions' => ['class' => 'blanco']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
