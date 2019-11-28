<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPasien */

$this->title = 'Update Data Pasien: ' . $model->no_kartu;
$this->params['breadcrumbs'][] = ['label' => 'Data Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->no_kartu, 'url' => ['view', 'id' => $model->no_kartu]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="data-pasien-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
