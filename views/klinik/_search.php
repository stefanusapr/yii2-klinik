<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\CariPasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pasien-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>
    
    <?= $form->field($model, 'no_kartu') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?= $form->field($model, 'alamat') ?>

    <?= $form->field($model, 'nomor_telepon') ?>

    <?= $form->field($model, 'tanggal_awal_periksa') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
