<?php

namespace app\controllers;

use Yii;
use app\models\klinik\DataPeriksa;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\klinik\DataPasien;
use app\models\klinik\CariPasien;
use app\models\klinik\CariPeriksa;

/**
 * PeriksaController implements the CRUD actions for DataPeriksa model.
 */
class PeriksaController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function behaviors() {
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
     * Lists all DataPeriksa models.
     * @return mixed
     */
    public function actionIndex() {
        $model = new DataPeriksa();

        $dataProvider = new ActiveDataProvider([
            'query' => DataPeriksa::find()
        ]);

        $dataProvider->query->andWhere('status = 0');

        return $this->render('index', [
                    'dataProvider' => $dataProvider,
                    'model' => $model,
        ]);
    }

    public function actionLaporan() {
        $searchModel = new CariPeriksa();

        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('status = 1');
        $dataProvider->pagination->pageSize = 10;
        $dataProvider->sort = ['defaultOrder' => ['createdAt' => 'DESC']];

        return $this->render('laporan', [
                    'dataProvider' => $dataProvider,
                    'searchModel' => $searchModel,
        ]);
    }

    /**
     * Displays a single DataPeriksa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DataPeriksa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id = null) {
        $model = new DataPeriksa();
        $modelPasien = new DataPasien();

        if ($id != null) {
            $modelPasien = $this->findModelPasien($id);
            $model->no_kartu = $modelPasien->no_kartu;
        } else {
            
        }

        $model->tanggal_periksa = date('Y-m-d');
        $model->biaya = 0;
        $model->status = 0;
        $model->id_dokter = 1;
        $model->id_operator = 1;

        if ($model->load(Yii::$app->request->post())) {
            $model->createdAt = date('Y-m-d H:i:s');
            $modelPasien->status = 1;

            $model->save();
            $modelPasien->save();
            return $this->redirect(['klinik/index']);
        }
        
        //Nampilin riwayat periksa
        $dataProvider = new ActiveDataProvider([
            'query' => DataPeriksa::find(),
        ]);

        $dataProvider->query->andWhere("no_kartu = '$id'");

        return $this->render('create', [
                    'model' => $model,
                    'modelPasien' => $modelPasien,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing DataPeriksa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        $modelPasien = $this->findModelPasien($model->no_kartu);

        if ($model->load(Yii::$app->request->post())) {
            $modelPasien->status = 0;
            $modelPasien->save();

            $model->status = 1;
            $model->save();
            return $this->redirect(['index']);
        } else {
            $modelPasien->status = 2;
            $modelPasien->save();
        }
        
        //Nampilin riwayat periksa
        $dataProvider = new ActiveDataProvider([
            'query' => DataPeriksa::find(),
        ]);

        $dataProvider->query->andWhere("no_kartu = '$id'");

        return $this->render('update', [
                    'model' => $model,
                    'modelPasien' => $modelPasien,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Deletes an existing DataPeriksa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        $modelPasien = $this->findModelPasien($model->no_kartu);

        $modelPasien->status = 0;
        $modelPasien->save();

        $model->delete();

        //redirect ke halaman sebelumnya
        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * Finds the DataPeriksa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DataPeriksa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {

        if (($model = DataPeriksa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findModelPasien($id) {
        if (($model = DataPasien::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
