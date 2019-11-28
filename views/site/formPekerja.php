<?php

use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<div class="row">
    <div class="col-sm-4">
        <?php
        if (Yii::$app->session->hasFlash('success')) {
            echo "<div class='alert alert-success'>".
            Yii::$app->session->getFlash('success')
            ."</div>";
        };
        ?>
        
        <?php
        $form = ActiveForm::begin([
            'method' => 'post',
            'action' => Url::to(['site/form-pekerja']),
        ]);
        ?>
        
        <?= $form->field($model, 'nama')->textInput(); ?>

        <?= $form->field($model, 'jabatan')->dropDownList($model->dataJabatan(),
                [
                    'class' => 'form-control','prompt'=>'--Pilih Jabatan--'
                ]); ?>
        
        <?= $form->field($model, 'email')->textInput(); ?>
        
        <?= $form->field($model, 'keterangan')->textInput(); ?>       
        
        <div class="form-group">
             <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        </div>
        <?php 
        ActiveForm::end();
        ?>
    </div>
    <div class="col-sm-8">
        <table class="table table-bordered table-hover">
            <thead>
                <tr class="success">
                    <th>Nama</th>
                    <th>Jabatan</th>
                    <th>Email</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($dataPekerja as $row){
                ?>
                <tr>
                    <td><?= $row->nama ?></td>
                    <td><?= $row->labelJabatan()?></td>
                    <td><?= $row->email?></td>
                    <td><?= $row->keterangan?></td>
                </tr>
                <?php 
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>