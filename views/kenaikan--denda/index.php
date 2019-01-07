<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Kenaikan_DendaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kenaikan  Dendas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kenaikan--denda-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Kenaikan  Denda', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'hari',
            'harga',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
