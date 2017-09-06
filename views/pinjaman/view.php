<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Anggota;
use app\models\Buku;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $model app\models\Pinjaman */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Pinjaman', 'url' => ['pinjaman/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('kembalikan Buku',['pinjaman/pengembalian','id'=>$model->id],['class' => 'btn btn-success']); ?>
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
            [
                'attribute' => 'id_anggota',
                'value' => function($data){
                    return $data->getRelationField('anggota','nama');
                },
                'filter' =>Anggota::getAnggota(),
            ],
            [
                'attribute' => 'id_buku',
                'value' => function($data){
                    return $data->getRelationField('buku','nama');
                },
                'filter' =>Buku::getBuku(),
            ],
            [
                'attribute' => 'tanggal_peminjaman',
                'value' => function($data){
                    return Helper::getTanggal($data->tanggal_peminjaman);
                },
                'options' => ['style' => 'width: 200px'],
            ],
            [
                'attribute'=>'tanggal_pengembalian',
                'value'=> function($data){
                    return Helper::getTanggal($data->tanggal_pengembalian);
                },
                'options' => ['style' => 'width: 200px'],
            ],
            [
            'attribute'=>'status',
            'value'=>function($data){
                    return $data->getStatus();//Untuk memanggil method di sertakan objek nya dulu ($data)
                },
            ],
        ],
    ]) ?>

</div>
