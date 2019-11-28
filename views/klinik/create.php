<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPasien */

$this->title = 'Create Data Pasien';
$this->params['breadcrumbs'][] = ['label' => 'Data Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-pasien-create">

    <h1><?= Html::encode($this->title) ?></h1>
        
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
