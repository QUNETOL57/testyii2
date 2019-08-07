<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BookChangeDesc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="book-change-desc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_book')->textInput() ?>

    <?= $form->field($model, 'old_desc_book')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'date_create')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
