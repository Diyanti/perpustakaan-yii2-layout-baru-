<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Petugas */

$this->title = 'Create Petugas';
$this->params['breadcrumbs'][] = ['label' => 'Petugas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petugas-create box box-primary">
	<div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
	<div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
