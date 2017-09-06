<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\pengarang;
use app\models\Kategori;
use app\models\Buku;
use app\models\User;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buku';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php if (User::isPetugas()){ ?>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Buku', ['create'], ['class' => 'btn btn-primary']) ?>
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
            'options' => ['style' => 'width: 50px'],
            ],
            'nama', 
            [
                'attribute' => 'id_pengarang',
                'value' => function($data){
                    return $data->getRelationField('pengarang','nama');
                },
                'filter' =>Pengarang::getPengarang(),
            ],
            [
                'attribute' => 'id_kategori',
                'value' => function($data){
                    return $data->kategori->nama;
                },
                'filter'=>Kategori::getList(),
                'options' => ['style' => 'width: 200px'],
            ],
            [
                'attribute' => 'tanggal_terbit',
                'value' => function($data){
                    return Helper::getTanggal($data->tanggal_terbit);
                },
                'options' => ['style' => 'width: 200px'],
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
                'template' => User::isPetugas() ? '{view} {update} {delete}' : '{view}',
            ],
        ],
    ]); ?>
</div>

<div id="grafik"></div>

<script>
    FusionCharts.ready(function () {
    var revenueChart = new FusionCharts({
        type: 'column3d',
        renderAt: 'grafik',
        width: '100%',
        height: '300',
        dataFormat: 'json',
        dataSource: {
            "chart": {
                "caption": "Grafik Buku",
                "subCaption": "Perpustakaan",
                "xAxisName": "Kategori",
                "yAxisName": "Revenues (In USD)",
                "paletteColors": "#0075c2",
                "valueFontColor": "#ffffff",
                "baseFont": "Helvetica Neue,Arial",
                "captionFontSize": "14",
                "subcaptionFontSize": "14",
                "subcaptionFontBold": "0",
                "placeValuesInside": "1",
                "rotateValues": "1",
                "showShadow": "0",
                "divlineColor": "#999999",               
                "divLineIsDashed": "1",
                "divlineThickness": "1",
                "divLineDashLen": "1",
                "divLineGapLen": "1",
                "canvasBgColor": "#ffffff"
            },

            "data": [
                <?= Buku::getGrafik(); ?>
            ]
        }
    });
        revenueChart.render();
    });
    </script>