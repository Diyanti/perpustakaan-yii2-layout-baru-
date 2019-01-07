<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\Anggota;

$this->title = 'forgot Password';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
     'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
     'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];
?>

<div class="login-box">
	<div class="login-logo">
		<h2 style="color: white;">Forgot Password</h2>
	</div>
	<div class="login-box-body">
		<?php $form = ActiveForm::begin(['id' => ' login-form', 'enableClientValidation' => false]);?>
	<?= $form
		->field($model, 'email', $fieldOptions1)
		->label(false)
		->textInput(['placeholder' => $model->getAttributeLabel('email')]) ?>
	<?= $form->field($model, 'verifyCode')->widget(Captcha::className(), ['template' => '<div class="row"><div class="col-lg-12">{image}<div class="col-lg-6">{input}</div></div>',]) ?>
	<div class="col-xs-4">
		<?= Html::a('Kembali', ['site/login'], ['class' => 'btn btn-success']) ?>
	</div>
	<div class="row">
		<div class="col-xs-4">
			<?= Html::submitButton('Kirim', ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
		</div>
	</div>
<?php ActiveForm::end(); ?>
</div>
</div>