<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "anggota".
 *
 * @property int $id
 * @property string $nama
 * @property string $alamat
 * @property string $telepon
 * @property string $email
 * @property int $status_aktif
 */
class Anggota extends \yii\db\ActiveRecord
{

    public static function getList()
    {
        if (User::isAnggota())
       {
           return \yii\helpers\ArrayHelper::map(Anggota::find()->andWhere(['id' => Yii::$app->user->identity->id_anggota])->all(), 'id', 'nama');
       }
    }
     //untuk menampilkan di peminjaman buku sebagai nama
    public function getAnggota()
    {
        return $this->hasOne(Anggota::className(), ['id' => 'id_anggota']);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'anggota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['status_aktif'], 'integer'],
            [['nama', 'alamat'], 'string', 'max' => 255],
            [['telepon', 'email'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'alamat' => 'Alamat',
            'telepon' => 'Telepon',
            'email' => 'Email',
            'status_aktif' => 'Status Aktif',
        ];
    }

    public function getUser()
   {
       return $this->hasOne(User::class, ['id_anggota' => 'id']);
   }

}