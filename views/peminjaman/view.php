<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Anggota;
use app\models\Buku;

/* @var $this yii\web\View */
/* @var $model app\models\Peminjaman */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Peminjamen', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peminjaman-view box box-primary">
    <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
</div>
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
    <div class="box-body">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            // 'id_buku',
        [
            'attribute' => "id_buku",
            'value' => function($data){
                return $data->buku->nama;
            }
        ],
            // 'id_anggota',
        [
            'attribute' => "id_anggota",
            'value' => function($data){
                return $data->anggota->nama;
            }
        ],
            'tanggal_pinjam',
            'tanggal_kembali',
        ],
    ]) ?>

</div>
</div>

