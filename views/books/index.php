<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \kartik\datecontrol\DateControl;

use \kartik\dynagrid\DynaGrid;

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

    <?php 
       $columns = [
        ['class'=>'kartik\grid\SerialColumn', 'order'=>DynaGrid::ORDER_FIX_LEFT],
        'id',
        'name',
        'desc_book:ntext',
        'date_manuf',
        [
            'attribute' => 'authorName',
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
        ['class'=>'kartik\grid\CheckboxColumn', 'order'=>DynaGrid::ORDER_FIX_RIGHT],
    ];
     
    echo DynaGrid::widget([
        'columns'=>$columns,
        'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-primary',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'panel'=>['heading'=>'<h3 class="panel-title">Книги</h3>'],
        ],
        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]);?>



</div>

