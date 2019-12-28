<?php
use app\models\Home;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>

<div class="site-index">
    <div class="body-content">
        <div class="row">
            <?php
            $homes=Home::find()->where(['type'=>"Box"])->all();
            foreach($homes as $home)
            {
        ?>
            <div class="col-md-4">
                <div id="titlebg"><?=$home->title?></div>
                <div class="gallery">
                    <img src="<?=Yii::$app->request->baseUrl?>/images/<?=$home->photo?>" class="img-preview">

                    <div style="padding:10px;">
                        <div class="desc"><?=$home->details?></div>
                    </div>
                </div>
            </div>
            <?php
            }
        ?>
        </div>
    </div>
</div>