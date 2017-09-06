<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pengarang */

$this->title = 'Update Pengarang: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Pengarang', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nama, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pengarang-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
