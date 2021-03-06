<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Buku;
use app\models\Peminjaman;
use app\models\Anggota;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PeminjamanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Peminjaman';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-index box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php if (User::isAnggota()): ?>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Peminjaman', ['create'], ['class' => 'btn btn-success']) ?>
    </p>    
    <?php endif ?>
  </div>
    <div class="box-body"> 
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
                'headerOptions' => ['style' => 'text-align:center; width: 250px'],
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
               'format' => ['DateTime', 'php: Y / F / d-D'],
               'label' => 'Tanggal<br>Kembali',
               'encodeLabel' =>false,
               'headerOptions' => ['style' => 'text-align:center; width: 200px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>

<!-- $data = "foo:*:1023:1000::/home/foo:/bin/sh";
list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
echo $user; // foo
echo $pass; // * -->
