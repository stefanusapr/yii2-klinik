<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pasien */

$this->title = 'Update Pasien: ' . $model->NO_KARTU;
$this->params['breadcrumbs'][] = ['label' => 'Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->NO_KARTU, 'url' => ['view', 'id' => $model->NO_KARTU]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pasien-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
