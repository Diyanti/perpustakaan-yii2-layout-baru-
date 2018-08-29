<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Kategori;
use app\models\Penerbit;
use app\models\Penulis;


/* @var $this yii\web\View */
/* @var $searchModel app\models\BukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bukus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Buku', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

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
               'headerOptions' => ['style' => 'text-align:center;'],
           ],
           // 'id_penulis',
           [  
                'attribute' => 'id_penulis',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return $data->penulis->nama;
                }
            ],

            // 'id_penerbit',
             [  
                'attribute' => 'id_penerbit',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return $data->penerbit->nama;
                }
            ],

            // 'id_kategori',
             [  
                'attribute' => 'id_kategori',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return $data->kategori->nama;
                }
            ],

            'sinopsis:ntext',
            // 'sampul',
            [
              'attribute' => 'sampul',
              'headerOptions' => ['style' => 'text-align:center;'],
              'format' =>'raw',
              'value' => function ($model){
                if ($model->sampul != '') {
                    return Html::img('@web/upload/'. $model->sampul,['class'=>'img-responsive','style' => 'height:150px', 'align'=>'center']);
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
                        return '<a href="' . Yii::$app->homeUrl . '/upload/' . $model->berkas . '"><div align="center"><button class="btn btn-success glyphicon glyphicon-download-alt"></button></div></a>';
                    } else {
                        return '<div align="center"><h1>No File</h1></div>';
                    }
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
