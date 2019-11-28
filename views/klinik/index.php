<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\klinik\CariPasien */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Pasiens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-pasien-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Buat Data Pasien', ['create'], ['class' => 'btn btn-success']) ?>

    </p>

    <?php Pjax::begin(['id' => 'datapasien']); ?>

    <?= $this->render('_singleSearch', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'no_kartu',
            'nama_lengkap',
            [
                'attribute' => 'Usia',
                'format' => 'raw',
                'value' => function($model) {
                    $datetime1 = new DateTime();
                    $datetime2 = new DateTime($model->tanggal_lahir);
                    $umur = $datetime1->diff($datetime2);
                    $string = $umur->y . ' Thn';
                    return $string;
                },
            ],
            'alamat',
            'nomor_telepon',
            'tanggal_awal_periksa',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Tindakan',
                'template' => '{daftar} {detail}',
                'buttons' => [
                    'daftar' => function($url, $model) {
                        //$url = Url::to(['periksa/create', 'id' => $model->no_kartu]);
                        if ($model->status != 0) {
                            return Html::a('Daftar', ['periksa/create', 'id' => $model->no_kartu], ['class' => 'btn btn-warning btn-xs disabled', 'title' => Yii::t('app', 'Periksa'),]);
                        } elseif ($model->nomor_telepon == null || $model->tanggal_awal_periksa == null) {
                            return Html::a('Ubah', ['klinik/update', 'id' => $model->no_kartu], ['class' => 'btn btn-danger btn-xs', 'title' => Yii::t('app', 'Ubah Identitas'),]);
                        } else {
                            return Html::a('Daftar', ['periksa/create', 'id' => $model->no_kartu], ['class' => 'btn btn-warning btn-xs', 'title' => Yii::t('app', 'Lihat'),]);
                        }
                    },
                    'detail' => function($url, $model) {
                        return Html::a('Lihat', ['klinik/view', 'id' => $model->no_kartu], ['class' => 'btn btn-info btn-xs', 'title' => Yii::t('app', 'Apah'),]);
                    },
                ],
//                'urlCreator' => function ($action, $model, $key, $index) {
//                    if ($action === 'login') {
//                        return Url::to(['periksa/login', 'id' => $model->no_kartu]);
//                    } 
//                    else {
//                        return Url::to(['klinik/login', 'id' => $model->no_kartu]);
//                    }
//                },
            ],
//            [
//                'attribute' => 'some_title',
//                'format' => 'raw',
//                'value' => function ($model) {                      
//                    return '<div>'.$model->alamat.' and other html-code</div>';
//                },
//            ],    
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($model) {
                    if ($model->nomor_telepon == null || $model->tanggal_awal_periksa == null) {
                        return '<span class="badge badge-danger">Lengkapi Identitas</span>';
                    } elseif ($model->status == 1) {
                        return '<span class="badge badge-warning">Antrian</span>';
                    } elseif ($model->status == 2) {
                        return '<span class="badge badge-danger">Diperiksa</span>';
                    } else {
                        return '<span class="badge badge-secondary">Tersedia</span>';
                    }
                },
            ],
//            [
//                    'label' => 'Tindakan',
//                    'content' => function($model) {
//                        return Html::a('Periksa', ['periksa/create', 'id' => $model->no_kartu], ['class' => 'btn btn-success btn-xs', 'data-pjax' => 0]);
//                    }  
//            ],
        ],
    ]);
    ?>


    <?php Pjax::end(); ?>

    <!--autoreload gridview every 10second-->
    <?php
    $this->registerJs(' 
            setInterval(function(){  
                $.pjax.reload({container:"#datapasien"});
            }, 10000);', \yii\web\VIEW::POS_HEAD);
    ?>

</div>
