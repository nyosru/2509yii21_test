<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);



    $menuItems = [
        ['label' => 'Главная', 'url' => ['/site/index']],
        ['label' => 'Продукты', 'url' => ['/product/index']],
        ['label' => 'Заказы', 'url' => ['/order/index']],
//        Yii::$app->user->isGuest
//            ? ['label' => 'Войти', 'url' => ['/site/login']]
//            : '<li class="nav-item">'
//            . Html::beginForm(['/site/logout'])
//            . Html::submitButton(
//                'Выйти (' . (Yii::$app->user->identity->username ?? 'x') . ')',
////                'Выйти (' . Yii::$app->user->identity->login . ')',
//                ['class' => 'nav-link btn btn-link logout']
//            )
//            . Html::endForm()
//            . '</li>'
    ];


    // если пользователь админ → добавляем пункт "Пользователи"
    if (!Yii::$app->user->isGuest && Yii::$app->user->identity->role === 'admin') {
        $menuItems[] = ['label' => 'Пользователи', 'url' => ['/user/index']];
    }

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Войти', 'url' => ['/site/login']];
    }
    else {
        $menuItems[] = '<li>'
            . \yii\helpers\Html::beginForm(['/site/logout'], 'post')
            . \yii\helpers\Html::submitButton(
                'Выйти (' . ( Yii::$app->user->identity->username ?? 'x' ) . ')',
                ['class' => 'nav-link btn btn-link logout']
            )
            . \yii\helpers\Html::endForm()
            . '</li>';
    }

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => $menuItems,
//        'items' => [
//            ['label' => 'Home', 'url' => ['/site/index']],
//            ['label' => 'About', 'url' => ['/site/about']],
//            ['label' => 'Contact', 'url' => ['/site/contact']],
//            Yii::$app->user->isGuest
//                ? ['label' => 'Login', 'url' => ['/site/login']]
//                : '<li class="nav-item">'
//                    . Html::beginForm(['/site/logout'])
//                    . Html::submitButton(
//                        'Logout (' . Yii::$app->user->identity->username . ')',
//                        ['class' => 'nav-link btn btn-link logout']
//                    )
//                    . Html::endForm()
//                    . '</li>'
//        ]
    ]);
    NavBar::end();
    ?>


    <?php


//    $items = [
//        ['label' => 'Home', 'url' => ['/site/index']],
//        ['label' => 'About', 'url' => ['/site/about']],
//        ['label' => 'Contact', 'url' => ['/site/contact']],
//    ];
//
//    if (!Yii::$app->user->isGuest) {
//        $items[] = ['label' => 'Table 1', 'url' => ['/table1/index']];
//        $items[] = ['label' => 'Table 2', 'url' => ['/table2/index']];
//
//        if (Yii::$app->user->identity->isAdmin()) {
//            $items[] = ['label' => 'Users', 'url' => ['/user/index']];
//        }
//    }
//
//    echo Nav::widget([
//        'items' => $items,
//        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-lg-0'], // Bootstrap 5 классы
//    ]);
    ?>


</header>


<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
