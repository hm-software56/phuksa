<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\ServiceTicket */

$this->title = Yii::t('app', 'ຂາຍ​ປີ້​ນໍ​າ​ໃຊ້​ພາ​ຫ​ະ​ນະ');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['action' =>isset($_GET['b'])?['service-electric-car/saleticketcar']:""]); ?>
<fieldset class="scheduler-border">
    <legend class="scheduler-border"><?=Yii::t('app','ຂາຍ​ປີ້​ນໍ​າ​ໃຊ້​ພາ​ຫ​ະ​ນະ')?></legend>
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
    $name=$model_car->name." ". Yii::t("app",'ລາ​ຄາ:').number_format($model_car->price,2)." ".Yii::t("app",'​ກີບ')
    ?>
    <div class="col-md-6">
        <div class="checkbox">
            <label>
                <input type="checkbox" <?=(count($error_car)==0)?'disabled':''?>
                    <?=isset(Yii::$app->session['sale_car']['service_electric_car_id_'.$model_car->id.''])?'checked':' '?>
                    name="service_electric_car_id_<?=$model_car->id?>" value="<?=$model_car->id?>"><?=$name?>
            </label>
        </div>
        <label class="control-label"><?=Yii::t('app','​ຈໍ​ຳ​ນວນ')." ".$model_car->name?></label>
        <input type="text" <?=(count($error_car)==0)?'disabled':''?> id="quantity_car_<?=$model_car->id?>"
            class="form-control" name="quantity_car_<?=$model_car->id?>"
            value="<?=Yii::$app->session['sale_car']['quantity_car_'.$model_car->id.'']?>" />
    </div>
    <?php
}
?>
</fieldset>
<?php 
if(Yii::$app->session['total_amount_car'])
{
    echo "<div align='right' style='color:red'><b>".Yii::t('app','​ລວມຈຳ​ນວນ​ເງີນ​ທັງ​ໝົດ').": ". number_format(Yii::$app->session['total_amount_car'],2)." ".Yii::t("app",'​ກີບ')."</br></div>";

}

?>
<br />
<div class="form-group">
    <?php
if(count($error_car)==0)
{
    echo Html::hiddenInput('confirm_sale',true, ['class' => 'form-control']);
?>
    <div class="row">
    </div>
    <div class="col-sm-6 col-md-6" align="left">
        <a class="btn btn-danger btn-sm" href="<?=Url::toRoute(['service-electric-car/saleticketcar','b'=>1])?>">
            <il class="fa fa-backward"></il> <?=Yii::t('app','ກັບ​ຄືນ')?>
        </a></div>
    <div class="col-sm-6 col-md-6" align="right">
        <?=Html::submitButton('<il class="fa fa-shopping-cart"></il> '.Yii::t('app', 'ຢັ້ງ​ຢືນຂາຍ​ປີ້'), ['class' => 'btn btn-success']);?>
    </div>
    <?php
    }else{
    echo Html::submitButton('<il class="fa fa-shopping-cart"></il> '.Yii::t('app', 'ຂາຍ​ປີ້'), ['class' => 'btn btn-success']);
}
?>
</div>
<?php ActiveForm::end(); ?>