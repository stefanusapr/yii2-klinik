<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker; //untuk waktu
//untuk autocomplete
use yii\web\JsExpression;
use yii\jui\AutoComplete;
use app\models\klinik\DataPeriksa;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPeriksa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-periksa-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'no_kartu')->textInput(['disabled' => true]) ?>
        </div>

        <div class="col-sm-6">
            <?=
            $form->field($model, 'tanggal_periksa')->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [
                    // 'changeMonth' => true,
                    'yearRange' => '2019:2020',
                // 'changeYear' => true,
                // 'showOn' => 'button',
                // 'buttonImage' => 'images/calendar.gif',
                // 'buttonImageOnly' => true,
                // 'buttonText' => 'Select date'
                ], 'options' => ['class' => 'form-control']])
            ?>
        </div>
    </div>
    <?= $form->field($model, 'diagnosa')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'tindakan')->textarea(['rows' => 4]) ?>

    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'biaya')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
    </div>

    <?= $form->field($model, 'id_operator')->textInput()->label('Operator') ?>

    <?= $form->field($model, 'id_dokter')->textInput()->label('Dokter') ?>



    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
