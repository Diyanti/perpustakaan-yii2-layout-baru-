<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = 'Create Peminjaman';
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
