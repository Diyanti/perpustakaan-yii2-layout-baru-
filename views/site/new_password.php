
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
// use yii\captcha\Captcha;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Reset Password';

$gembok = [
   'options' => ['class' => 'form-group has-feedback'],
   'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];

?>

<div class="login-box">
   <div class="login-logo">
       <a href="#"><b>Perpustakaan</b>YII2</a>
   </div>
   <!-- /.login-logo -->
   <div class="login-box-body">
       <p class="login-box-msg">Masukan Password Baru Anda</p>

       <?php $form = ActiveForm::begin(['id' => 'NewPassword', 'enableClientValidation' => false]); ?>

       <?= $form
           ->field($model, 'new_password', $gembok)
           ->label(false)
           ->passwordInput(['placeholder' => $model->getAttributeLabel('Password Baru')]) ?>

       <?= $form
           ->field($model, 'confirmation_password', $gembok)
           ->label(false)
           ->passwordInput(['placeholder' => $model->getAttributeLabel('Ketik Ulang Password')]) ?>

       <div class="row">
           <!-- /.col -->
           <div class="col-xs-12">
               <div class="col-xs-6">
                   <?= Html::submitButton('Simpan', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
               </div>
           </div>
           <!-- /.col -->
       </div>


       <?php ActiveForm::end(); ?>

   </div>
   <!-- /.login-box-body -->
</div><!-- /.login-box -->