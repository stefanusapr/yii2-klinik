<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\CariPasien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="data-pasien-singleSearch">

    <?php
    $form = ActiveForm::begin([
                'id' => 'pencarian',
                'action' => ['index'],
                'method' => 'get',
                'options' => [
                    'data-pjax' => 1,
                ],
    ]);
    ?>

    <div class="row">
        <div class="col-sm-3 pull-right">
            <?= $form->field($model, 'no_kartu')->textInput(['autocomplete' => 'off'],['placeholder' => 'Cari no kartu / nama / alamat'])->label(false); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    
    <?php
    $this->registerJs("
        $(document).on('keyup', '#pencarian', function() {=
            	$('form').submit();
    	}
    });", \yii\web\VIEW::POS_END); 
    ?>
</div>
