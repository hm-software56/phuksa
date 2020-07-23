<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($employee, 'photo')->fileInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?php
            if(!empty($employee->photo))
            {
            ?>
            <img src="<?=Yii::$app->request->baseUrl?>/images/<?=$employee->photo?>" class="img-circle" width="100px" ; />
            <?php
            }
            ?>
        </div>
    </div>

    <?= $form->field($employee, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($employee, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($employee, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($employee, 'email')->textInput(['maxlength' => true]) ?>
    
    <div class="divider " style="padding-top:20px"></div>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'type')->dropDownList([ 'Admin' => 'ຜູ້​ດຄຸ້ມ​ຄອງລະ​ບົບ', 'User' => '​ພະ​ນັ​ກ​ງານ​ຂາຍ','Chef' => 'ພະ​ນັ​ກ​ງານ​ຫ​້ອງ​ຄົວ', ], ['prompt' => '']) ?>

    <?php
    echo $form->field($model, 'status')->hiddenInput(['value'=>1])->label(false);
    // $form->field($model, 'status')->dropDownList([1=>'ໃຊ້​ງານ', 0=>'ປິດໃຊ້​ງານ']) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>