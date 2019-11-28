<?php

use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPeriksa */

$this->title = 'Create Data Periksa';
$this->params['breadcrumbs'][] = ['label' => 'Data Periksas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-periksa-create">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php Pjax::begin(); ?>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-xs-12">
            
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            
        </div>
        <div class="col-lg-4 col-md-4 col-xl-12">
            
            <?= DetailView::widget([
                'model' => $modelPasien,
                'attributes' => [
                    'no_kartu',
                    'nama_lengkap',
                    [
                        'attribute'=> 'Umur',
                        'format'=>'raw',    
                        'value' => function($model)
                        {   
                            $datetime1 = new DateTime();
                            $datetime2 = new DateTime($model->tanggal_lahir);
                            $umur = $datetime1->diff($datetime2);
                            $string = $umur->y.' Tahun '.$umur->m.' Bulan '.$umur->d.' Hari';
                            return $string;
                        },
                    ],
                    'alamat',
                    'nomor_telepon',
                    'tanggal_awal_periksa',
                ],
            ]) ?>
            
        </div>
    </div>
    <?php Pjax::end(); ?>
    
    <h3>Riwayat Periksa</h3>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'no_kartu',
            'tanggal_periksa',
            'diagnosa:ntext',
            'tindakan:ntext',
            'biaya',
            //'status',
            //'id_operator',
            //'id_dokter',
        ],
    ]); ?>
    
</div>