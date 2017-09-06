<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pinjaman".
 *
 * @property integer $id
 * @property integer $id_user
 * @property string $nama
 * @property integer $id_buku
 * @property string $tanggal_peminjaman
 * @property string $tanggal_pengembalian
 * @property integer $status
 */
class Pinjaman extends \yii\db\ActiveRecord
{
    const DIKEMBALIKAN = 10;
    const BELUM_DIKEMBALIKAN = 20;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pinjaman';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_anggota', 'id_buku', 'tanggal_peminjaman'], 'required'],
            [['id_anggota', 'id_buku' , 'status'], 'integer'],
            [['tanggal_peminjaman', 'tanggal_pengembalian','status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_anggota' => 'Nama Anggota',
            'id_buku' => 'Nama Buku',
            'tanggal_peminjaman' => 'Tanggal Peminjaman',
            'tanggal_pengembalian' => 'Tanggal Pengembalian',
            'status' => 'Status',
        ];
    }

    public function getStatus()
    {
        if ($this->status == self::DIKEMBALIKAN) {
            return 'Dikembalikan';
        } elseif ($this->status == self::BELUM_DIKEMBALIKAN) {
            return 'Belum Dikembalikan';
        }
    }

    public static function getList()
    {
        return [self::DIKEMBALIKAN=>'Dikembalikan',self::BELUM_DIKEMBALIKAN=>'Belum Dikembalikan'];
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

    public function getAnggota()
    {
        return $this->hasOne(Anggota::className(),['anggota.id'=>'id_anggota']);
    }

    public function getBuku()
    {
        return $this->hasOne(Buku::className(),['buku.id'=>'id_buku']);
    }

}
