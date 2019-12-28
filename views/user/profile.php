<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use kartik\alert\Alert;
/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
if($updated==true)
{
echo Alert::widget([
    'type' =>Alert::TYPE_SUCCESS,
    'title' => 'Well done!',
    'icon' => 'fas fa-ok-circle',
    'body' => 'You successfully read this important alert message.',
    'showSeparator' => true,
    'delay' => 2000
]);
}
?>

<div class="profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'photo')->fileInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?php
            if(!empty($model->photo))
            {
            ?>
            <img src="<?=Yii::$app->request->baseUrl?>/images/<?=$model->photo?>" class="img-circle" width="100px" ; />
            <?php
            }
            ?>
        </div>
    </div>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'phone_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('<il class="fa fa-save"></il> '.Yii::t('app', 'Edit'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>