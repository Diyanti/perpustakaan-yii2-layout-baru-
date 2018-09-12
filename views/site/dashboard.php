<?php

use app\models\Buku;
use app\models\Petugas;
use app\models\Anggota;
use app\models\Penerbit;
use app\models\Penulis;
use app\models\Kategori;
use app\models\User;
use app\models\Peminjaman;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Perpustakaan';
?>
<!-- Dashboard Admin -->
<?php if (Yii::$app->user->identity->id_user_role == 1): ?>
<div class="row">
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <p>Jumlah Buku</p>
            <h3><?= Yii::$app->formatter->asInteger(Buku::getCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-book"></i>
        </div>
        <a href="<?=Url::to(['buku/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- ./col -->
<div class="col-lg-3 col-xs-6">
    <!-- small box --> 
    <div class="small-box bg-purple">
        <div class="inner">
            <p>Jumlah Penerbit</p>

            <h3><?= Yii::$app->formatter->asInteger(Penerbit::getPenerbitCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
        <a href="<?=Url::to(['penerbit/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
    </div>
</div>

<!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <p>Jumlah Kategori</p>

                <h3><?= Yii::$app->formatter->asInteger(Kategori::getKategoriCount()); ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-server"></i>
            </div>
            <a href="<?=Url::to(['kategori/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <p>Jumlah Petugas</p>

                <h3><?= Yii::$app->formatter->asInteger(Petugas::getPetugasCount()); ?></h3>
            </div>
            <div class="icon">
                <i class="fa fa-user"></i>
            </div>
            <a href="<?=Url::to(['petugas/index']);?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<br>
<br>

<!-- Chart Bar --> 
<div class="row">
    <div class="col-sm-6">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Kategori Buku</h3>
            </div>
            <div class="box-body">
                <?=Highcharts::widget([
                    'options' => [
                        'credits' => false,
                        'title' => ['text' => 'KATEGORI BUKU'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                                'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                                'type' => 'bar',
                                'name' => 'Buku',
                                'data' => Kategori::getGrafikList(),
                            ],
                        ],
                    ],
                ]);?>
            </div>
           </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Penulis Buku</h3>
                    </div>
                    <div class="box-body">
                        <?=Highcharts::widget([
                            'options' => [
                                'credits' => false,
                                'title' => ['text' => 'PENULIS BUKU'],
                                'exporting' => ['enabled' => true],
                                'plotOptions' => [
                                    'pie' => [
                                        'cursor' => 'pointer',
                                    ],
                                ],
                                'series' => [
                                    [
                                        'type' => 'line',
                                        'name' => 'Penulis',
                                        'data' => Penulis::getGrafikList(),
                                    ],
                                ],
                            ],
                        ]);?>
                    </div>
                </div>
            </div>
        </div>
        <br>

            <div class="row" style="margin-left: 0px;">
                <div class="col-sm-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Penerbit Buku</h3>
                        </div>
                        <div class="box-body">
                            <?=Highcharts::widget([
                                'options' => [
                                    'credits' => false,
                                    'title' => ['text' => 'PENERBIT BUKU'],
                                    'exporting' => ['enabled' => true],
                                    'plotOptions' => [
                                        'pie' => [
                                            'cursor' => 'pointer',
                                        ],
                                    ],
                                    'series' => [
                                        [
                                            'type' => 'pie',
                                            'name' => 'Penerbit',
                                            'data' => Penerbit::getGrafikList(),
                                        ],
                                    ],
                                ],
                            ]);?>
                        </div>
                    </div>
                </div>
            </div>

                <div class="site-index">

                    <div class="row">
                        <div class="col-lg-4">

                        </div>
                    </div>

                </div>
            </div>
        </div>
    <?php endif ?>

    <!-- Dashboard Anggota -->
<?php if (Yii::$app->user->identity->id_user_role == 2): ?>
<?php $this->title = 'Perpustakaan'; ?>

<div class="row">

    <?php foreach (Buku::find()->all() as $buku) {?> 
        <!-- Kolom box mulai -->
        <div class="col-md-4">

            <!-- Box mulai -->
            <div class="box box-widget">

                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?= Yii::getAlias('@web').'/images/P2.jpg'; ?>" alt="User Image">
                        <span class="username"><?= Html::a($buku->nama, ['buku/view', 'id' => $buku->id]); ?></span>
                        <span class="description"> Di Terbitkan : Tahun <?= $buku->tahun_terbit; ?></span>
                    </div>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read"><i class="fa fa-circle-o"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <img class="img-responsive pad" src="<?= Yii::$app->request->baseUrl.'/upload/'.$buku['sampul']; ?>" alt="Photo">
                    <p>Sinopsis : <?= substr($buku->sinopsis,0,120);?> ...</p>
                    <?= Html::a("<i class='fa fa-eye'> Detail Buku</i>",["buku/view","id"=>$buku->id],['class' => 'btn btn-default']) ?>
                    <?= Html::a('<i class="fa fa-file"> Pinjam Buku</i>', ['#', 'id' => $buku->id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => 'Apa anda yakin ingin meminjam buku ini?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <!-- <span class="pull-right text-muted">127 Peminjam - 3 Komentar</span> -->
                </div>

            </div>
            <!-- Box selesai -->

        </div>
        <!-- Kolom box selesai -->  
    <?php
        }
    ?>

</div>
<?php endif ?>

<!-- Dashboard Petugas -->
<?php if (Yii::$app->user->identity->id_user_role == 3): ?>
<?php $this->title = 'Perpustakaan'; ?>

<div class="row">

    <?php foreach (Buku::find()->all() as $buku) {?> 
        <!-- Kolom box mulai -->
        <div class="col-md-4">

            <!-- Box mulai -->
            <div class="box box-widget">

                <div class="box-header with-border">
                    <div class="user-block">
                        <img class="img-circle" src="<?= Yii::getAlias('@web').'/images/P2.jpg'; ?>" alt="User Image">
                        <span class="username"><?= Html::a($buku->nama, ['buku/view', 'id' => $buku->id]); ?></span>
                        <span class="description"> Di Terbitkan : Tahun <?= $buku->tahun_terbit; ?></span>
                    </div>
                    <div class="box-tools">
                        <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="Mark as read"><i class="fa fa-circle-o"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                </div>

                <div class="box-body">
                    <img class="img-responsive pad" src="<?= Yii::$app->request->baseUrl.'/upload/'.$buku['sampul']; ?>" alt="Photo">
                    <p>Sinopsis : <?= substr($buku->sinopsis,0,120);?> ...</p>
                    <?= Html::a("<i class='fa fa-eye'> Detail Buku</i>",["buku/view","id"=>$buku->id],['class' => 'btn btn-default']) ?>
                    <?= Html::a('<i class="fa fa-file"> Pinjam Buku</i>', ['#', 'id' => $buku->id], [
                        'class' => 'btn btn-primary',
                        'data' => [
                            'confirm' => 'Apa anda yakin ingin meminjam buku ini?',
                            'method' => 'post',
                        ],
                    ]) ?>
                    <!-- <span class="pull-right text-muted">127 Peminjam - 3 Komentar</span> -->
                </div>

            </div>
            <!-- Box selesai -->

        </div>
        <!-- Kolom box selesai -->  
    <?php
        }
    ?>

</div>
<?php endif ?>