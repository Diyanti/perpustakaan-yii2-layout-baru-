<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PetugasSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Petugas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="petugas-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Petugas', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama',
            'alamat',
            'telepon',
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
