<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggotas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index box box-primary">
  
    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-header">
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Anggota', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export word', ['anggota/export-word'], ['class' => 'btn btn-primary btn-flat']) ?>
    </p>
  </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'nama',
             [
               'attribute' =>'nama',
               'headerOptions' => ['style' => 'text-align:center;'],
             ],
            // 'alamat:ntext',
             [
               'attribute' =>'alamat',
               'headerOptions' => ['style' => 'text-align:center; width: 120px'],
           ],
            // 'telepon',
           [
               'attribute' =>'telepon',
               'headerOptions' => ['style' => 'text-align:center; width: 120px'],
           ],
            // 'email:email',
           [
               'attribute' =>'email',
               'headerOptions' => ['style' => 'text-align:center; width: 150px'],
           ],

            //'status_aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

