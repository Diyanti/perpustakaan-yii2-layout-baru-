<?php

use app\models\Buku;
use app\models\Petugas;
use app\models\Anggota;
use app\models\Penerbit;
use app\models\Penulis;
use app\models\Kategori;
use miloschuman\highcharts\Highcharts;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
$this->title = 'Perpustakaan';
?>

<div class="row">
<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
        <div class="inner">
            <p>Jumlah Buku</p>

            <h3><?= Yii::$app->formatter->asInteger(Buku::getCount()); ?></h3>
        </div>
        <div class="icon">
            <i class="fa fa-times"></i>
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
                <i class="fa fa-warning"></i>
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
                <i class="fa fa-warning"></i>
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
                                'type' => 'pie',
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