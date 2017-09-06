<?php

namespace app\models;

use Yii;
use yii\Helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "pengarang".
 *
 * @property integer $id
 * @property string $nama
 * @property integer $jenis_kelamin
 * @property string $tanggal_lahir
 */
class Pengarang extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pengarang';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama', 'id_jenis_kelamin', 'tanggal_lahir'], 'required'],
            [['id_jenis_kelamin'], 'integer'],
            [['tanggal_lahir','gambar'], 'safe'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama Pengarang',
            'id_jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
        ];
    }

    /*public function getNamaJenisKelamin()
    {
        if ($this->jenis_kelamin == 1) {
            return 'laki laki';
        } elseif($this->jenis_kelamin == 0) {
            return 'perempuan';
        } else {
            return 'jenis tidak ada';
        }
    }*/

    public function getBukus()
    {
        return $this->hasMany(Buku::className(),['buku.id_pengarang'=>'id']);
    }

    public static function getPengarang()
    {
        return ArrayHelper::map(Pengarang::find()->all(),'id','nama');
    }

    /*public static function getList()
    {
        return [1=>'Laki Laki',0=>'Perempuan'];
    }*/

    public function getRelationField($relation,$field)
    {
        if(!empty($this->$relation->$field)){
            return $this->$relation->$field;   
        }
        else{
            return null;
        }
    }

    public function getGambar($htmlOptions=[])
    {
        return Html::img('@web/uploads/'.$this->gambar,$htmlOptions);
    }

    public function getJenisKelamin()
    {
        return $this->hasOne(JenisKelamin::className(),['jenis_kelamin.id'=>'id_jenis_kelamin']);
    }
}