<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>

<div class="product-order-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'order_code')->textInput(['maxlength' => true,'disabled' => true]) ?>
    <?= $form->field($model, 'details')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'order_date')->textInput()->widget(DatePicker::className(), ['dateFormat' => 'yyyy-MM-dd', 'options' => ['class' => 'form-control']]) ?>
    <?=$this->render('order_item',['model'=>$model])?>
    <div class="form-group">
        <?= Html::submitButton("<span class='fa fa-save'></span> ".Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>