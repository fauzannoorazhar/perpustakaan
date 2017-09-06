<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "petugas".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $tanggal_lahir
 * @property integer $id_jenis_kelamin
 */
class Petugas extends \yii\db\ActiveRecord
{
    public $username;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'petugas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama','username'], 'required'],
            [['alamat'], 'string'],
            [['tanggal_lahir'], 'safe'],
            [['id_jenis_kelamin'], 'integer'],
            [['nama', 'telepon'], 'string', 'max' => 255],
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
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'tanggal_lahir' => 'Tanggal Lahir',
            'id_jenis_kelamin' => 'Jenis Kelamin',
        ];
    }

    public function getJenisKelamin()
    {
        return $this->hasOne(JenisKelamin::className(),['jenis_kelamin.id'=>'id_jenis_kelamin']);
    }

    public function getRelationField($relation,$field)
    {
        if(!empty($this->$relation->$field)){
            return $this->$relation->$field;
        } else {
            return null;
        }
    }

    public function createUser()
    {
        $user = new User;
        $user->id_role = 1;
        $user->model = 'petugas';
        $user->id_model = $this->id;

        $user->username = $this->username;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->username);
        if ($user->save())
            return true;
        else
            throw new \Exception("Error Processing Request".var_dump($user->errors), 400);
            

        return true;
    }
}
