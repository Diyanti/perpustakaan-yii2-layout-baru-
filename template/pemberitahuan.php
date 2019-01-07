<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\User;
use app\models\Peminjaman;


?>
<div class="row">
<center>
<hr width="60%">
<h3>Yang Terhormat.</h3>
<h1><?= @$model->anggota->nama ?></h1>
<p>Terimakasih sudah melakukan peminjaman di Perpustakaan YII2<p>
<p>Buku yang anda pinjam sudah saatnya di kembalikan pada tanggal</p>
<h1><?= @$model->tanggal_batas_pinjam ?></h1>
</center>
</div>
