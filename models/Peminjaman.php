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
            'id_buku' => 'Buku',
            'id_anggota' => 'Anggota',
            'tanggal_pinjam' => 'Tanggal Pinjam',
            'tanggal_kembali' => 'Tanggal Kembali',
        ];
    }

    //untuk memunculkan grafik peminjaman per bulan
    public static function getListBulanGrafik()
    {
        $list = [];

        for ($i=1; $i <= 12 ; $i++) {
            $list[] = self::getBulanSingkat($i);
        }

        return $list;
    }
                            
    public static function getCountGrafik()
    {
        $list = [];
        for ($i = 1; $i <= 12; $i++) {
            if (strlen($i) == 1) $i = '0' . $i;
            $count = static::findCountGrafik($i);

            $list [] = (int)@$count->count();

        }

        return $list;
    }

    public static function findCountGrafik($bulan)
    {
        $tahun = date('Y');
        $lastDay = date("t", strtotime($tahun.'_'.$bulan));

        return static::find()->andWhere(['between','tanggal_pinjam', "$tahun-$bulan-01", "$tahun-$bulan-$lastDay"]);
    }

    //untuk cek status
    public function actionCekStatus()
    {
        $query = Peminjaman::find()
            ->andWhere(['tanggal_kembali' => date('Y-m-d')])
            ->all();

        foreach ($query as $peminjaman) {
            $peminjaman->status = Peminjaman::DIKEMBALIKAN;
            $peminjaman->save();
        }
    }


    public function getStatusPeminjaman($value='')
    {
        if ($this->status_buku == 1) {
            return "sedang di pinjam";
        } else{
            return "Belum dikembalikan";
        }
    }

   //   public function getTanggal()
   // {
   //     return $this->getSelisihTanggal($this->tanggal_pinjam, $this->tanggal_kembali);
   // }

   // public static function getSelisihTanggal($tanggal_lalu, $tanggal_sekarang, $key = 'd')
   // {
   //     $tanggal_lalu  = date_create($tanggal_lalu);
   //     $tanggal_sekarang = date_create($tanggal_sekarang)/*->modify('+1 day')*/; //Tangal sekarang +1 hari
   //     $diff  = date_diff($tanggal_lalu, $tanggal_sekarang);
   //     switch ($key) {
   //         case 'y':
   //             return $diff->y;
   //             break;
   //         case 'm':
   //             return $diff->m;
   //             break;
   //         case 'd':
   //             return $diff->d;
   //             break;
   //         default:
   //             return $diff->h;
   //             break;
   //     }
   // }
   public static function getSelisihTanggal($tanggal_pinjam, $tanggal_kembali, $key = 'd')
    {
        $tanggal_pinjam  = date_create($tanggal_pinjam);
        $tanggal_kembali = date_create($tanggal_kembali);//modify('+1 day');/ //Tangal sekarang +1 hari
        
        $diff  = date_diff($tanggal_pinjam, $tanggal_kembali);
        
        switch ($key) {
            case 'y':
                return $diff->format('%a');
                break;
            case 'm':
                return $diff->format('%a');
                break;
            case 'd':
                return $diff->format('%a');
                break;
            default:
                return $diff->h;
                break;
        }
    }

    public function getSelisih()
    {
        return $this->getSelisihTanggal($this->tanggal_kembali, date('Y-m-d'));
    }
}