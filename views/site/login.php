<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
?>

<div class="site-login">
    <div class="header-login" style="text-align: justify;"> 
        <p style="margin-bottom: -20px;">Sign In Form</p>
        <h1 style="font-size:32pt; letter-spacing:-3px;">PER<span style="color:yellow">PUSTAKAAN</span></h1>

         <?php $form = ActiveForm::begin([
            'id' => 'login-form',
            'layout' => 'horizontal',
            'fieldConfig' => [
                'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
                'labelOptions' => ['class' => 'col-lg-1 control-label'],
            ],
        ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
            ]) ?>

                <div class="col-lg-offset-1 col-lg-5">
                    <?= Html::submitButton('Masuk', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::a('Registrasi', ['site/register'], ['class' => 'btn btn-success btn-flat']); ?>
                </div>

        <?php ActiveForm::end(); ?>
    </div>
</div>


