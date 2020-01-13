<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'status')->dropDownList([ 1 => Yii::t('app','ເປິດ'), 0 => Yii::t('app','ປິດ'), ], ['prompt' => '']) ?>


    <div class="form-group">
        <?= Html::submitButton("<il class='fa fa-save'></il> ".Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>