<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Pengarang;
use app\models\JenisKelamin;
use app\components\Helper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PengarangSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pengarang';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pengarang-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php if(User::isPetugas()){ ?>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Pengarang', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-print"></i> Ekspor Pdf Data Buku', ['ekspor-pdf'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="glyphicon glyphicon-file"></i> Ekspor Excel Data Buku', ['ekspor-excel'], ['class' => 'btn btn-info']) ?>
    <?php } ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'No',
            ],

            'nama',
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
            [
                'attribute' => 'gambar',
                'value' => function($data){
                    return $data->getGambar(['width'=> '40px']);
                },
                'format' => 'raw'
            ],

            [
            'class' => 'yii\grid\ActionColumn',
            'template' => User::isPetugas() ? '{view} {update} {delete}' : '{view}'
            ],
        ],
    ]); ?>
</div>
