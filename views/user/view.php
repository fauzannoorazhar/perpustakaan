<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'username',
            'password',
            'model',
            'id_model',
            'id_role',
            [
            'attribute'=>'id_status',
            'value'=>function($data){
                    return $data->getIdStatus();//Untuk memanggil method di sertakan objek nya dulu ($data)
                },
            ],
        ],
    ]) ?>

</div>

<div class="detail">
    
    <h4><?= $model->model ?></h4   >

    <table class="table table-bordered table-hover table-striped table-condensed">
        <tr>
            <th style="word-break:break-all; width:160px;">Nama</th>
            <td><?= $model->getRelationField($model->model,'nama'); ?></td>
        </tr>
            <th>Alamat</th>
            <td><?= $model->getRelationField($model->model,'alamat'); ?></td>
    </table>

</div>
