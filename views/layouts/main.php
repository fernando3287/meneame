<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
    Yii::$app->homeUrl = ['site/index'];
    NavBar::begin([
        'brandLabel' => 'Meneame',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $items = [
        //['label' => 'Noticias', 'url' => ['/noticias/index']],
        //    ['label' => 'Comentarios', 'url' => ['/comentarios/index']],
            // ['label' => 'Usuarios', 'url' => ['/usuarios/index']],
            // ['label' => 'Tipos de Noticias', 'url' => ['/tipo-noticias/index']],

            // Yii::$app->user->isGuest ? (
            //     ['label' => 'Login', 'url' => ['/site/login']]
            // ) : (
            //     '<li>'
            //     . Html::beginForm(['/site/logout'], 'post')
            //     . Html::submitButton(
            //         'Logout (' . Yii::$app->user->identity->nombre . ')',
            //         ['class' => 'btn btn-link logout']
            //     )
            //     . Html::endForm()
            //     . '</li>'
            // )
            Yii::$app->user->isGuest ?
            [
                'label' => 'Usuarios',
                'items' => [
                    ['label' => 'Login', 'url' => ['/site/login']],
                    '<li class="divider"></li>',
                    ['label' => 'Registrarse', 'url' => ['usuarios/create']],
                ]
            ] :
            [
                'label' => 'Usuarios (' . Yii::$app->user->identity->nombre . ')',
                'items' => [
                    [
                        'label' => 'Logout',
                        'url' => ['site/logout'],
                        'linkOptions' => ['data-method' => 'POST']
                    ],
                    '<li class="divider"></li>',
                    ['label' => 'Ver datos', 'url' => ['usuarios/view']],
                ]
            ]
    ];
    if (Yii::$app->user->esAdmin) {
        array_unshift($items, ['label' => 'Usuarios', 'url' => ['usuarios/index']]);
        array_unshift($items, ['label' => 'Tipos de Noticias', 'url' => ['tipo-noticias/index']]);
        array_unshift($items, ['label' => 'Noticias', 'url' => ['/noticias/index']]);
        array_unshift($items, ['label' => 'Comentarios', 'url' => ['/comentarios/index']]);
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $items,
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
