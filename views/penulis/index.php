<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helper;
use app\models\Penulis;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PenulisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penulis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penerbit-index box box-primary">
    <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    <p>
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Penulis', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export word', ['penulis/penulis-word'], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export Excel', Yii::$app->request->url.'&export=1', ['class' => 'btn btn-success btn-flat','target' => '_blank']) ?>
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
               'contentOptions' => ['style' => 'text-align:center'],
             ],
             //alamat
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
               'contentOptions' => ['style' => 'text-align:center'],
           ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>


