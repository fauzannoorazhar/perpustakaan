<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use app\models\JenisKelamin;
use kartik\select2\Select2;

?>

<?php $form = ActiveForm::begin([            
    'fieldConfig' => [
]]); ?>
<div class="module form-module" style="min-width: 380px">
        <div class="form">
            <h2 style="text-align: center">Pendaftaran Anggota</h2>

            <div class="row">
            	<div class="col-sm-4 col-sm-offset-4">

    		        <?= $form->field($model, 'nama')->textInput(['maxlength' => true]) ?>

    		        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

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
    		    </div>
    		</div>

            <div class="form-group" style="text-align: center">
                <?= Html::submitButton('Register', ['class' => 'btn btn-success']) ?>
            </div>

    </div>
</div>

        <?php ActiveForm::end(); ?>