<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
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
                'username',
                [
                    'format'=>'raw',
                    'headerOptions' => ['style'=>'text-align:center;width:20px;'],
                    'value'=>function($data) {
                        return Html::a('<i class="glyphicon glyphicon-lock"></i>',['user/set-password','id'=>$data->id],['data-toggle'=>'tooltip','title'=>'Set Password']);
                    }
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
<?php Pjax::end(); ?></div>
