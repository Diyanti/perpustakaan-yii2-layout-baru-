<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenerbitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penerbit';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penerbit-index box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Penerbit', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div class="box-body">
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
               'headerOptions' => ['style' => 'text-align:center; width: 100px'],
           ],
            // 'telepon',
           [
               'attribute' =>'telepon',
               'headerOptions' => ['style' => 'text-align:center; width: 100px'],
           ],
            // 'email:email',
           [
               'attribute' =>'email',
               'headerOptions' => ['style' => 'text-align:center; width: 100px'],
           ],
           
           ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
  </div>
</div>


