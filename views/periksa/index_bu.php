<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Periksa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-periksa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Create Data Periksa', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Buat Data Pasien', ['klinik/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'no_kartu',
            [
                'header' => 'Nama Pasien',
                'value' => 'pasien.nama_lengkap',
            ],
            'diagnosa:ntext',
            'tindakan:ntext',
            'tanggal_periksa',
            //'biaya',
            //'status',
            //'id_operator',
            //'id_dokter',
            [
                'class'    => 'yii\grid\ActionColumn',
                'header'   => 'Tindakan',
                'template' => '{periksa} {batal}',
                'buttons'  => [
                    'periksa' => function($url,$model) {
                        return Html::a('Periksa', ['periksa/update', 'id' => $model->no_kartu], ['class' => 'btn btn-success btn-xs', 'title' => Yii::t('app', 'Periksa'),]);
                    },
                    'batal' => function($url, $model) {
                        return Html::a('Batal', ['klinik/view', 'id' => $model->no_kartu], ['class' => 'btn btn-danger btn-xs', 'title' => Yii::t('app', 'Batalkan'),]);
                    },    
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
