<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penulis */

$this->title = 'Update Penulis: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penulis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penulis-update box box-primary">
<div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
</div>
<div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
</div>
