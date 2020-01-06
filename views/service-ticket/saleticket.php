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
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?=Yii::t('app','Ticket')?></legend>
    <?php
        if(count($error)>0 && $error[0]!="Yes")
        {
            foreach($error as $error1)
            {
                echo "<span style='color:red'>- ". $error1."</span></br></br>";
            }
        }
    ?>
    <?php
foreach($model as $model)
{
    $name=$model->name." ". Yii::t("app",'price:').number_format($model->price,2)." ".Yii::t("app",'kip')
    ?>

    <div class="col-md-6">
        <div class="checkbox">
            <label>
                <input type="checkbox"
                    <?=isset(Yii::$app->session['sale']['service_ticket_id_'.$model->id.''])?'checked':' '?>
                    name="service_ticket_id_<?=$model->id?>" value="<?=$model->id?>"><?=$name?>
            </label>
        </div>
        <label class="control-label"><?=Yii::t('app','Total')." ".$model->name?></label>
        <input type="text" id="quantity_<?=$model->id?>" class="form-control" name="quantity_<?=$model->id?>"
            value="<?=Yii::$app->session['sale']['quantity_'.$model->id.'']?>" />
    </div>
    <?php
}
?>
</fieldset>
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?=Yii::t('app','Ticket Electric Car')?></legend>
    <?php
        if(count($error_car)>0 && $error_car[0]!="Yes")
        {
            foreach($error_car as $error_car1)
            {
                echo "<span style='color:red'>- ". $error_car1."</span></br></br>";
            }
        }
    ?>
    <?php
foreach($model_car as $model_car)
{
    $name=$model_car->name." ". Yii::t("app",'price:').number_format($model_car->price,2)." ".Yii::t("app",'kip')
    ?>
    <div class="col-md-6">
        <div class="checkbox">
            <label>
                <input type="checkbox"
                    <?=isset(Yii::$app->session['sale']['service_electric_car_id_'.$model_car->id.''])?'checked':' '?>
                    name="service_electric_car_id_<?=$model_car->id?>" value="<?=$model_car->id?>"><?=$name?>
            </label>
        </div>
        <label class="control-label"><?=Yii::t('app','Total')." ".$model_car->name?></label>
        <input type="text" id="quantity_car_<?=$model_car->id?>" class="form-control"
            name="quantity_car_<?=$model_car->id?>"
            value="<?=Yii::$app->session['sale']['quantity_car_'.$model_car->id.'']?>" />
    </div>
    <?php
}
?>
</fieldset>
<?php 
if(Yii::$app->session['total_amount'])
{
echo "<div align='right'><b>".Yii::t('app','All Total Amount').": ". number_format(Yii::$app->session['total_amount'],2)." ກີບ</br></div>";
}

?>
<br />
<div class="form-group">
    <?php
if(count($error_car)==0 && count($error)==0)
{
    echo Html::submitButton('<il class="fa fa-shopping-cart"></il> '.Yii::t('app', 'Confirm Sale'), ['class' => 'btn btn-success']);
}else{
    echo Html::submitButton('<il class="fa fa-shopping-cart"></il> '.Yii::t('app', 'Next'), ['class' => 'btn btn-success']);
}
?>
</div>
<?php ActiveForm::end(); ?>