<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "buku".
 *
 * @property int $id
 * @property string $nama
 * @property string $tahun_terbit
 * @property int $id_penulis
 * @property int $id_penerbit
 * @property int $id_kategori
 * @property string $sinopsis
 * @property string $sampul
 * @property string $berkas
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function getList()
    {
        return \yii\helpers\ArrayHelper::map(self::find()->all(), 'id', 'nama');
    }
  
       //untuk menampilkan di tabel buku sebagai nama
    public function getPenulis()
    {
        return $this->hasOne(Penulis::className(), ['id' => 'id_penulis']);
    }

     public function getPenerbit()
    {
        return $this->hasOne(Penerbit::className(), ['id' => 'id_penerbit']);
    }

      public function getKategori()
    {
        return $this->hasOne(Kategori::className(), ['id' => 'id_kategori']);
    }
    
    public static function tableName()
    {
        return 'buku';
    }
 
    public static function getGrafikList()
    {
        $data = [];
        foreach (static::find()->all() as $buku) {
            $data[] = [StringHelper::truncate($buku->nama, 20), (int) $kabkota->getManyBuku()->count()];
        }
        return $data;
    }

    public static function getCount()
    {
        return static::find()->count();
    }
    
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama'], 'required'],
            [['tahun_terbit'], 'safe'],
            [['id_penulis', 'id_penerbit', 'id_kategori'], 'integer'],
            [['sinopsis'], 'string'],
            [['nama', 'harga'], 'string', 'max' => 255],
            [['sampul'], 'file', 'extensions'=>'jpg, gif, png', 'maxSize'=>5218288, 'tooBig' => 'batas limit upload gambar 5mb'
            ],
            [['berkas'], 'file', 'extensions'=>'doc, docx, pdf', 'maxSize'=>5218288, 'tooBig' => 'batas limit upload berkas 5mb'
            ],
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
            'tahun_terbit' => 'Tahun Terbit',
            'id_penulis' => 'Penulis',
            'id_penerbit' => 'Penerbit',
            'id_kategori' => 'Kategori',
            'sinopsis' => 'Sinopsis',
            'sampul' => 'Sampul',
            'berkas' => 'Berkas',
        ];
    }
}
