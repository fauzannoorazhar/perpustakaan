<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Set Password User';

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    
    <div class="box box-primary">
        <div class="box-header">
            <h3 class="box-title">Form Set Password User</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <?php $form = ActiveForm::begin([            
                    'layout'=>'horizontal',
                    'fieldConfig' => [
                    'horizontalCssClasses' => [
                        'label' => 'col-sm-3',
                        'wrapper' => 'col-sm-5',
                        'error' => '',
                        'hint' => '',
                ],
                ]]); ?>

                <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'password_konfirmasi')->passwordInput(['maxlength' => true]) ?>

                <div class="col-sm-offset-3 col-sm-3 ">
                    <?= Html::submitButton('<i class="fa fa-check"></i> Set Password', ['class' => 'btn btn-success btn-flat', 'name' => 'register-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
