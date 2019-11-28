<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\klinik\DataPasien */

$this->title = $model->nama_lengkap;
$this->params['breadcrumbs'][] = ['label' => 'Data Pasiens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="data-pasien-view">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Edit Identitas', ['update', 'id' => $model->no_kartu], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Hapus Pasien', ['delete', 'id' => $model->no_kartu], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'no_kartu',
            'nama_lengkap',
            'alamat',
            'nomor_telepon',
            'tanggal_awal_periksa',
        ],
    ]) ?>
    
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    
</div>
