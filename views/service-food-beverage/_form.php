<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFoodBeverage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="service-food-beverage-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
    <?php
    if(!empty($model->photo))
    {
        $url = \Yii::$app->request->BaseUrl . '/images/' . $model->photo;
        echo Html::img($url, [ 'class' => 'img-responsive img-fluid','style'=>'height:50px;']);
    }
    ?>
    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'buy_price')->textInput() ?>

    <?= $form->field($model, 'sale_price')->textInput() ?>

    <?= $form->field($model, 'status')->dropDownList([ 1 => 'ເປິດ', 0 => '​ປິດ', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Food' => 'ອາ​ຫານ', 'Beverage' => '​ເ​ຄືອງ​ດື່ມ', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
