<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pasien".
 *
 * @property string $NO_KARTU
 * @property string $NAMA
 * @property string $ALAMAT
 * @property string $TANGGAL_LAHIR
 * @property string $createdAt
 * @property string $TANGGAL_PERIKSA_AWAL
 * @property string $TELP
 */
class Pasien extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pasien';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['NO_KARTU'], 'required'],
            [['TANGGAL_PERIKSA_AWAL'], 'safe'],
            [['NO_KARTU'], 'string', 'max' => 15],
            [['NAMA'], 'string', 'max' => 25],
            [['ALAMAT'], 'string', 'max' => 50],
            [['TELP'], 'string', 'max' => 13],
            [['NO_KARTU'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'NO_KARTU' => 'No Kartu',
            'NAMA' => 'Nama',
            'ALAMAT' => 'Alamat',
            'TANGGAL_PERIKSA_AWAL' => 'Tanggal Periksa Awal',
            'TELP' => 'Telp',
        ];
    }
}
