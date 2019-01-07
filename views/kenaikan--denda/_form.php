<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\kenaikan_Denda */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kenaikan--denda-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'hari')->textInput() ?>

    <?= $form->field($model, 'harga')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
