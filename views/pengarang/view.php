<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\JenisKelamin;
use app\components\Helper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Pengarang */

$this->title = $model->nama;        
$this->params['breadcrumbs'][] = ['label' => 'Pengarang', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengarang-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if(User::isPetugas()){ ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
            [
            'attribute' => 'gambar',
            'format' => 'raw',
            'value' => $model->getGambar(['width'=>'50px']),
            ],
            [
                'attribute' => 'id_jenis_kelamin',
                'value' => function($data){
                    return $data->getRelationField('jenisKelamin','nama');
                },
                'filter' =>JenisKelamin::getJenisKelamin(),
            ],
            [
                'attribute' => 'tanggal_lahir',
                'value' => function($data){
                    return Helper::getTanggal($data->tanggal_lahir);
                },
            ],
        ],
    ]) ?>

    <h4>Buku Karangan <?= $model->nama ?></h4>

    <table class="table table-bordered table-striped table-condensed">
        <tr>
            <th style="word-break:break-all; width:100px;">No</th>
            <th>Judul Buku</th>
        </tr>
        <?php $i = 1; foreach ($model->bukus as $bukus) { ?>
        <tr>
            <td><?= $i++ ?></td>
            <td><?= $bukus->nama ?></td>
        </tr>
        <?php } ?>
    </table>

</div>
