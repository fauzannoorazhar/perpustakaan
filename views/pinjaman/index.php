<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Anggota;
use app\models\Buku;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PinjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pinjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Pinjaman', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
<?php Pjax::begin(); ?>    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
            'class' => 'yii\grid\SerialColumn',
            'header' => 'No',
            ],
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>