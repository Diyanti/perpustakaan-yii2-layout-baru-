<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\components\Helper;
use app\models\Petugas;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PetugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Petugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petugas-index box box-primary">
  <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    
    <div class="box-body">
      <?= Html::a('<i class="fa fa-plus"></i> Tambah Petugas', ['create'], ['class' => 'btn btn-success']) ?>
       <?= Html::a('<i class="fa fa-print"></i> Export word', ['penerbit/penerbit-word'], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export Excel', Yii::$app->request->url.'&export=1', ['class' => 'btn btn-success btn-flat','target' => '_blank']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export Pdf', Yii::$app->request->url.'&export-pdf=1', ['class' => 'btn btn-danger btn-flat','target' => '_blank']) ?>
      
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
               'headerOptions' => ['style' => 'text-align:center; width: 100px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'telepon',
           [
               'attribute' =>'telepon',
               'headerOptions' => ['style' => 'text-align:center; width: 100px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'email:email',
           [
               'attribute' =>'email',
               'headerOptions' => ['style' => 'text-align:center; width: 100px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
           // [
           //     'attribute' =>'password',
           //     'headerOptions' => ['style' => 'text-align:center; width: 100px'],
           //     'contentOptions' => ['style' => 'text-align:center'],
           // ],

           [
              'attribute' => 'foto',
              'headerOptions' => ['style' => 'text-align:center;'],
              'contentOptions' => ['style' => 'text-align:center'],
              'format' =>'raw',
              'value' => function ($model){
                if ($model->foto != '') {
                    return Html::img('@web/user/'. $model->foto,['style' => 'width:150px','height:150px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>

