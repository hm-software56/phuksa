<?php
use app\models\Home;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index" style="padding-top:70px;">
    <div class="body-content">
        <div class="row">
            <div class="col-md-3">
                <div id="titlebg"><span class="fa fa-ticket"></span> <?=Yii::t('app','Sale Ticket')?></div>
                <div class="gallery">
                    <a href="<?=Url::toRoute(['service-ticket/saleticket'])?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/images/tk.png" class="img-circle">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div id="titlebg"><span class="fa fa-car"></span> <?=Yii::t('app','Sale Electric Car Ticket')?></div>
                <div class="gallery">
                    <a href="<?=Url::toRoute(['service-electric-car/saleticketcar'])?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/images/ec.png" class="img-circle">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div id="titlebg"><span class="fa fa-resistance"></span> <?=Yii::t('app','Sale Food & Drirk')?></div>
                <div class="gallery">
                    <a href="<?=Url::toRoute(['ervice-food-beverage/sale'])?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/images/fd.png" class="img-circle">
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div id="titlebg"><span class="fa fa-shopping-basket"></span> <?=Yii::t('app','ສັ່ງ​ຊື້​ສີນ​ຄ້າ​​ເຂົ້າ')?></div>
                <div class="gallery">
                    <a href="<?=Url::toRoute(['product-order/index'])?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/images/od.png" class="img-circle">
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>