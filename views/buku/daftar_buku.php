<?php
use app\models\Buku;
use app\models\Kategori;
use app\models\Pengarang;
use yii\helpers\Html; 
?>

    <table border="1" width="100%">
        <tr>
        <thead>
            <th style="text-align:center">No</th>
            <th style="text-align:center">Nama</th>
            <th style="text-align:center">Tanggal Lahir</th>
            <th style="text-align:center">Gambar</th>
            <th style="text-align:center">Action</th>
        </thead>
        </tr>
        <?php $i=1; foreach(Pengarang::find()->all() as $data) { ?>
        <tr>
            <td><?php print $i; ?> </td>
            <td><?php print $data->nama; ?></td>
            <td><?php print $data->tanggal_lahir; ?></td>
            <td><?php print $data->getGambar(['width'=> '40px']); ?></td>
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
    </table>  


<table class="table table-bordered table-hover">
    <tr>
    <thead>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Jumlah Buku</th>
        <th>Action</th>
    </thead>
    </tr>
        <?php $i=1; foreach (Kategori::find()->all() as $data) { ?>
    <tr>
        <td><?php print $i; ?> </td>
        <td><?php print $data->nama; ?> </td>
        <td><?php print $data->getCountBuku(); ?> </td>
        <td>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['kategori/update','id'=>$data->id]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['kategori/view','id'=>$data->id]) ?> 
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['kategori/delete', 'id' => $data->id], [
            'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
                    ],
                ]) ?>
        </td>
    </tr>
    <?php $i++ ; } ?> 
</table> 

<table class="table table-bordered table-hover">
    <tr>
    <thead>
        <th>No</th>
        <th>Nama Pengarang</th>
        <th>Nama Buku</th>
        <th>Tanggal Terbit</th>
        <th>Kategori Buku</th>
        <th>Action</th>
    </thead>
    </tr>
        <?php $i=1; foreach (Buku::find()->all() as $data) { ?>
    <tr>
            <td><?= $i; ?> </td>
            <td><?= $data->pengarang->nama; ?></td>
            <td><?= $data->nama; ?></td>
            <td><?= $data->tanggal_terbit; ?></td>
            <td><?= $data->kategori->nama; ?></td>
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

<table class="table table-bordered table-hover">
    <tr>
    <thead>
        <th>No</th>
        <th>Nama Kategori</th>
        <th>Jumlah Buku</th>
        <th>Action</th>
    </thead>
    </tr>
        <?php $i=1; foreach (Kategori::find()->all() as $data) { ?>
    <tr>
        <td><?= $i; ?> </td>
        <td><?= $data->nama; ?> </td>
        <td><?= $data->getCountBuku(); ?> </td>
        <td>
        <?= Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['kategori/update','id'=>$data->id]) ?>
        <?= Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['kategori/view','id'=>$data->id]) ?> 
        <?= Html::a('<i class="glyphicon glyphicon-trash"></i>', ['kategori/delete', 'id' => $data->id], [
            'data' => [
            'confirm' => 'Are you sure you want to delete this item?',
            'method' => 'post',
                    ],
                ]) ?>
        </td>
    </tr>
    <?php $i++ ; } ?> 
</table> 

<table class="table table-bordered table-hover">
    <tr>
    <thead>
        <th>No</th>
        <th>Nama Pengarang</th>
        <th>Nama Buku</th>
        <th>Tanggal Terbit</th>
        <th>Kategori Buku</th>
        <th>Action</th>
    </thead>
    </tr>
        <?php $i=1; foreach (Buku::find()->all() as $data) { ?>
    <tr>
            <td><?= $i; ?> </td>
            <td><?= $data->pengarang->nama; ?></td>
            <td><?= $data->nama; ?></td>
            <td><?= $data->tanggal_terbit; ?></td>
            <td><?= $data->kategori->nama; ?></td>
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