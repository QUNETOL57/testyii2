<?php

use yii\helpers\Html;
use yii\grid\GridView;
use \kartik\datecontrol\DateControl;
use \kartik\dynagrid\DynaGrid;
use kartik\export\ExportMenu;
/* @var $this yii\web\View */
/* @var $searchModel app\models\BooksSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class'=>'kartik\grid\SerialColumn'],
    'id',
    'name',
    'desc_book:ntext',
    'date_manuf',
    [
        'attribute' => 'authorName',
        'value' => 'author0.name',
        'label' => 'Автор',
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
    ['class' => 'yii\grid\ActionColumn'],
    ['class'=>'kartik\grid\CheckboxColumn'],
]; ?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-md-6">
            <p>
                <?= Html::a('Добавить книгу', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
        <div class="col-md-6 ">
            <div class="text-right">
                    <?= Html::a('Загрузить', ['upload'], ['class' => 'btn btn-primary']) ?>
                    <?= ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $columns,
                        'exportConfig' => [
                            ExportMenu::FORMAT_PDF => false,
                            ExportMenu::FORMAT_TEXT => false,
                            ExportMenu::FORMAT_HTML => false,
                            ExportMenu::FORMAT_EXCEL => false,
                            ExportMenu::FORMAT_EXCEL_X => false,
                        ],
                    ]);
                    ?>
            </div>
        </div>
    </div>

    <?= DynaGrid::widget([
        'columns'=>$columns,
        // 'storage'=>DynaGrid::TYPE_COOKIE,
        'theme'=>'panel-primary',
        'gridOptions'=>[
            'dataProvider'=>$dataProvider,
            'filterModel'=>$searchModel,
            'showPageSummary'=>true,
            'export'=> false,
            'panel'=>[
                'heading'=>'<h3 class="panel-title">Книги</h3>',
            ],
        ], 
        'options'=>['id'=>'dynagrid-1'] // a unique identifier is important
    ]);?>

</div>

