<?php

namespace app\models;

use Yii;
use yii\helpers\Html;
/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $id_anggota
 * @property int $id_petugas
 * @property int $id_user_role
 * @property int $status
 */
class user extends \yii\db\ActiveRecord  implements \yii\web\IdentityInterface
{
     public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
         //untuk menampilkan di peminjaman buku sebagai nama
    public function getAnggota()
    {
        return $this->hasOne(Anggota::className(), ['id' => 'id_anggota']);
    }

         //untuk menampilkan di peminjaman buku sebagai nama
    public function getPetugas()
    {
        return $this->hasOne(Petugas::className(), ['id' => 'id_petugas']);
    }
    public function getUserRole()
    {
        return $this->hasOne(UserRole::className(), ['id' => 'id_user_role']);
    }
    public function getStatus()
    {
        $datalist = [
            '0' => 'tidak aktif',
            '1' => 'aktif',
        ];
        return $datalist[$this->status];
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['id_anggota', 'id_petugas', 'id_user_role', 'status'], 'integer'],
            [['username'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 255],
            [['token'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'username',
            'password' => 'password',
            'id_anggota' => 'Anggota',
            'id_petugas' => 'Petugas',
            'id_user_role' => 'User Role',
            'status' => 'Status',
            'token' => 'Token',
        ];
    }

     public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $Type = null)
    {
        return static::findOne(['access_token' => $token]);
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
        return null;
    }
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username'=>$username]);
    }
    //untuk validate password dengan hash
    public function validatePassword($password)
    {
        // return $password == $this->password;
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }

    //untuk validasi (session) untuk admin
   public static function isAdmin()
   {
    if (Yii::$app->user->isGuest) {
        return false;
    }
    $model = User::findOne(['username' => Yii::$app->user->identity->username]);
    if ($model == null) {
        return false;
    } elseif ($model->id_user_role == 1) {
        return true;
    }
    return false;
   }

   //untuk validasi anggota
   public static function isAnggota()
   {
    if (Yii::$app->user->isGuest) {
        return false;
    }
    $model = User::findOne(['username' => Yii::$app->user->identity->username]);
    if ($model == null) {
        return false;
    } elseif ($model->id_user_role == 2) {
        return true;
    }
    return false;
   }

   //untuk validasi petugas
   public static function isPetugas()
   {
    if (Yii::$app->user->isGuest) {
        return false;
    }
    $model = User::findOne(['username' => Yii::$app->user->identity->username]);
    if ($model == null) {
        return false;
    } elseif ($model->id_user_role == 3) {
        return true;
    }
    return false;
   }

   // public static function getFotoAdmin($htmlOptions=[])
   //  {
   //      return Html::img('@web/user/admin.jpg', $htmlOptions);
   //  }

   //  public static function getFotoAnggota($htmlOptions=[])
   //  {
   //     $query = Anggota::find()
   //     ->andWhere(['id' => Yii::$app->user->identity->id_anggota])
   //     ->one();

   //     if ($query->foto != null) {
   //         return Html::img('@web/user/' . $query->foto, $htmlOptions);
   //     } else {
   //         return Html::img('@web/user/no-images.png', $htmlOptions);
   //     }
   // }

   //untuk foto
   public static function getFotoPetugas($htmlOptions=[])
   {
       $query = Petugas::find()
       ->andWhere(['id' => Yii::$app->user->identity->id_petugas])
       ->one();

       if ($query->foto != null) {
           return Html::img('@web/user/' . $query->foto, $htmlOptions);
       } else {
           return Html::img('@web/user/no-images.png', $htmlOptions);
       }
   }

}
