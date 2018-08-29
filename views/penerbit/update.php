<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Penerbit */

$this->title = 'Update Penerbit: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penerbits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penerbit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
