<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = 'Update Peminjaman: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="peminjaman-update box box-primary">
	<div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
</div>
	<div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
