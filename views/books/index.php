<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'date_manuf',
            [
                'attribute' => 'author',
                'value' => 'author0.name',
            ],
            [
                'attribute' => 'date_create',
                'format' => 'datetime',
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_create',
                    'autoWidget' => true,
                    'type' => DateControl::FORMAT_DATETIME,
                ])
            ],
            [
                'attribute' => 'date_change',
                'format' => 'datetime',
                'filter' => DateControl::widget([
                    'model' => $searchModel,
                    'attribute' => 'date_change',
                    'autoWidget' => true,
                    'type' => DateControl::FORMAT_DATETIME,
                ])
            ],
            // 'date_create:datetime',
            // 'date_change:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
