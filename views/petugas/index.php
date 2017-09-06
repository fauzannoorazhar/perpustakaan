<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\JenisKelamin;
use app\components\Helper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PetugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Petugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petugas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Petugas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    
     <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
            'header' => 'No',
            'class' => 'yii\grid\SerialColumn',
            ],
            'nama',
            /*'alamat:ntext',*/
            'telepon',
            [
            'attribute'=>'tanggal_lahir',
            'value'=>function ($data) {
                    return Helper::getTanggal($data->tanggal_lahir);
                },
            ],
            [
            'attribute'=>'id_jenis_kelamin',
            'value' => function($data){
                    return $data->getRelationField('jenisKelamin','nama');
                },
                'filter' => JenisKelamin::getJenisKelamin(),
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>