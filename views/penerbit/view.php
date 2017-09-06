<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Buku;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Penerbit */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Penerbit', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penerbit-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if(User::isPetugas()) { ?>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    <?php } ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nama',
        ],
    ]) ?>
<h4>Buku Karangan <?= $model->nama ?></h4>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>No</th>
        <th>Nama</th>
    </tr>
    <?php $i=1; foreach (Buku::find()->where(['id_penerbit'=>$model->id])->all() as $data) { ?>
    <tr>
        <td><?php print $i; ?></td>
        <td><?php print Html::a($data->nama,['buku/view','id'=>$data ->id]) ?></td>
    </tr>
    <?php $i++; } ?>
</table>

</div>
