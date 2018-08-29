<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use app\models\Anggota;
use app\models\Buku;
/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peminjaman-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_buku')->widget(Select2::classname(), [
            'data' =>  Buku::getList(),
            'options' => [
              'placeholder' => '- Pilih Buku -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

        <?= $form->field($model, 'id_anggota')->widget(Select2::classname(), [
            'data' =>  Anggota::getList(),
            'options' => [
              'placeholder' => '- Pilih Anggota -',
            ],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); ?>

    <?= $form->field($model, 'tanggal_pinjam')->widget(DatePicker::classname(), [
        'removeButton' => false,
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Tanggal Pinjam'],
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

   <?= $form->field($model, 'tanggal_kembali')->widget(DatePicker::classname(), [
        'removeButton' => false,
        'value' => date('Y-m-d'),
        'options' => ['placeholder' => 'Tanggal Kembali'],
        'pluginOptions' => [
        'autoclose'=>true,
        'format' => 'yyyy-mm-dd'
        ]
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
