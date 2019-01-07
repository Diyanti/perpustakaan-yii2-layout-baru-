<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Anggota;
use app\models\User;


class ForgetPasswordForm extends Model

{
    // DEKLARASI  //
    
    public $email;
    public $verifyCode;
    public $token;

   
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['token'],'safe'],
            ['verifyCode', 'captcha'],
          
        ];
    }

    //kirim dan cek email ada atau tidak di database
    public function sendEmail()
    {
        $model = Anggota::findOne(['email'=>$this->email]);
        if ($model !== null) {
            return Yii::$app->mail->compose('@app/template/passwordemail', ['model'=> $model])
             ->setFrom('diyantiyan51@gmail.com')
             ->setTo($this->email)
             ->setSubject('New Password - Perpustakaan')
             ->send();

             return true;

        }
        return false;
    }
}