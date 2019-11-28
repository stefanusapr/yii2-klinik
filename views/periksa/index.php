<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

use yii\helpers\Url;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Antrian Periksa';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-periksa-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <p>
        <?= Html::a('Daftar Pasien Baru', ['klinik/create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(['id' => 'antrian']) ?>
     
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
                        return Html::a('Periksa', ['periksa/update', 'id' => $model->id_periksa], ['class' => 'btn btn-success btn-xs', 'title' => Yii::t('app', 'Periksa'),]);
                    },
                    'batal' => function($url, $model) {
                        return Html::a('Batal', $url, 
                                [   'class' => 'btn btn-danger btn-xs',
                                    'id' => 'modal',
                                    'title' => Yii::t('app', 'Batalkan'),
                                    'data-confirm' => Yii::t('yii', 'Are you sure to delete this item?'),
                                    'data-method' => 'post',
                                ]);
                    },    
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'batal') {
                            $url = Url::to(['periksa/delete', 'id' => $model->id_periksa]);
                            return $url;
                        }
},
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>    
    
    <?php 
    Modal::begin([
                'header'=>'<h4>Hapus Data</h4>',
                'id'=>'modal',
                'size'=>'modal-lg',
            ]);
        echo "<div id='modalContent'></div>";
        
    Modal::end();
    ?>
    
    <!--autoreload gridview every 10second-->
    <?php
        $this->registerJs(' 
            setInterval(function(){  
                $.pjax.reload({container:"#antrian"});
            }, 10000);', \yii\web\VIEW::POS_HEAD); 
        
        
    ?>

</div>
