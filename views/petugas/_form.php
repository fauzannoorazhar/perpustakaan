<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\JenisKelamin;

/* @var $this yii\web\View */
/* @var $model app\models\Petugas */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="petugas-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telepon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::ClassName(),[
        'options' => ['placeholder' => 'Pilih Tanggal'],
        'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' =>true
        ]
    ]) ?>

    <?= $form->field($model, 'id_jenis_kelamin')->widget(select2::className(), [
        'data' => JenisKelamin::getJenisKelamin(),
        'options' => [
            'placeholder' => 'Pilih Jenis Kelamin',
        ]
    ]) ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
