<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Books;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;
use app\models\BookChangeDesc;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model app\models\Books */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

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
            'id',
            'name',
            'desc_book:ntext',
            'date_manuf',
            'author',
            'date_create',
            'date_change',
        ],
    ]) ?>

    <?= Html::submitButton('Показать героев', ['class' => 'btn btn-success', 'id' => 'hero']) ?>
    <?php 
        $js = <<<JS
            $('#hero').on('click',function(){
                $.ajax({
                    url: "index.php?r=books/show",
                    data: {id: $model->id_hero},
                    type: 'GET',
                    success: function(data){
                        $('#hero_plase').text('Главный герой в книге - ' + data);
                    },
                    error: function(){
                        alert('error');
                    }
                });
            });
JS;
        $this->registerJS($js);
    ?>
    <h2 id="hero_plase"></h2>
    <hr>
    <h4>История изменения описания</h4>
    <?php 
        $dataProvider = new ActiveDataProvider([
            'query' => BookChangeDesc::find()->where(['id_book'=> $model->id]),
        ]);
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'id_book',
            'old_desc_book',
            'date_create:datetime',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
