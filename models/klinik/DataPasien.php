<?php

namespace app\models\klinik;

use Yii;

/**
 * This is the model class for table "data_pasien".
 *
 * @property string $no_kartu
 * @property string $nama_lengkap
 * @property string $alamat
 * @property string $nomor_telepon
 * @property string $tanggal_awal_periksa
 * @property int $status
 *
 * @property DataPeriksa[] $dataPeriksas
 */
class DataPasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'data_pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_kartu','nama_lengkap', 'alamat', 'nomor_telepon', 'tanggal_lahir','tanggal_awal_periksa'], 'required'],
            [['createdAt','tanggal_lahir','tanggal_awal_periksa'], 'safe'],
            [['nama_lengkap'], 'string', 'max' => 25],
            [['alamat'], 'string', 'max' => 50],
            [['nomor_telepon'], 'string', 'max' => 13],
            [['status'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_kartu' => 'No Kartu',
            'nama_lengkap' => 'Nama Lengkap',
            'alamat' => 'Alamat',
            'nomor_telepon' => 'Nomor Telepon',
            'tanggal_lahir' => 'Tanggal Lahir',
            'tanggal_awal_periksa' => 'Tanggal Awal Periksa',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataPeriksas()
    {
        return $this->hasMany(DataPeriksa::className(), ['no_kartu' => 'no_kartu']);
    }
}
