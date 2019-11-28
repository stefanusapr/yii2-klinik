<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pasien-form">

    <?php $form = ActiveForm::begin(); ?>
        
    <?= $form->field($model, 'nama_lengkap')->textInput(['disabled' => true]) ?>
    
    <?= $form->field($model, 'alamat')->textarea(['rows' => 4, 'disabled' => true]) ?>

    <?= $form->field($model, 'nomor_telepon')->textInput(['disabled' => true, 'maxlength' => true]) ?>

    <?= $form->field($model,'tanggal_awal_periksa')->widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [
                        // 'changeMonth' => true,
                        'yearRange' => '2019:2020',
                        // 'changeYear' => true,
                        // 'showOn' => 'button',
                        // 'buttonImage' => 'images/calendar.gif',
                        // 'buttonImageOnly' => true,
                        // 'buttonText' => 'Select date'
                        'disabled' => true,

                    ],'options'=>['class'=>'form-control']]) ?>

    <?php ActiveForm::end(); ?>

</div>
