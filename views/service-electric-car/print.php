<?php
use yii\helpers\Url;
?>
<script>
function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}
</script>
<div class="container-fluid">
    <div class="row centered">
        <div class="col-sm-3 col-md-3"></div>
        <div class="col-sm-6 col-md-6" id="printableArea">
            <div class="row" id="printPageButton">
                <div class="col-sm-6 col-md-6">
                    <a class="btn btn-primary btn-sm" href="<?=Url::toRoute('service-electric-car/saleticketcar')?>">
                        <il class="fa fa-backward"></il> <?=Yii::t('app','ຂາຍ​ປິິ້​ໃໝ່')?>
                    </a>
                </div>
                <div class="col-sm-6 col-md-6" align="right">
                    <a class="btn btn-danger btn-sm" onclick="printDiv('printableArea')">
                        <il class="fa fa-print"></il> <?=Yii::t('app','ພີມ​ປີ້')?>
                    </a>
                </div>
            </div>
            <?php
foreach($model_car as $model_car)
{
    if(isset($dataprint['service_electric_car_id_'.$model_car->id.'']))
    {
            ?>
            <table class="table">
                <tbody>
                    <tr>
                        <td width="50">
                            <img src="<?=\Yii::$app->request->BaseUrl . '/images/logo.jpg'?>" class="img-circle"
                                width="50" />
                        </td>
                        <td align="centr">
                            <div align="centr">
                                <h2><b><?=Yii::t('app','ປີ້')?><?=$model_car->name?><?=Yii::t('app','ສວນ​ພຶກ​ສາ')?> </b>
                                </h2>
                            </div>
                        </td>
                        <td>

                            <div align="right">
                                <?=Yii::t('app','​ລ​ະ​ຫັດ')?>:<?=$model_car->code?>-<?=$dataprint['order_code_car_'.$model_car->id.'']?>
                                <br />
                                <?=Yii::t('app','​ວັນ​ທີ່')?>:<?=date('d-m-Y')?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <?=Yii::t('app','ຈ​ຳ​ນວນ​ຄັນ')?> <?=$model_car->name?> :
                            <?=$dataprint['quantity_car_'.$model_car->id.'']?> <?=Yii::t('app','ຄັນ')?>
                            <br /><br /><b>
                                <?=Yii::t('app','ລວມຈ​ຳ​ນວນ​ເງີນ​')?>:
                                <?=number_format($model_car->price*$dataprint['quantity_car_'.$model_car->id.''])?>
                                <?=Yii::t('app','ກີບ')?>
                            </b><br /><br />
                            <div align="right"><?=$model_car->remark?></div>
                        </td>
                    </tr>

                </tbody>
            </table>
            <?php
    }
}
?>
        </div>
        <div class="col-sm-3 col-md-3"></div>
    </div>
</div>