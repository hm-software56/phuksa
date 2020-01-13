<?php
use yii\helpers\Url;
use yii\helpers\Html;
$draft=false;
$hrf_draft="#";
$delete=false;
$hrf_delete="#";
$order=false;
$hrf_order="#";
$cancle=false;
$hrf_cancle="#";
$done=false;
$hrf_done="#";

if($model->status=="Draft")
{
    $draft=true;
    $hrf_draft=Url::toRoute(['product-order/update','id'=>$model->id]);
    $delete=true;
    $hrf_delete=Url::toRoute(['product-order/delete','id'=>$model->id]);
    $order=true;
    $hrf_order=Url::toRoute(['product-order/order','id'=>$model->id]);
}
if($model->status=="Order")
{
    $cancle=true;
    $hrf_cancle=Url::toRoute(['product-order/cancle','id'=>$model->id]);
    $done=true;
    $hrf_done=Url::toRoute(['product-order/done','id'=>$model->id]);
}
if($model->status=="Done")
{
    $done=true;
}
?>
<div class="md-stepper-horizontal <?=($model->status=='Done')?"orange":""?>">
    <div class="md-step <?=($draft==true)?"active editable":"done"?>">
        <a href=" <?=$hrf_draft?>">
            <div class="md-step-circle"><span>1</span></div>
            <div class="md-step-title"><?=Yii::t('app', 'ແກ້​ໄຂສັ່ງ​ຊື້')?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </a>
    </div>
    <div class="md-step <?=($delete==true)?"active delete":" "?>">
        <a href=" <?=$hrf_delete?>">
            <div class="md-step-circle "><span class="fa fa-remove"></span></div>
            <div class="md-step-title"><?=Yii::t('app', 'ລຶບສັ່ງ​ຊື້')?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </a>
    </div>
    <div class="md-step <?=($order==true)?"active":" "?>">
        <a href=" <?=$hrf_order?>">
            <div class="md-step-circle"> <span class="fa fa-bookmark"></span></div>
            <div class="md-step-title"><?=Yii::t('app', 'ຢັ້ງ​ຢືນສັ່ງ​ຊື້')?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </a>
    </div>
    <div class="md-step <?=($cancle==true)?"active":" "?>">
        <a href=" <?=$hrf_cancle?>">
            <div class="md-step-circle"><span class="fa fa-exclamation-circle"></span></div>
            <div class="md-step-title"><?=Yii::t('app', 'ຍົກ​ເລີກສັ່ງ​ຊື້')?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </a>
    </div>

    <div class="md-step <?=($done==true)?"active done":" "?>">
        <a href=" <?=$hrf_done?>">
            <div class="md-step-circle"><span class="fa fa-check"></span></div>
            <div class="md-step-title"><?=Yii::t('app', 'ສຳ​ເລັດສັ່ງ​ຊື້')?></div>
            <div class="md-step-bar-left"></div>
            <div class="md-step-bar-right"></div>
        </a>
    </div>
</div>