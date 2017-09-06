<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\select2;
use app\models\JenisKelamin;

/* @var $this yii\web\View */
/* @var $model app\models\Pengarang */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pengarang-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=> 'multipart/form-data']]); ?>
    
    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_jenis_kelamin')->widget(select2::className(), [
        'data' => JenisKelamin::getJenisKelamin(),
        'options' => [
            'placeholder' => 'Pilih Jenis Kelamin',
        ]
    ]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::ClassName(),[
    	'options' => ['placeholder' => 'Pilih Tanggal'],
    	'pluginOptions' => [
    	'format' => 'yyyy-mm-dd',
    	'autoclose' =>true
    	]
    ]) ?>

    <?= $form->field($model, 'gambar')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
