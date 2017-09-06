<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\JenisKelamin;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Anggota */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Anggotas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            'email',
            'alamat:ntext',
            [
            'attribute'=>'tanggal_lahir',
            'value'=>function($data){
                    return Helper::getTanggal($data->tanggal_lahir);
                },
            ],
            'telepon',
            [
                'attribute' => 'id_jenis_kelamin',
                'value' => function($data){
                    return $data->getRelationField('jenisKelamin','nama');
                },
                'filter' =>JenisKelamin::getJenisKelamin(),
            ],
        ],
    ]) ?>

</div>
