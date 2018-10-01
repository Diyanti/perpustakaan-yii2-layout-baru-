<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\models\Buku;
use yii\models\Penerbit;
use yii\models\Kategori;
use app\models\Penulis;

/* @var $this yii\web\View */
/* @var $model app\models\Buku */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Bukus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="buku-view box box-primary">
    <div class="box-header">
    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>

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
            // 'id',
            // 'nama',
            // 'tahun_terbit',
            // 'id_penulis',
            // 'id_penerbit',
            // 'id_kategori',
            [
                //untuk merubah nama diatas tabel  di view (detail Buku)
                'label' => 'Nama',
                'attribute' => 'nama',
                'value' => $model->nama
                // . '('.$model->tahun_terbit. ')'
            ],
            [
                'attribute' => 'tahun_terbit',
                'value' => $model->tahun_terbit

            ],
                 // 'id_penulis',
            [
            'attribute' => "id_penulis",
            'value' => function($data){
                return $data->penulis->nama;
            }
        ],
            
              [
            'attribute' => "id_penerbit",
            'value' => function($data){
                return $data->penerbit->nama;
            }
        ],

             [
            'attribute' => "id_kategori",
            'value' => function($data){
                return $data->kategori->nama;
            }
        ],
            'sinopsis:ntext',
            // 'sampul',
            [
              'attribute' => 'sampul',
              'format' =>'raw',
              'value' => function ($model){
                if ($model->sampul != '') {
                    return Html::img('@web/upload/'. $model->sampul,['class'=>'img-responsive','style' => 'height:150px', 'align'=>'center']);
                }else{
                  return '<div align="center"><h1>No Image</h1></div>';
                }
              },
            ],
            'berkas',
        ],
    ]) ?>

</div>
</div>
