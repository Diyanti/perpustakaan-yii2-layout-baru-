<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Kategori */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kategoris', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-view box box-primary">
    <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="box-body">
    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nama',
        ],
    ]) ?>
</div>
</div>
