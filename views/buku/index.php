 <?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kategori;
use app\models\Penerbit;
use app\models\Penulis;
use app\models\Buku;
use app\models\BukuSearch;
use yii\web\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Buku';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-index box box-primary">
  
    <div class="box-header">
      <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    </div>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
   <div class="box-body"> 
    <?= Html::a('<i class="fa fa-plus"></i> Tambah Buku', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export word', ['buku/jadwal-pl'], ['class' => 'btn btn-primary btn-flat']) ?>
        <?= Html::a('<i class="fa fa-print"></i> Export Excel', Yii::$app->request->url.'&export=1', ['class' => 'btn btn-success btn-flat','target' => '_blank']) ?>
        
         <?= Html::a('<i class="fa fa-print"></i> Export PDF', ['site/export-pdf'], ['class' => 'btn btn-danger']) ?>
         
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

            // 'tahun_terbit',
            [
               'attribute' =>'tahun_terbit',
               'label' => 'Tahun<br>Terbit',
               'encodeLabel' =>false,
               'headerOptions' => ['style' => 'text-align:center; width: 80px'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
           
           // 'id_penulis',
           [  
                'attribute' => 'id_penulis',
                'label' => 'Penulis',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->penulis->nama;
                },
                'filter' => Penulis::getList(),
                'headerOptions' => ['style' => 'text-align:center; width: 80px'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],

            // 'id_penerbit',
             [  
                'attribute' => 'id_penerbit',
                'label' => 'Penerbit',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->penerbit->nama;
                },
                'filter' => Penerbit::getList(),
                'headerOptions' => ['style' => 'text-align:center; width: 80px'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],

            // 'id_kategori',
             [  
                'attribute' => 'id_kategori',
                'label' => 'Kategori',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->kategori->nama;
                },
                'filter' => Kategori::getList(),
                'headerOptions' => ['style' => 'text-align:center; width: 80px'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],

            // 'sinopsis:ntext',
            [
               'attribute' =>'sinopsis',
               'headerOptions' => ['style' => 'text-align:center;'],
           ],
            // 'sampul',
            [
              'attribute' => 'sampul',
              'headerOptions' => ['style' => 'text-align:center;'],
              'contentOptions' => ['style' => 'text-align:center'],
              'format' =>'raw',
              'value' => function ($model){
                if ($model->sampul != '') {
                    return Html::img('@web/upload/'. $model->sampul,['style' => 'width:150px','height:150px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],
         
            // 'berkas',
            [
                'attribute' => 'berkas',
                'headerOptions' => ['style' => 'text-align:center;'],
                'format' => 'raw',
                'value' => function ($model) {
                    if ($model->berkas !='') {
                        return '<a href="' . Yii::$app->request->baseUrl . '/upload/' . $model->berkas . '"><div align="center"><button class="btn btn-success glyphicon glyphicon-download-alt"></button></div></a>';
                    } else {
                        return '<div align="center"><h1>No File</h1></div>';
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    ?>
  </div><!-- .box-body -->
</div><!-- .box primary-->
    