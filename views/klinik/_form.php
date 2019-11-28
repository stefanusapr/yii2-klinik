<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/*
use yii\jui\DatePicker;

    <?= $form->field($model,'tanggal_awal_periksa')->widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [
                        // 'changeMonth' => true,
                        'yearRange' => '2019:2020',
                        // 'changeYear' => true,
                        // 'showOn' => 'button',
                        // 'buttonImage' => 'images/calendar.gif',
                        // 'buttonImageOnly' => true,
                        // 'buttonText' => 'Select date'

                    ],'options'=>['class'=>'form-control']]) ?>
    <?= $form->field($model,'tanggal_lahir')->widget(DatePicker::className(),[ 'dateFormat' => 'yyyy-MM-dd', 'clientOptions' => [
                        // 'changeMonth' => true,
                        'yearRange' => '1950:2019',
                        // 'changeYear' => true,
                        // 'showOn' => 'button',
                        // 'buttonImage' => 'images/calendar.gif',
                        // 'buttonImageOnly' => true,
                        // 'buttonText' => 'Select date'

                    ],'options'=>['class'=>'form-control']]) ?> 
*/

use kartik\date\DatePicker;



/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pasien-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        <div class="col-lg-6 col-xs-12">
    <?= $form->field($model, 'no_kartu')->textInput(['disabled' => true]) ?>
        </div>
        <div class="col-lg-6 col-xs-12">
    <?= $form->field($model, 'tanggal_awal_periksa')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_INPUT,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => ['icon' => 'date'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ],        
                        'options' => [
                            'autocomplete' => 'off',
                        ],

                ])
    ?>
        </div>
    </div>
    <?= $form->field($model, 'nama_lengkap')->textInput(['autocomplete' => 'off'],['maxlength' => true]) ?>
        
    <?= $form->field($model, 'alamat')->textarea(['autocomplete' => 'off'],['rows' => 4,'maxlength' => true]) ?>
    
    <div class="row">
        <div class="col-lg-6 col-xs-12">
    <?= $form->field($model, 'tanggal_lahir')->widget(DatePicker::className(),[
                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                        'removeButton' => ['icon' => 'trash'],
                        'pickerButton' => ['icon' => 'date'],
                        'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'autoclose' => true,
                            'todayHighlight' => true,
                        ],      
                        'options' => [
                            'autocomplete' => 'off',
                        ],
                ])
    ?>        
        </div>
        <div class="col-lg-6 col-xs-12">
    <?= $form->field($model, 'nomor_telepon')->textInput(['autocomplete' => 'off'],['disabled' => false],['maxlength' => true]) ?>
        </div>
    </div>    

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


