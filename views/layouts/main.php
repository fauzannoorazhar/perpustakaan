<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\User;
use yii\bootstrap\ActiveForm;

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

<?php if(!Yii::$app->user->isGuest){ ?>

    <?php if(User::isPetugas()){ ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'Perpustakaan',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Buku', 'url' => ['/buku/index']],
                ['label' => 'Kategori', 'url' => ['/kategori/index']],
                ['label' => 'Pengarang', 'url' => ['/pengarang/index']],
                ['label' => 'Penerbit', 'url' => ['/penerbit/index']],
                ['label' => 'Pinjaman', 'url' => ['/pinjaman/index']],
                ['label' => 'Pengaturan', 'url' => ['/pengaturan/index']],
                ['label' => 'Anggota', 'url' => ['/anggota/index']],
                ['label' => 'Petugas', 'url' => ['/petugas/index']],
                ['label' => 'User', 'url' => ['/user/index']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>
    <?php } elseif (User::isAnggota()){ ?>
        <?php
        NavBar::begin([
            'brandLabel' => 'Perpustakaan',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                ['label' => 'Buku', 'url' => ['/buku/index']],
                ['label' => 'Kategori', 'url' => ['/kategori/index']],
                ['label' => 'Pengarang', 'url' => ['/pengarang/index']],
                ['label' => 'Penerbit', 'url' => ['/penerbit/index']],
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
        NavBar::end();
        ?>
    <?php } ?>
<?php } else {  ?>
<?php } ?>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
            <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Perpustakaan <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
