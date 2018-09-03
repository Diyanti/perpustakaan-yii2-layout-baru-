<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Buku;
use app\models\Peminjaman;
use app\models\Anggota;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjamen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
  <div class="box-header">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Peminjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
  </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'id_buku',
            [  
                'attribute' => 'id_buku',
                'label' => 'Buku',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->buku->nama;
                },
                'filter' => Buku::getList(),
                'headerOptions' => ['style' => 'text-align:center; width: 150px'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],
            // 'id_anggota',
          [  
                'attribute' => 'id_anggota',
                'label' => 'Anggota',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->anggota->nama;
                },
                'filter' => Anggota::getList(),
                'headerOptions' => ['style' => 'text-align:center; width: 150px'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],
            // 'tanggal_pinjam',
            [
               'attribute' =>'tanggal_pinjam',
               'format' => ['DateTime', 'php: Y / F / d-D'],
               'label' => 'Tanggal<br>Pinjam',
               'encodeLabel' =>false,
               'headerOptions' => ['style' => 'text-align:center; width: 200px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'tanggal_kembali',
           [
               'attribute' =>'tanggal_kembali',
               'format' => 'date',
               'label' => 'Tanggal<br>Kembali',
               'encodeLabel' =>false,
               'headerOptions' => ['style' => 'text-align:center; width: 200px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

<?php 
$pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
$pieces = explode(" ", $pizza);
echo $pieces[0]; // piece1
echo $pieces[1]; // piece2
echo $pieces[2]; // piece2
echo $pieces[3]; // piece2
echo $pieces[4]; // piece2
echo $pieces[5]; // piece2
?>

<?php 
  $hari = "Senin Selasa Rabu Kamis Jumat Sabtu Minggu";
  $tanggal = "1 2 3 4 5 6 7 8 9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31";
  $bulan = "Jan Feb Mar Apr Mei Jun Jul Agust Sept Okt Nov Des";
  $pieces = explode(" ", $hari);
  echo $pieces[2]; // piece1
?>

<!-- $data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo $pass; // * -->
