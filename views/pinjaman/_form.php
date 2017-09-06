<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\select2;
use app\models\Anggota;
use app\models\Pinjaman;
use app\models\Buku;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Pinjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pinjaman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_anggota')->widget(select2::className(), [
        'data' => Anggota::getAnggota(),
        'options' => [
            'placeholder' => 'Pilih Anggota',
        ]
    ]) ?>

    <?= $form->field($model, 'id_buku')->widget(select2::className(),[
        'data'=> Buku::getBuku(),
        'options' => [
            'placeholder' => 'Nama Buku',
        ]
    ]) ?>

    <?= $form->field($model, 'tanggal_peminjaman')->widget(DatePicker::ClassName(),[
        'options' => ['placeholder' => 'Pilih Tanggal'],
        'pluginOptions' => [
        'format' => 'yyyy-mm-dd',
        'autoclose' =>true
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Save' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    
</script>
