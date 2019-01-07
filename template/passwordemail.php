<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\NewPassword;

?>
<div class="row">
<center>
<img src="https://plus.google.com/u/0/photos/photo/113687193163637234890/6617684634449883090" style="width: 250px; height: 250px;">
<hr width="60%">
<h3>Yang Terhormat.</h3>
<h1><?= @$model->nama ?></h1>
<p>Apakah anda yakin ingin merubah password akun perpustakaan anda?</p>
<p>Jika ingin mengubah password anda silahkan klik tombol dibawah ini.</p>
<button type="button" style="background: #00b894; border:none; font-size:14px; padding:15px 25px; text-align: center; font-weight: bold; color:#000000; font-color: black;">

<?= Html::a('Reset Password', ['site/new-password', 'token' => $model->user->token]); ?>
</button>
<hr width="60%">
</center>
</div>
