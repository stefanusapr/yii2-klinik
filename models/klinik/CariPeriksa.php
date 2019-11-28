<?php

namespace app\models\klinik;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\klinik\DataPeriksa;
use kartik\daterange\DateRangeBehavior;

/**
 * CariPeriksa represents the model behind the search form of `app\models\klinik\DataPasien`.
 */
class CariPeriksa extends DataPasien {

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
            [['createdAt'], 'safe'],
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
        $query = DataPeriksa::find();

        // add conditions that should always apply here
        $this->timeStart = strtotime($this->timeStart);
        $this->timeEnd = strtotime(date('Y-m-d'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['>=', 'createdAt', date('Y-m-d 00:00:00', ($this->timeStart))])
                ->andFilterWhere(['<', 'createdAt', date('Y-m-d 23:59:59', ($this->timeEnd))]);

        return $dataProvider;
    }

}
