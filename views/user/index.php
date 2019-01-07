<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Anggota;
use app\models\Buku;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'User';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index box box-primary">
    <div class="box-header">

    <h3 class="box-title"><?= Html::encode($this->title) ?></h3>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    </div>
    
    <div class="box-body">

    <?= Html::a('Tambah User', ['create'], ['class' => 'btn btn-success']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'username',
            [
               'attribute' =>'username',
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'password',
           [
               'attribute' =>'password',
               'headerOptions' => ['style' => 'text-align:center;'],
               'contentOptions' => ['style' => 'text-align:center'],
           ],
            // 'id_anggota',
            [  
                'attribute' => 'id_anggota',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->anggota->nama;
                },
                'filter' => Anggota::getList(),
                'headerOptions' => ['style' => 'text-align:center;'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],
            // 'id_petugas',
            [  
                'attribute' => 'id_petugas',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->petugas->nama;
                },
                // 'filter' => Petugas::getList(),
                'headerOptions' => ['style' => 'text-align:center;'],
                'contentOptions' => ['style' => 'text-align:center'],
            ],
            //'id_user_role',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>
