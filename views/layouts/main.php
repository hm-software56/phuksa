<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;
use app\models\Home;
use app\models\Menu;
use yii\helpers\Url;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>

    <div class="wrap">
        
        <div class="container" id="pdd">
            <?php
                NavBar::begin([
                    'brandLabel' =>Yii::t('app','ສວນ​ພຶກ​ສາ'),
                    'brandUrl' => Yii::$app->homeUrl,
                    'options' => [
                        'class' => 'navbar-inverse',
                    ],
                ]);
                $menus=Menu::find()->where(['status'=>1])->all();
                $menuItems=[];
                foreach($menus as $menu)
                {
                    if(is_numeric($menu->link)){
                        $url=Url::to(['site/detail','id'=>$menu->link]);
                    }else{
                        $url=Url::to([$menu->link]);
                    }
                    
                    $menuItems[]=['label' =>$menu->menu_name, 'url' =>$url];
                }
                if (Yii::$app->user->isGuest) {
                    $menuItems[] = ['label' =>Yii::t('app','​ເຂົ້າ​ລະ​ບົບ'), 'url' => ['/site/login']];
                } else {
                    $menuItems[] = '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>';
                }
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => $menuItems,
                ]);
                NavBar::end();
            ?>
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <?php
                    $slides=Home::find()->where(['type'=>'Slide'])->all();
                ?>
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <?php 
                    $i=0;
                        foreach($slides as $slide)
                        {
                            $act="";
                            if($i==0)
                            {
                                $act="active";
                            }
                            ?>
                    <li data-target="#myCarousel" data-slide-to="0" class="<?=$act?>"></li>
                    <?php
                    $i++;
                        }
                    ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <?php 
                    $i=0;
                        foreach($slides as $slide)
                        {
                            $i++;
                            $act="";
                            if($i==1)
                            {
                                $act="active";
                            }
                            ?>
                    <div class="item <?=$act?>">
                        <img src="<?=Yii::$app->request->baseUrl?>/images/<?=$slide->photo?>" style="width:100%;">
                    </div>
                    <?php 
                        }
                    ?>
                </div>

                <!-- Left and right controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
        <div class="container">
            <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>