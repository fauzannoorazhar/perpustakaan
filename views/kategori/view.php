<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Buku;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\Kategori */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Kategori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <?php if(User::isPetugas()){ ?>
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

<?php

$query = Buku::find();
$query->where(['id_kategori'=>$model->id]);

?>
<table class="table table-bordered table-striped table-condensed">
    <tr>
        <th>No</th>
        <th>Nama Buku</th>
        <th>Action</th>
    </tr>
        <?php $i=1; foreach ($query->all() as $data) { ?>
    <tr>
        <td><?= $i; ?></td>
        <td><?= $data->nama; ?></td>
        <td> <?= Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['buku/view', 'id' => $data->id]) ?> </td>
    </tr>
    <?php $i++; } ?>
    <tr>
        <th>Jumlah Buku</th>
        <th><?= $query->count(); ?></th>
        <th></th>
    </tr>
</table>

</div>



