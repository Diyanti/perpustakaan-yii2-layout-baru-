<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\KategoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategoris';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kategori-index box box-primary">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="box-header">
    <p>
         <?= Html::a('<i class="fa fa-plus"></i> Tambah Kategori', ['create'], ['class' => 'btn btn-success']) ?>
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
