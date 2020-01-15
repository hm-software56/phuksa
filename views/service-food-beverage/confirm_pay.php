<?php
use yii\helpers\Html;
use yii\web\UrlManager;
?>
<div class="row table-responsive">
    <table class="table table-striped" >
        <?php
        $total_prince = 0;
        $pro_id = [];
        if (!empty(\Yii::$app->session['product'])) {
            foreach (\Yii::$app->session['product'] as $order_p=>$quatity) {
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
    </table>
    <div id="load" align='right'></div>
</div>
<?php
if (!empty(\Yii::$app->session['product'])) {
?>
<div class="row lin_pos_b" >
    <div class="col-md-6  col-xs-6">
        <?php
            echo yii\helpers\Html::a('<span class="glyphicon glyphicon-backward"></span> ' . Yii::t('app', 'ກັບ​ຄືນ'), '#', [
                'onclick' => "
                        $.ajax({
                       type     :'POST',
                       cache    : false,
                       url  : 'index.php?r=service-food-beverage/order&id=null',
                       'beforeSend': function(){
                        $('#load').html('<img src=images/loading.gif width=40 />');
                        },
                       success  : function(response) {
                           $('#output').html(response);
                       }
                       });return false;",
                'class' => "btn btn-large bg-green"
            ]);
        
        ?>
    </div>
    <div class="col-md-6 col-xs-6" align="right">
        <?php
        echo yii\helpers\Html::a('<span class="glyphicon glyphicon-bishop"></span> '. Yii::t('app', 'ຢັ້ງ​ຢືນ​ຈ່າຍ​ເງີນ'), '#', [
            'onclick' => "
                        $.ajax({
                       type     :'POST',
                       cache    : false,
                       url  : 'index.php?r=service-food-beverage/confirmpay&id=1',
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