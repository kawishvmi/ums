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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Custom Navbar Styling */
        .navbar-custom {
            background-color: #2C3E50; /* Darker background */
            border-bottom: 3px solid #18BC9C; /* Green accent */
        }
        .navbar-custom .navbar-brand {
            font-weight: bold;
            color: #ffffff;
            font-size: 1.5rem;
            transition: color 0.3s;
        }
        .navbar-custom .navbar-brand:hover {
            color: #18BC9C; /* Hover color for the brand */
        }
        .navbar-custom .nav-link {
            color: #ffffff;
            font-size: 1.1rem;
            padding: 10px 20px;
            transition: color 0.3s, background-color 0.3s;
        }
        .navbar-custom .nav-link:hover {
            color: #18BC9C; /* Green accent on hover */
            background-color: rgba(0, 0, 0, 0.1); /* Slight dark hover background */
        }
        .navbar-custom .nav-item.active .nav-link {
            color: #18BC9C; /* Active state color */
        }
        .navbar-nav .show > .nav-link, .navbar-nav .nav-link.active {
            color: rgb(150 150 150) !important;
        }
    </style>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
<?php
 
    NavBar::begin([
        'brandLabel' => 'UMS4U Admin Dashboard',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar navbar-expand-md navbar-custom fixed-top'],
    ]);
    
    $menuItems = [];
    
    // Check if the user is logged in
    if (Yii::$app->user->isGuest) {
        // $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    } else {
        $auth = Yii::$app->authManager;
        $roles = $auth->getRolesByUser(Yii::$app->user->identity->id);
        $role = key($roles);
    
        // Check if the user is an admin
        if ($role === 'admin') {
            $menuItems[] = ['label' => 'Dashboard', 'url' => ['/admin/profile']];
            $menuItems[] = ['label' => 'Manage Users', 'url' => ['/admin/index']];
            // $menuItems[] = ['label' => 'Settings', 'url' => ['/admin/settings']]; will love to do that stuff !!!
        }
        // Common item for all logged-in users
        $menuItems[] = '<li class="nav-item">'
            . Html::beginForm(['/site/logout'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'nav-link btn btn-link logout text-white']
            )
            . Html::endForm()
            . '</li>';
    }
    
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav ms-auto'],
        'items' => $menuItems,
    ]);
    
    NavBar::end();
    ?>
    
?>


    <?php 
        // Include jQuery
        $this->registerJsFile('https://code.jquery.com/jquery-3.6.0.min.js', ['position' => \yii\web\View::POS_HEAD]);

        // Include Bootstrap JS
        $this->registerJsFile('https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js', ['position' => \yii\web\View::POS_HEAD]);
    ?>
</header>

<main id="main" class="flex-shrink-0 mt-5 pt-5" role="main">
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
            <div class="col-md-6 text-center text-md-start">&copy; UMS4u <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
