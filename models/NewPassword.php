<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
* LoginForm is the model behind the login form.
*
* @property User|null $user This property is read-only.
*
*/
class NewPassword extends Model
{
   public $new_password;
   public $confirmation_password;
   public $verifyCode;

   /**
    * @return array the validation rules.
    */
   public function rules()
   {
       return [
           [['new_password'], 'required'],
           ['confirmation_password', 'compare', 'compareAttribute' => 'new_password','message' => '{attribute} Password tidak sama'],
           // ['verifyCode', 'captcha'],
       ];
   }
}
