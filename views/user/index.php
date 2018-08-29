<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Anggota;
use app\models\Buku;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'password',
            // 'id_anggota',
            [  
                'attribute' => 'id_anggota',
                'value' => function($data)
                {
                    // Cara 1 Pemanggil id_*** menjadi nama.
                    //return $data->getPenulis();
                    // Cara 2 Pemanggil id_*** menjadi nama.
                    return @$data->anggota->nama;
                }
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
                }
            ],
            //'id_user_role',
            //'status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
