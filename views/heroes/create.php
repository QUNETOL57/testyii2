<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Heroes */

$this->title = 'Create Heroes';
$this->params['breadcrumbs'][] = ['label' => 'Heroes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="heroes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
