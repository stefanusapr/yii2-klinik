<?php

namespace app\models\klinik;

use Yii;

/**
 * This is the model class for table "data_periksa".
 *
 * @property int $id_periksa
 * @property string $no_kartu
 * @property string $tanggal_periksa
 * @property string $diagnosa
 * @property string $tindakan
 * @property string $biaya
 * @property int $status
 * @property int $id_operator
 * @property int $id_dokter
 *
 * @property DataPasien $pasien
 */
class DataPeriksa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_periksa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_kartu', 'tanggal_periksa', 'biaya', 'id_operator', 'id_dokter'], 'required'],
            [['biaya', 'status', 'id_operator', 'id_dokter'], 'integer'],
            [['createdAt','tanggal_periksa'], 'safe'],
            [['no_kartu','diagnosa', 'tindakan'], 'string'],
            [['no_kartu'], 'exist', 'skipOnError' => true, 'targetClass' => DataPasien::className(), 'targetAttribute' => ['no_kartu' => 'no_kartu']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_periksa' => 'Id Periksa',
            'no_kartu' => 'No Kartu',
            'tanggal_periksa' => 'Tanggal Periksa',
            'diagnosa' => 'Diagnosa',
            'tindakan' => 'Tindakan',
            'biaya' => 'Biaya',
            'status' => 'Status',
            'id_operator' => 'Id Operator',
            'id_dokter' => 'Id Dokter',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPasien()
    {
        return $this->hasOne(DataPasien::className(), ['no_kartu' => 'no_kartu']);
    }
}
