<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "peminjaman".
 *
 * @property int $id
 * @property int $id_buku
 * @property int $id_anggota
 * @property string $tanggal_pinjam
 * @property string $tanggal_kembali
 */
class Peminjaman extends \yii\db\ActiveRecord
{
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
    
     //untuk menampilkan di peminjaman buku sebagai nama
    public function getBuku()
    {
        return $this->hasOne(Buku::className(), ['id' => 'id_buku']);
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
        return 'peminjaman';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_buku', 'id_anggota', 'tanggal_pinjam', 'tanggal_kembali'], 'required'],
            [['id_buku', 'id_anggota'], 'integer'],
            [['tanggal_pinjam', 'tanggal_kembali'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_buku' => 'Id Buku',
            'id_anggota' => 'Id Anggota',
            'tanggal_pinjam' => 'Tanggal Pinjam',
            'tanggal_kembali' => 'Tanggal Kembali',
        ];
    }
}
