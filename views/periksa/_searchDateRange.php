<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\CariPeriksa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pariksa-singleDateRange">

    <?php
    $form = ActiveForm::begin([
                'action' => ['laporan'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1,
                ],
    ]);
    ?>

    <div class="row">
        <div class="col-xs-4 pull-right">
            <div class="input-group">
                <?=
                DateRangePicker::widget([
                    'model' => $model,
                    'attribute' => 'timeRange',
                    'convertFormat' => true,
                    'presetDropdown' => true,
                    'pluginOptions' => [
                        'timePicker' => false,
                        'timePickerIncrement' => 30,
                        'locale' => [
                            'format' => 'Y-m-d'
                        ]
                    ]
                ]);
                ?>   
                <div class="input-group-btn">
                    <?= Html::submitButton('', ['class' => 'btn btn-info glyphicon glyphicon-search']) ?>
                </div>
            </div>
        </div>
    </div>
        <?php ActiveForm::end(); ?>

    </div>
