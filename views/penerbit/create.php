<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Penerbit */

$this->title = 'Create Penerbit';
$this->params['breadcrumbs'][] = ['label' => 'Penerbits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penerbit-create box box-primary">
	<div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
    <div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
