<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
use yii\Helpers\ArrayHelper;
use app\models\Kategori;

/**
 * This is the model class for table "buku".
 *
 * @property integer $id
 * @property integer $id_pengarang
 * @property string $nama
 * @property string $tanggal_terbit
 * @property integer $id_kategori
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pengarang', 'nama', 'tanggal_terbit', 'id_kategori'], 'required','message'=>'{attribute} tidak boleh kosong'],
            [['id_pengarang', 'id_kategori'], 'integer'],
            [['tanggal_terbit'], 'safe'],
            [['gambar'],'file'],
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
            'id_pengarang' => 'Nama Pengarang',
            'nama' => 'Nama Buku',
            'tanggal_terbit' => 'Tanggal Terbit',
            'id_kategori' => 'Kategori Buku',
            'id_penerbit' => 'Nama Penerbit',
        ];
    }

    public function getPengarang()
    {
        return $this->hasOne(Pengarang::className(),['pengarang.id'=>'id_pengarang']);
    }

    public function getBuku()
    {
        return ArrayHelper::map(Buku::find()->all(),'id','nama');
    }

    public function getKategori()
    {
        return $this->hasOne(Kategori::className(),['Kategori.id'=>'id_kategori']);
    }

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
        /*if (1 === 1) {
            print "tes";
            die;
        }*/
        //Jika file ada dalam direktori
        if(file_exists('@web/uploads/'.$this->gambar)){
            return true;
        } else {
            return Html::img('@web/uploads/'.$this->gambar,$htmlOptions);
        }
    }

    public static function getGrafik()
    {
        $grafik = null;
        foreach(Kategori::find()->all() as $data){
            $grafik .= '{"label": "'.$data->nama.'" ,"value" : "'.$data->getCountBuku().'"},'; 
        }
        return $grafik;
    }

}

        /*if(!file_exists('@web/uploads/'.$this->gambar)){
            return Html::img('@web/uploads/'.$this->gambar,$htmlOptions);
        } else {
            return true;
        }*/