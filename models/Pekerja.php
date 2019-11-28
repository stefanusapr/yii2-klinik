<?php

namespace app\models;

//use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Description of Pekerja
 *
 * @author Stefanus
 */
class Pekerja extends ActiveRecord{
    //put your code here
    
    //public $nama,$jabatan,$email,$keterangan;
    
    public function rules(){
        return [
            [['nama','jabatan','email','keterangan'], 'required'],
            ['email','email'],
            ['jabatan','string','max'=>150],
        ];
    }
    
    public function dataJabatan(){
        return [
            1 => 'CEO',
            2 => 'COO',
            3 => 'Supervisor'
        ];
    }
    
    public function labelJabatan(){
        if ($this->jabatan==1) {
            return 'CEO';
        } elseif ($this->jabatan==2 ){
            return 'Supervisor';
        } else {
            return 'unknown';
        }
    }
    
}
