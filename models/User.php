<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property integer $id_role
 */
class User extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{
    const AKTIF = 1;
    const BELUM_AKTIF = 2;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password', 'id_role','id_model','id_status'], 'required'],
            [['id_role','id_status'], 'integer'],
            [['token'], 'safe'],
            [['username', 'password','model'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'id_model' => 'Id Model',
            'model' => 'Model',
            'id_role' => 'Id Role',
            'id_status' => 'Status',
            'token' => 'Token',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);    
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }


    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPasswordHash()
    {
        $this->password = Yii::$app->getSecurity()->generatePasswordHash($this->password);
        return true;
    }


    public function getAnggota() //Relasi Dari user ke anggota
    {
        return $this->hasOne(Anggota::className(),['anggota.id'=>'id_model']);
    }

    public function getPetugas() //Relasi Dari user ke petugas
    {
        return $this->hasOne(Petugas::className(),['petugas.id'=>'id_model']);
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

    public static function isPetugas()
    {
        if(Yii::$app->user->identity->id_role == 1){
            return true;
        } else{
            return false;
        }
 
        return false;
    }

    public static function isAnggota()
    {
        if(Yii::$app->user->identity->id_role == 2){
            return true;
        } else{
            return false;
        }       
    }

    public function getIdStatus()
    {
        if ($this->id_status == self::AKTIF) {
            return 'Aktif';
        } elseif ($this->id_status == self::BELUM_AKTIF) {
            return 'Belum Aktif';
        }
    }

}
