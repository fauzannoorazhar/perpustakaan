<?php

namespace app\models;

use Yii;
use yii\Helpers\ArrayHelper;
use app\models\Buku;

/**
 * This is the model class for table "kategori".
 *
 * @property integer $id
 * @property string $nama
 */
class Kategori extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kategori';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['nama'], 'string', 'max' => 255],
        ];
    }

    public function getBukus()
    {
        return $this->hasMany(Buku::className(),['buku.id_kategori'=>'id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Kategori Buku',
        ];
    }

    public static function getList()
    {
        return ArrayHelper::map(kategori::find()->all(),'id','nama');
    }

    public function getCountBuku()
    {
        return Buku::find()->where(['id_kategori'=>$this->id])->count();
    }
}
