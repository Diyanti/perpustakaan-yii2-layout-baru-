<?php

namespace app\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Helper extends Component
{
    const DATE_FORMAT = 'php:Y-m-d';
    const DATETIME_FORMAT = 'php:Y-m-d H:i:s';
    const TIME_FORMAT = 'php:H:i:s';

    public static function convert($dateStr, $type='date', $format = null) {
        if ($type === 'datetime') {
              $fmt = ($format == null) ? self::DATETIME_FORMAT : $format;
        }
        elseif ($type === 'time') {
              $fmt = ($format == null) ? self::TIME_FORMAT : $format;
        }
        else {
              $fmt = ($format == null) ? self::DATE_FORMAT : $format;
        }
        return \Yii::$app->formatter->asDate($dateStr, $fmt);
    }

/*    public static function rp($jumlah, $zeroIfNull = false)
    {
        if (empty($jumlah)) {
            if ($zeroIfNull) {
                return Yii::$app->formatter->asCurrency(0);
            }
            return null;
        }
        return Yii::$app->formatter->asCurrency((float) $jumlah);
    }
*/

    public static function rp($jumlah,$null=null)
    {
        if($jumlah==null) {
            return $null;
        } elseif (is_integer($jumlah)) {
            return number_format($jumlah,0,',','.');
        } else {
            return number_format($jumlah,0,',','.');
        }
    }

    public static function getTanggalSingkat($tanggal)
    {
        if ($tanggal==null)
            return null;

        if ($tanggal=='0000-00-00')
            return null;

        $time = strtotime($tanggal);

        return date('j',$time).' '.Helper::getBulanSingkat(date('m',$time)).' '.date('Y',$time);
    }

    public static function getTanggalBulanSingkat($tanggal)
    {
        if ($tanggal==null)
            return null;

        if ($tanggal=='0000-00-00')
            return null;

        $time = strtotime($tanggal);

        $hari = date('j',$time);
        $bulan = date('m',$time);
        $tahun = date('Y',$time);

        return $hari.' '.Helper::getBulanSingkat($bulan).' '.substr($tahun, 2);
    }

    public static function getTanggal($tanggal)
    {
        if ($tanggal==null)
            return null;

        if ($tanggal=='0000-00-00')
            return null;

        $time = strtotime($tanggal);

        return date('j',$time).' '.Helper::getBulanLengkap(date('m',$time)).' '.date('Y',$time);
    }

    public static function getBulanSingkatByInteger($i)
    {
        $bulan = '';

        if (strlen($i)==1) $i = '0'.$i;

        if ($i == '01') {
            $bulan = 'Jan';
        } elseif ($i == '02') {
            $bulan = 'Feb';
        } elseif ($i == '03') {
            $bulan = 'Mar';
        } elseif ($i == '04') {
            $bulan = 'Apr';
        } elseif ($i == '05') {
            $bulan = 'Mei';
        } elseif ($i == '06') {
            $bulan = 'Jun';
        } elseif ($i == '07') {
            $bulan = 'Jul';
        } elseif ($i == '08') {
            $bulan = 'Agt';
        } elseif ($i == '09') {
            $bulan = 'Sep';
        } elseif ($i == '10') {
            $bulan = 'Okt';
        } elseif ($i == '11') {
            $bulan = 'Nov';
        } elseif ($i == '12') {
            $bulan = 'Des';
        }

        return $bulan;

    }

    public static function getBulanSingkat($i)
    {
        $bulan = '';

        if (strlen($i)==1) $i = '0'.$i;

        if ($i == '01') {
            $bulan = 'Jan';
        } elseif ($i == '02') {
            $bulan = 'Feb';
        } elseif ($i == '03') {
            $bulan = 'Mar';
        } elseif ($i == '04') {
            $bulan = 'Apr';
        } elseif ($i == '05') {
            $bulan = 'Mei';
        } elseif ($i == '06') {
            $bulan = 'Jun';
        } elseif ($i == '07') {
            $bulan = 'Jul';
        } elseif ($i == '08') {
            $bulan = 'Agt';
        } elseif ($i == '09') {
            $bulan = 'Sep';
        } elseif ($i == '10') {
            $bulan = 'Okt';
        } elseif ($i == '11') {
            $bulan = 'Nov';
        } elseif ($i == '12') {
            $bulan = 'Des';
        }

        return $bulan;

    }

    public static function getBulanLengkap($i)
    {
        $bulan = '';

        if (strlen($i)==1) $i = '0'.$i;

        if ($i == '01') {
            $bulan = 'Januari';
        } elseif ($i == '02') {
            $bulan = 'Februari';
        } elseif ($i == '03') {
            $bulan = 'Maret';
        } elseif ($i == '04') {
            $bulan = 'April';
        } elseif ($i == '05') {
            $bulan = 'Mei';
        } elseif ($i == '06') {
            $bulan = 'Juni';
        } elseif ($i == '07') {
            $bulan = 'Juli';
        } elseif ($i == '08') {
            $bulan = 'Agustus';
        } elseif ($i == '09') {
            $bulan = 'September';
        } elseif ($i == '10') {
            $bulan = 'Oktober';
        } elseif ($i == '11') {
            $bulan = 'November';
        } elseif ($i == '12') {
            $bulan = 'Desember';
        }

        return $bulan;

    }

    public static function getWaktuWIB($waktu)
    {
        if ($waktu == '')
            return null;
        else {
        $time = strtotime($waktu);

        $h = date('N',$time);

        if ($h == '1') $hari = 'Senin';
        if ($h == '2') $hari = 'Selasa';
        if ($h == '3') $hari = 'Rabu';
        if ($h == '4') $hari = 'Kamis';
        if ($h == '5') $hari = 'Jumat';
        if ($h == '6') $hari = 'Sabtu';
        if ($h == '7') $hari = 'Minggu';


        $tgl = date('j',$time);

        $h = date('n',$time);

        if ($h == '1') $bulan = 'Januari';
        if ($h == '2') $bulan = 'Februari';
        if ($h == '3') $bulan = 'Maret';
        if ($h == '4') $bulan = 'April';
        if ($h == '5') $bulan = 'Mei';
        if ($h == '6') $bulan = 'Juni';
        if ($h == '7') $bulan = 'Juli';
        if ($h == '8') $bulan = 'Agustus';
        if ($h == '9') $bulan = 'September';
        if ($h == '10') $bulan = 'Oktober';
        if ($h == '11') $bulan = 'November';
        if ($h == '12') $bulan = 'Desember';

        $tahun  = date('Y',$time);

        $pukul = date('H:i:s',$time);

        $output = $hari.', '.$tgl.' '.$bulan.' '.$tahun.' | '.$pukul.' WIB';

        return $output;
        }

    }

    public static function getListBulanSingkat()
    {
        return [
          '01'=>'Jan',
          '02'=>'Feb',
          '03'=>'Mar',
          '04'=>'Apr',
          '05'=>'Mei',
          '06'=>'Jun',
          '07'=>'Jul',
          '08'=>'Agt',
          '09'=>'Sep',
          '10'=>'Okt',
          '11'=>'Nov',
          '12'=>'Des'
        ];
    }

    public function getHari($h = null)
    {
        if ($h == '1') {
            return 'Senin';
        } elseif ($h == '2') {
            return 'Selasa';
        } elseif ($h == '3') {
            return 'Rabu';
        } elseif ($h == '4') {
            return 'Kamis';
        } elseif ($h == '5') {
            return 'Jumat';
        } elseif ($h == '6') {
            return 'Sabtu';
        } elseif ($h == '7') {
            return 'Minggu';
        } else {
            return null;
        }
    }

    public static function getBulanList($index = true)
    {
        $bulan = [];
        $i = 1;

        if ($index) {
            while ($i <= 12) {
                if (strlen($i) == 1) $i = '0'.$i;

                $bulan[$i] = self::getBulanLengkap($i);
                $i++;
            }
        } else {
            while ($i <= 12) {
                $bulan[] = self::getBulanLengkap($i);
                $i++;
            }
        }
        return $bulan;
    }


    public static function getBulanListInt()
    {
        $bulan = [];
        $i = 1;
        while ($i <= 12) {
            $bulan[$i] = self::getBulanLengkap($i);
            $i++;
        }

        return $bulan;
    }

    public static function getBulanListFilter()
    {
        $bulan = [];
        $i = 1;
        while ($i <= 12) {
            if (strlen($i) == 1) $i = '0'.$i;

            $bulan[$i] = self::getBulanLengkap($i);
            $i++;
        }

        return $bulan;
    }

    public static function getListBulanGrafik()
    {
        $list = [];

        for ($i=1; $i <= 12 ; $i++) {
            $list[] = self::getBulanSingkat($i);
        }

        return $list;
    }

    public static function getListPaging()
    {
        $paging = [
           20 => '20 Data (Default)',
            5 => '5 Data',
           10 => '10 Data',
           50 => '50 Data',
           100 => '100 Data',
           0 => 'Semua Data',
        ];
        return $paging;
    }

    public static function chr($char,$append = null)
    {
        if ($char > 90) {
            if ($append == null) {
                $append = 64;
            }

            return self::chr(($char - 26), ++$append);
        } else {
            if ($append !== null) {
                $append = chr($append);
            }

            return $append . chr($char);
        }
    }

    public static function chrKecil($char, $append = null)
    {
        if ($char > 122) {
            if ($append == null) {
                $append = 97;
            }

            return self::chrKecil(($char - 26), ++$append);
        } else {
            if ($append !== null) {
                $append = chr($append);
            }

            return $append . chr($char);
        }
    }

    public static function getFormatRupiahExcel()
    {
        return '[$Rp-421] #,##0.00';
    }

    public static function getFormatRupiahExcelTanpaRp()
    {
        return '#,##0.00';
    }

    public static function getTerbilang($rp,$tri=0)
    {
        $ones = array(
            "",
            " satu",
            " dua",
            " tiga",
            " empat",
            " lima",
            " enam",
            " tujuh",
            " delapan",
            " sembilan",
            " sepuluh",
            " sebelas",
            " dua belas",
            " tiga belas",
            " empat belas",
            " lima belas",
            " enam belas",
            " tujuh belas",
            " delapan belas",
            " sembilan belas"
        );

        $tens = array(
            "",
            "",
            " dua puluh",
            " tiga puluh",
            " empat puluh",
            " lima puluh",
            " enam puluh",
            " tujuh puluh",
            " delapan puluh",
            " sembilan puluh"
        );

        $triplets = array(
            "",
            " ribu",
            " juta",
            " miliar",
            " triliun",
        );

        // chunk the number, ...rxyy
        $r = (int) ($rp / 1000);
        $x = ($rp / 100) % 10;
        $y = $rp % 100;

        // init the output string
        $str = "";

        // do hundreds
        if ($x > 0)
        {
            if ($x==1)
                $str =  " seratus";
            else
                $str = $ones[$x] . " ratus";
        }

        // do ones and tens
        if ($y < 20)
            $str .= $ones[$y];
        else
            $str .= $tens[(int) ($y / 10)] . $ones[$y % 10];

        // add triplet modifier only if there
        // is some output to be modified...
        if ($str != "")
            $str .= $triplets[$tri];

        // continue recursing?
        if ($r > 0)
            return Helper::getTerbilang($r, $tri+1).$str;
        else
            return $str;
    }

    public static function konversiRomawi($nomor)
    {
        $table = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $return = '';
        while($nomor > 0)
        {
            foreach($table as $rom => $arb)
            {
                if ($nomor >= $arb)
                {
                    $nomor -= $arb;
                    $return .= $rom;
                    break;
                }
            }
        }

        return $return;
    }

    public static function isDesimal($val)
    {
        return is_numeric($val) && floor( $val ) != $val;
    }

    public static function tagPurify($value)
    {
        return preg_replace('/&nbsp;/', ' ', strip_tags($value));
    }

    public static function getListHari($tahun,$bulan)
    {
        $awal = '1';
        $akhir = date("t", strtotime("$tahun-$bulan"));
        $hari = [];

        for ($i = $awal; $i <= $akhir; $i++) {
            //if (strlen($i) == 1) $i = '0'.$i;
            $hari[$i] = $tahun.'-'.$bulan.'-'.$i;
        }

        return $hari;
    }

    public static function getListHariBulan($tahun,$bulan)
    {
        $awal = 1;
        $n = 0;
        $akhir = date("t", strtotime("$tahun-$bulan"));
        $hari = [];

        for ($i = $awal; $i < $akhir; $i++) { 
            $hari[$n] = Helper::getTanggalSingkat($tahun.'-'.$bulan.'-'.$awal);
            $awal++;
            $n++;
        }

        array_push($hari, Helper::getTanggalSingkat($tahun.'-'.$bulan.'-'.$awal));

        return $hari;
    }

    public static function getRentanWaktu($waktu_sekarang, $waktu_lalu)
    {
        $waktu_sekarang = new \DateTime($waktu_sekarang);
        $waktu_lalu = $waktu_sekarang->diff(new \DateTime($waktu_lalu));
        $jam = $waktu_lalu->h;
        $menit = $waktu_lalu->i;

        if ($jam != 0 && $menit != 0) {
            return $jam.' Jam '.$menit.' Menit';
        } elseif ($jam != 0) {
            return $jam.' Jam';
        } elseif ($menit != 0) {
            return $menit.' Menit';
        } else {
            return 'Tidak Ada Selisih';
        }
    }
}
