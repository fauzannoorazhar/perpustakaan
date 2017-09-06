<?php

	use app\models\Buku; 
	use yii\helpers\Html; 

	?>
    
    <table border="1" width="100%">
        <tr>
        <thead>
            <th style="text-align:center">No</th>
            <th style="text-align:center">Nama</th>
            <th style="text-align:center">Nama Pengarang</th>
            <th style="text-align:center">Nama Penerbit</th>
            <th style="text-align:center">Action</th>
        </thead>
        </tr>
        <?php $i=1; foreach(Buku::find()->all() as $data) { ?>
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