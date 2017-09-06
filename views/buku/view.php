<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\components\Helper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Buku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (User::isPetugas()){ ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Apakah Kamu Ingin Mengahapus Data?',
                'method' => 'post',
            ],
        ]) ?>
        <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'id_pengarang',
                'value' => function($data){
                    return $data->getRelationField("pengarang","nama");
                }
            ],
            'nama',
            [
                'attribute' => 'gambar',
                'format' => 'raw',
                'value' => $model->getGambar(['width'=>'50px']),
            ],
            [
                'attribute' => 'tanggal_terbit',
                'value' => function($data){
                    return Helper::getTanggalSingkat($data->tanggal_terbit);
                },
                'options' => ['style' => 'width: 200px'],
            ],
            [
                'attribute' => 'id_kategori',
                'value' => function($data){
                    return $data->getRelationField("kategori","nama");
                }
            ],
        ],
    ]) ?>

</div>
