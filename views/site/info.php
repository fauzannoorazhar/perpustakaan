 <?php

use app\models\Buku;
use app\models\Pengarang;
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['buku/create'], ['class'=>'btn btn-success']) ?>
    <div>&nbsp;</div>
    <table class="table table-hover">
        <tr>
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Nama Pengarang</th>
            <th>Nama Penerbit</th>
            <th>Action</th>
        </thead>
        </tr>
        <?php $i=1; foreach(Buku::find()->where(['nama' => 'Belajar Gitar'])->all() as $data) { ?>
        <tr>
            <td><?php print $i; ?> </td>
            <td><?php print $data->nama; ?></td>
            <td><?php print $data->getRelationField("pengarang","nama"); ?></td>
            <td><?php print $data->getRelationField("penerbit","nama"); ?></td>
            <td>
            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['buku/update','id'=>$data->id]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['buku/view','id'=>$data->id]) ?> 
            <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['buku/delete', 'id' => $data->id], [
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
        <?php $i++ ; } ?> 
    </table>  

<?php //print Buku::getNama('Dadan'); ?>
</div>

    <?= Html::a('<i class="glyphicon glyphicon-plus"></i>', ['pengarang/create'], ['class'=>'btn btn-success']) ?>
    <div>&nbsp;</div>
    <table class="table table-hover">
        <tr>
        <thead>
            <th>No</th>
            <th>Nama</th>
            <th>Jenis Kelamin</th>
            <th>Tanggal Lahir</th>
            <th>Action</th>
        </thead>
        </tr>
        <?php $i=1; foreach(Pengarang::find()->all() as $data) { ?>
        <tr>
            <td><?php print $i; ?> </td>
            <td><?php print $data->nama; ?></td>
            <td><?php print $data->getNamaJenisKelamin(); ?></td>
            <td><?php print $data->tanggal_lahir; ?></td>
            <td>
            <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['pengarang/update','id'=>$data->id]) ?>
            <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['pengarang/view','id'=>$data->id]) ?> 
            <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['pengarang/delete', 'id' => $data->id], [
                'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
                    ],
                ]) ?>
            </td>
        </tr>
        <?php $i++ ; } ?> 

        <?php $model = Pengarang::findOne(1);

            print $model->nama.'<br>';
            print $model->tanggal_lahir;
         ?>

    </table>

    