<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = 'Create Peminjaman';
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-create box box-primary">
	<div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
	</div>
	<div class="box-body">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
</div>
