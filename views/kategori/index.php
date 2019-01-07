<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-index box box-primary">
    <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    
    <div class="box-body"> 
        <?= Html::a('<i class="fa fa-plus"></i> Tambah Kategori', ['create'], ['class' => 'btn btn-success']) ?>
         <?= Html::a('<i class="fa fa-print"></i> Export word', ['kategori/export-word'], ['class' => 'btn btn-primary btn-flat']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'nama',
             [
               'attribute' =>'nama',
               'headerOptions' => ['style' => 'text-align:center'],
               'contentOptions' => ['style' => 'text-align:center'],            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
</div>
