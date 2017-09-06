<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Pinjaman */

$this->title = 'Create Pinjaman';
$this->params['breadcrumbs'][] = ['label' => 'Pinjaman', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pinjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
