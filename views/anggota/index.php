<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnggotaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Anggota';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="anggota-index box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <div class="box-body">
      <?= Html::a('<i class="fa fa-plus"></i> Tambah Anggota', ['create'], ['class' => 'btn btn-success']) ?>
      <?= Html::a('<i class="fa fa-print"></i> Export word Surat Imunisasi', ['anggota/export-word'], ['class' => 'btn btn-primary btn-flat']) ?>

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
                'contentOptions' => ['style' => 'text-align:center'],
             ],
            // 'alamat:ntext',
             [
               'attribute' =>'alamat',
               'headerOptions' => ['style' => 'text-align:center; width: 120px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'telepon',
           [
               'attribute' =>'telepon',
               'headerOptions' => ['style' => 'text-align:center; width: 120px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'email:email',
           [
               'attribute' =>'email',
               'headerOptions' => ['style' => 'text-align:center; width: 150px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],

            //'status_aktif',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>

