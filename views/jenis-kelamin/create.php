<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\JenisKelamin */

$this->title = 'Create Jenis Kelamin';
$this->params['breadcrumbs'][] = ['label' => 'Jenis Kelamins', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-kelamin-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
