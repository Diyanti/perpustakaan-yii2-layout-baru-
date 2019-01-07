<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\kenaikan_Denda */

$this->title = 'Create Kenaikan  Denda';
$this->params['breadcrumbs'][] = ['label' => 'Kenaikan  Dendas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kenaikan--denda-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
