<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekam Medis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="data-periksa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'laporan']); ?>   
    <?= $this->render('_searchDateRange', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'no_kartu',
            [
                'attribute' => 'nama_lengkap',
                'value' => 'pasien.nama_lengkap',
            ],
            [
                'attribute' => 'Alamat',
                'value' => 'pasien.alamat',
            ],
            'biaya',
            'tanggal_periksa',
            [
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Tindakan',
                'template' => '{periksa} {batal}',
                'buttons' => [
                    'batal' => function($url, $model) {
                        return Html::a('Hapus', $url,
                                        ['class' => 'btn btn-danger btn-xs',
                                            'id' => 'modal',
                                            'title' => Yii::t('app', 'Hapus'),
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
    ]);
    ?>

<?php Pjax::end(); ?>

</div>
