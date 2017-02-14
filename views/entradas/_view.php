<?php
use yii\helpers\Html;
use yii\helpers\Url;

$url = Url::to(['/entrada/meneo']);
$js = <<<EOT
    $('.menear' + '$model->id').on("click", function() {
        $.ajax({
            method: 'POST',
            url: '$url',
            data: {
                id: '$model->id'
            },
            success: function (data, status, event) {
                var d = JSON.parse(data);
                $('#numMeneos' + '$model->id').text(d + (d == 1 ? ' meneo' : ' meneos'));
                $('.menear' + '$model->id').attr('disabled', 'disabled').text('¡Hecho!');
            }
        });
    });
EOT;
$this->registerJs($js);

?>

<article class="articulo" data-key="<?= $model->id; ?>">
    <aside id="menealo">
        <p id="numMeneos<?= $model->id ?>"><?= $model->numeroMeneos ?> <?= $model->numeroMeneos == 1 ? 'meneo' : 'meneos' ?></p>
        <?php if (!Yii::$app->user->isGuest && $model->esMeneador(Yii::$app->user->identity->id)) :
            echo Html::submitButton('¡Hecho!', ['class' => 'btn btn-primary disabled']);
            else :
                echo Html::submitButton('¡Menéalo!', ['class' => 'menear' . $model->id . ' btn btn-primary']);
        endif; ?>
    </aside>
    <section class="entrada">
        <h2 class="title">
            <?= Html::a(Html::encode($model->titulo), $model->url, ['titulo' => $model->titulo]) ?>
        </h2>
        <p><?= Html::img($model->usuario->getAvatar(), ['width' => 25, 'height' => 25, 'class' => 'img-circle']) ?>
            por <?= Html::a(Html::encode($model->usuario->username), Url::to(['/user/' . $model->usuario_id])) ?>
            el <?= Yii::$app->formatter->asDate($model->created_at) ?>
            publicado: <?= Yii::$app->formatter->asRelativeTime($model->created_at) ?> </p>
            <p><?= Html::encode($model->texto) ?></p>
            <?= Html::a(Html::encode($model->getComentarios() . ' comentarios'), Url::to(['/entradas/view', 'id' => $model->id])) ?>
    </section>
</article>
