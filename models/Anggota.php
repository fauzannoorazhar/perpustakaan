<?php

namespace app\models;

use Yii;
use yii\Helpers\ArrayHelper;
use yii\helpers\Html;

/**
 * This is the model class for table "anggota".
 *
 * @property integer $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $tanggal_lahir
 * @property integer $id_jenis_kelamin
 */
class Anggota extends \yii\db\ActiveRecord
{
    public $username;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'anggota';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama','username','email','alamat','telepon','tanggal_lahir','id_jenis_kelamin'], 'required'],
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
            'email' => 'Email',
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

    public function getUser()
    {
        return $this->hasOne(User::className(), ['id_model' => 'id']);
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
        $token = Yii::$app->getSecurity()->generateRandomString(10);

        $user = new User;
        $user->id_status = 2;
        $user->id_role = 2;
        $user->model = 'anggota';
        $user->id_model = $this->id;
        $user->token = $token;

        $user->username = $this->username;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->username);
        if ($user->save())
            return true;
        else
                throw new \Exception("Error Processing Request".var_dump($user->errors), 400);
            return true;
    }

    public static function getAnggota()
    {
        return ArrayHelper::map(Anggota::find()->all(),'id','nama');
    }

    public function sendMailToUser($kode = null)
    {

            $pesan = '
                Akun anda telah diverifikasi oleh admin. berikut adalah.<br>
                Silakan login dengan : <br><br>
                <table>
                    <tr>
                        <td>Username</td>
                        <td>:</td>
                        <td>'.$this->username.'
                    </td>
                    <tr>
                        <td>Password</td>
                        <td>:</td>
                        <td>'.$this->username.'
                    </td>
                </table>
                <br><br>
                Terima kasih

            ';   

            $konten = '
            Dengan Hormat, <br><br>
            Pendaftar Aplikasi Perpustakaan dengan data sebagai berikut : <br>

            <table>
                <tr>
                    <td>Nama Anggota</td>
                    <td>:</td>
                    <td>'.$this->nama.'
                </td>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>'.$this->email.'
                </td>
            </table>
            '.$pesan.'

            <br><br>
            <a href="http://localhost/perpustakaan/web/index.php?r=user/aktifkan&id='.$this->user->id.'&token='.$this->user->token.'">Klik disini</a> Untuk Login
        ';

        return Yii::$app->mailer->compose()
            ->setFrom('adminppi@previewaplikasi.com')
            ->setTo($this->email)
            ->setSubject('Pendaftaran SIJAKON')
            ->setTextBody('Pendaftaran')
            ->setHtmlBody($konten)
            ->send();
    }

    public function sendMailToAdmin()
    {        

            $pesan = '
                Telah mendaftar ke aplikasi Perpustakaan. <a href="#"> klik disini </a> untuk login dan melakukan konfirmasi terkait pendaftar tersebut
                <br><br>
                Terima kasih
            ';   

        $konten = '
            Dengan Hormat, <br><br>
            Pendaftar Aplikasi Sistem Informasi Jasa Konstruksi (SIJAKON) Dengan data sebagai berikut : <br>

            <table>
                <tr>
                    <td>Nama Perusahaan</td>
                    <td>:</td>
                    <td>'.$this->nama.'
                </td>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td>'.$this->email.'
                </td>
            </table>

            <br><br>
            '.$pesan.'
        
        ';

        return Yii::$app->mailer->compose()
            ->setFrom('adminppi@previewaplikasi.com')
            ->setTo('fauzannoor98@gmail.com')
            ->setSubject('Pendaftaran SIJAKON')
            ->setTextBody('Pendaftaran')
            ->setHtmlBody($konten)
            ->send();
    }
}