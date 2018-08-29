<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Anggota;
use app\models\Petugas;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'username',
            'password',
            // 'id_anggota',
        [
            'attribute' => "id_anggota",
            'value' => function($data){
                return @$data->anggota->nama;
            }
        ],
            // 'id_petugas',
        [
            'attribute' => "id_petugas",
            'value' => function($data){
                return @$data->petugas->nama;
            }
        ],
            'id_user_role',
            'status',
        ],
    ]) ?>

</div>