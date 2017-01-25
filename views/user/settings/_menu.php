<?php

use app\models\UploadForm;
use yii\helpers\Html;
use yii\widgets\Menu;
use yii\widgets\ActiveForm;

/**
 * @var dektrium\user\models\User $user
 */
$model = new UploadForm;
$user = Yii::$app->user->identity;
$networksVisible = count(Yii::$app->authClientCollection->clients) > 0;
?>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?= Html::img($user->profile->getAvatar(), [
                'class' => 'img-rounded little',
                'alt' => $user->username,
            ]) ?>
            <?= $user->username ?>
        </h3>
    </div>
    <div class="panel-body">
        <?= Menu::widget([
            'options' => [
                'class' => 'nav nav-pills nav-stacked',
            ],
            'items' => [
                ['label' => Yii::t('user', 'Profile'), 'url' => ['/user/settings/profile']],
                ['label' => Yii::t('user', 'Account'), 'url' => ['/user/settings/account']],
            ],
        ]) ?>
    </div>
</div>
<?= Html::img($user->profile->avatar, [
    'class' => 'img-thumbnail imagen',
    'alt' => $user->username,
]) ?>
<?php $form = ActiveForm::begin() ?>
    <?= $form->field($model, 'imageFile')->fileInput(['class' => 'avatar'])->label(false) ?>
    <button class="botonCambiar upload btn btn-info">Cambiar el avatar</button>
<?php ActiveForm::end() ?>
