<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use \kartik\date\DatePicker;

use \kartik\datecontrol\DateControl;
/* @var $this yii\web\View */
/* @var $model app\models\Authors */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="authors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php 
        // echo $form->field($model, 'date_birth')->widget(DatePicker::classname(), [
        //     'pluginOptions' => [
        //         'autoclose'=>true,
        //         'format' => 'yyyy-mm-dd',
        //     ]
        // ]);

        echo $form->field($model, 'date_birth')->widget(DateControl::classname(), [
            // 'pluginOptions' => [
            //     'autoclose'=>true,
            //     'format' => 'yyyy-mm-dd',
            // ]
        ]);
        

    ?>

    <?= $form->field($model, 'biography')->textarea(['rows' => 6]) ?>


    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
