<?php
use app\models\Home;
use yii\helpers\Url;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index" style="padding:100px;">
    <div class="body-content">
        <div class="row">
            <div class="col-md-4">
                <div id="titlebg"><span class="fa fa-ticket"></span> <?=Yii::t('app','Sale Ticket')?></div>
                <div class="gallery">
                    <a href="<?=Url::toRoute(['service-ticket/saleticket'])?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/images/tk.png" class="img-circle">
                    </a>
                </div>
            </div>
            <div class="col-md-4">
                <div id="titlebg"><span class="fa fa-car"></span> <?=Yii::t('app','Sale Electric Car Ticket')?></div>
                <div class="gallery">
                    <img src="<?=Yii::$app->request->baseUrl?>/images/ec.png" class="img-circle">
                </div>
            </div>
            <div class="col-md-4">
                <div id="titlebg"><span class="fa fa-resistance"></span> <?=Yii::t('app','Sale Food & Drirk')?></div>
                <div class="gallery">
                    <img src="<?=Yii::$app->request->baseUrl?>/images/fd.png" class="img-circle">
                </div>
            </div>
        </div>
    </div>
</div>