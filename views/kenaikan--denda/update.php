<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\kenaikan_Denda */

$this->title = 'Update Kenaikan  Denda: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kenaikan  Dendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="kenaikan--denda-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
