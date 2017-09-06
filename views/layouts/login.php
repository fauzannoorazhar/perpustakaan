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
$this->registerCssFile(Yii::$app->request->baseUrl.'/css/login.css');
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
                <div class="container">
                    <?php
                    foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
                    }
                    ?>
                        <?= $content ?>
                </div>
            </div>

        <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
