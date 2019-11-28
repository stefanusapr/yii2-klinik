<?php

namespace app\models\klinik;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\klinik\DataPasien;
use kartik\daterange\DateRangeBehavior;

/**
 * CariPasien represents the model behind the search form of `app\models\klinik\DataPasien`.
 */
class CariPasien extends DataPasien {

    /**
     * {@inheritdoc}
     */
    public $timeRange;
    public $timeStart;
    public $timeEnd;

    public function behaviors() {
        return [
            [
                'class' => DateRangeBehavior::className(),
                'attribute' => 'timeRange',
                'dateStartAttribute' => 'timeStart',
                'dateEndAttribute' => 'timeEnd',
            ]
        ];
    }

    public function rules() {
        return [
            [['no_kartu', 'nama_lengkap', 'alamat', 'nomor_telepon', 'tanggal_awal_periksa'], 'safe'],
            [['timeRange'], 'match', 'pattern' => '/^.+\s\-\s.+$/'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios() {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = DataPasien::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        /*
          $query->andFilterWhere([
          'tanggal_awal_periksa' => $this->tanggal_awal_periksa,
          ]);

          $query->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
          ->andFilterWhere(['like', 'alamat', $this->alamat])
          ->andFilterWhere(['like', 'no_kartu', $this->no_kartu])
          ->andFilterWhere(['like', 'nomor_telepon', $this->nomor_telepon]);


          $query->andFilterWhere ( [ 'OR' ,
          ['like', 'no_kartu', $this->no_kartu],
          ['like', 'nama_lengkap', $this->nama_lengkap],s
          ['like', 'alamat', $this->alamat],
          ] );
         */
//        $query->andFilterWhere(['between', 'createdAt', $this->timeStart, $this->timeEnd]);

//        $query->andFilterWhere(['>=', 'createdAt', date('Y-m-d 00:00:00', ($this->timeStart))])
//                ->andFilterWhere(['<', 'createdAt', date('Y-m-d 23:59:59', ($this->timeEnd))]);

//        $query->andFilterWhere(['>=', 'createdAt', strtotime($this->timeStart)])
//              ->andFilterWhere(['<', 'createdAt', strtotime($this->timeEnd)]);

        $query->orFilterWhere(['like', 'nama_lengkap', $this->no_kartu])
                ->orFilterWhere(['like', 'alamat', $this->no_kartu])
                ->orFilterWhere(['like', 'no_kartu', $this->no_kartu])
                ->orFilterWhere(['like', 'nomor_telepon', $this->no_kartu]);

//        if (!is_null($this->request_date) && strpos($this->request_date, '/') !== false) {
//            list($start_date, $end_date) = explode('/', $this->request_date);
//            $query->andFilterWhere(['between', 'request_date', $start_date, $end_date]);
//            $this->request_date = null;
//        } else {
//            $query->andFilterWhere(['request_date' => $this->request_date,]);
//        }

        return $dataProvider;
    }

}
