<?php
use yii\helpers\Html;
use yii\web\UrlManager;
?>
<div class="row table-responsive" id="printableArea">
    <table class="table table-striped" >
        <tr>
        <td colspan="2">
        <img src="<?=\Yii::$app->request->BaseUrl . '/images/logo.jpg'?>" class="img-circle" width="50" />
        </td>
        <td>
            <div align="right">
                <?=Yii::t('app','​ລ​ະ​ຫັດ')?>:<?=Yii::$app->session['sale_code']?>
                <br />
                <?=Yii::t('app','​ວັນ​ທີ່')?>:<?=date('d-m-Y')?>
            </div>
        </td>
        </tr>
        <?php
        $total_prince = 0;
        $pro_id = [];
        if (!empty(\Yii::$app->session['print_sale'])) {
            foreach (\Yii::$app->session['print_sale'] as $order_p=>$quatity) {
                    $product = \app\models\ServiceFoodBeverage::find()->where(['id' =>$order_p])->one();
                ?>
                    <td><?= $product->name ?></td>
                    <td><?=$quatity?></td>
                    <td align="right"><?= number_format($product->sale_price * $quatity, 2) ?> <?=Yii::t('app','ກີບ')?></td>
                </tr>
                <?php
                $total_prince+=$product->sale_price * $quatity;
            }
        }
        ?>
        <tr>
            <td colspan="2" align="right"><b><?=Yii::t('app','ລວມ​ຈຳ​ນວນ​ເງ​ີນ')?></b></td>
            <td align="right">​<b><?= number_format($total_prince, 2) ?> <?=Yii::t('app','ກີບ')?></b></td>
        </tr>
        <tr>
            <td colspan="3" align="right">
                <?=Yii::t('app','ຂໍ​ຂອບ​ໃຈ')?>
            </td>
        </tr>
    </table>
    <div id="load" align='right'></div>
</div>
<?php
if (!empty(\Yii::$app->session['print_sale'])) {
?>
<div class="row lin_pos_b" >
    <div class="col-md-6  col-xs-6">
        <?php
            echo yii\helpers\Html::a('<span class="glyphicon glyphicon-print"></span> ' . Yii::t('app', 'ພີມ​ໃບ​ບີນ'), '#', [
                'onclick' => "printDiv('printableArea')",
                'class' => "btn btn-large bg-red"
            ]);
        
        ?>
    </div>
    <div class="col-md-6 col-xs-6" align="right">
        <?php
        echo yii\helpers\Html::a(Yii::t('app', 'ຂາຍ​ຕໍ່​ໄປ').' <span class="glyphicon glyphicon-forward"></span> ', '#', [
            'onclick' => "
                        $.ajax({
                       type     :'POST',
                       cache    : false,
                       url  : 'index.php?r=service-food-beverage/order&id=next',
                       'beforeSend': function(){
                            $('#load').html('<img src=images/loading.gif width=40 />');
                        },
                       success  : function(response) {
                           $('#output').html(response);
                       }
                       });return false;",
            'class' => "btn btn-large bg-blue"
        ]);
        ?>

    </div>
</div>
<?php
}
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