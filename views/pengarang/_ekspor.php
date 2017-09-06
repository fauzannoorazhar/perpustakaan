<?php

	use app\models\Pengarang; 
	use yii\helpers\Html; 

	?>

    <table border="1" width="100%">
        <tr>
        <thead>
            <th style="text-align:center">No</th>
            <th style="text-align:center">Nama</th>
            <th style="text-align:center">Jenis Kelamin</th>
            <th style="text-align:center">Tanggal Lahir</th>
            <th style="text-align:center">Gambar</th>
            <th style="text-align:center">Action</th>
        </thead>
        </tr>
        <?php $i=1; foreach(Pengarang::find()->all() as $data) { ?>
        <tr>
            <td><?php print $i; ?> </td>
            <td><?php print $data->nama; ?></td>
            <td><?php print $data->id_jenis_kelamin; ?></td>
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