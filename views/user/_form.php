<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Admin' => 'ຜູ້​ດຄຸ້ມ​ຄອງລະ​ບົບ', 'User' => '​ພະ​ນັ​ກ​ງານ​ຂາຍ','Chef' => 'ພະ​ນັ​ກ​ງານ​ຫ​້ອງ​ຄົວ', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'status')->dropDownList([1=>'ໃຊ້​ງານ', 0=>'ປິດໃຊ້​ງານ']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>