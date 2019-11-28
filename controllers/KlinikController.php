<?php

namespace app\controllers;

use Yii;
use app\models\klinik\DataPasien;
use app\models\klinik\CariPasien;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use yii\data\ActiveDataProvider;
use app\models\klinik\DataPeriksa;

/**
 * KlinikController implements the CRUD actions for DataPasien model.
 */
class KlinikController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all DataPasien models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CariPasien();
                
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize=10;
        $dataProvider->sort = ['defaultOrder' => ['createdAt' => 'DESC']];

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionView($id)
    {   
        $dataProvider = new ActiveDataProvider([
            'query' => DataPeriksa::find(),
        ]);
        
        $dataProvider->query->andWhere("no_kartu = '$id'");

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new DataPasien model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DataPasien();
        
        //mencari id insert terakhir
        $idakhir = DataPasien::find()->orderBy(['createdAt'=> SORT_DESC])->one();
        
        $urutan = 0;        
        $tanggal = date('d');
        $bulan = date('m');
        $tahun = date('Y');

        if ($idakhir!=null) {
            //cari last no kartu
            $posisi = strpos($idakhir->no_kartu,"-");
            $urutan = substr($idakhir->no_kartu, 0, $posisi);
            $tahun = substr($tahun, 2, 3);
        }
                     
        //memasukkan nilai ke objek
        $model->tanggal_awal_periksa = date('Y-m-d');
        $model->createdAt = date('Y-m-d H:i:s');
        $model->no_kartu = sprintf("%06s", ++$urutan)."-".$bulan."-".$tahun;

        if ($model->load(Yii::$app->request->post()) ) {
            $model->save();
            return $this->actionIndex();
            //$this->redirect(['view', 'id' => $model->no_kartu]);
        }
        
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DataPasien model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->no_kartu]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DataPasien model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DataPasien model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataPasien the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DataPasien::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
