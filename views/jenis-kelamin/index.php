<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisKelaminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Kelamins';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-kelamin-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jenis Kelamin', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
            'header' => 'No',
            'class' => 'yii\grid\SerialColumn',
            ],

            'nama',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
