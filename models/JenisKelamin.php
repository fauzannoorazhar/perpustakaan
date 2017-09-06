<?php

namespace app\models;

use Yii;
use yii\Helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "jenis_kelamin".
 *
 * @property integer $id
 * @property string $nama
 */
class JenisKelamin extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'jenis_kelamin';
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

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
        ];
    }

    public static function getJenisKelamin()
    {
        return ArrayHelper::map(JenisKelamin::find()->all(),'id','nama');
    }
}
