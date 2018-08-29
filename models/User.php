<?php

namespace app\models;

use Yii;

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
            [['password'], 'string', 'max' => 25],
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
            'id_user_role' => 'Id User Role',
            'status' => 'Status',
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

    public function validatePassword($password)
    {
        return $this->password == $password;
    }
   
}
