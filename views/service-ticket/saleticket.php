<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ServiceTicket */

$this->title = Yii::t('app', 'Sale Tickets');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ticket'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php $form = ActiveForm::begin(); ?>
<?php
foreach($model as $model)
{
    $name=$model->name." ". Yii::t("app",'price:').number_format($model->price,2)." ".Yii::t("app",'kip')
    ?>
<?= $form->field($ordersticket, 'service_ticket_id')->inline(false)->checkboxList([$model->id=>$name])->label(false) ?>
<?= $form->field($ordersticket, 'quantity[]')->textInput(['maxlength' => true]) ?>
<?php
}
?>

<?php
foreach($model_car as $model_car)
{
    $name=$model_car->name." ". Yii::t("app",'price:').number_format($model_car->price,2)." ".Yii::t("app",'kip')
    ?>
<?= $form->field($ordersticket_car, 'service_electric_car_id')->inline(true)->checkboxList([$model_car->id=>$name])->label(false) ?>
<?= $form->field($ordersticket_car, 'quantity[]')->textInput(['maxlength' => true]) ?>
<?php
}
?>
<?php ActiveForm::end(); ?>