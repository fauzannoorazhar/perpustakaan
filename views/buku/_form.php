<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Kategori;
use app\models\Pengarang;
use app\models\Penerbit;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="buku-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype'=> 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id_pengarang')->widget(select2::className(), [
        'data' => Pengarang::getPengarang(),
        'options' => [
            'placeholder' => 'Pilih pengarang',
        ]
    ]) ?>

    <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_terbit')->widget(DatePicker::ClassName(),[
        'options' => ['placeholder' => 'Pilih Tanggal'],
        'pluginOptions' => [
        'format' => 'dd-mm-yyyy',
        'autoclose' =>true
        ]
    ]) ?>

    <?= $form->field($model, 'id_kategori')->widget(select2::className(), [
        'data' => Kategori::getList(),
        'options' => [
            'placeholder' => 'Pilih Kategori',
        ]
   ])  ?>

    <!-- Form Untuk Upload File -->
    <?= $form->field($model, 'gambar')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
