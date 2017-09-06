<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    <?php if(User::isPetugas()){ ?>
        <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Tambah Kategori', ['create'], ['class' => 'btn btn-primary']) ?>
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
            'class' => 'yii\grid\ActionColumn',
            'template' => User::isPetugas() ? '{view} {update} {delete}' : '{view}',
            ],
        ],
    ]); ?>
</div>
