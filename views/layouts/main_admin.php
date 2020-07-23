<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use app\widgets\Alert;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\UserProfile;
$bundle = yiister\gentelella\assets\Asset::register($this);
AppAsset::register($this);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>">
    <?php $this->beginBody(); ?>
    <div class="container container_admin body">

        <div class="main_container">

            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="/" class="site_title"><img src="<?=Yii::$app->request->baseUrl?>/images/logo.jpg"
                                class="img-circle" width="60" />
                            <span><?=Yii::t('app','ສວນ​ພືກ​ສາ')?></span></a>
                    </div>
                    <div class="clearfix"></div>

                    <br />
                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <hr />
                            <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    [
                                        "label" => Yii::t('app','ຈັດການຂໍ້ມູນເວບໄຊຣ'),
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ເມນູເວບໄຊຣ'),
                                                "url" =>Url::toRoute(['menu/index']),
                                            ],

                                            [
                                                "label" =>Yii::t('app','ຈັດການ ເນື້ອໃນເມນູ'),
                                                "url" =>Url::toRoute(['content/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ເນື້ອໃນໝ້າຫຼັກ'),
                                                "url" =>Url::toRoute(['home/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin")?1:0
                                            ],
                                            
                                        ],
                                    ],

                                    [
                                        "label" => Yii::t('app','ຈັດການຂໍ້ມູນພື້ນຖານ'),
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ຂໍ້ມູນພະນັກງານ'),
                                                "url" =>Url::toRoute(['user/index']),
                                            ],
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ປີ້​ເຂົ້າ​ສວນ​ພືກ​ສາ'),
                                                "url" =>Url::toRoute(['service-ticket/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ປີ້​​ນຳ​ໃຊ້​ພາ​ຫະ​ນະ'),
                                                "url" =>Url::toRoute(['service-electric-car/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ອາ​ຫານ ແລະ ​ເຄື່ອງ​ດື່ມ'),
                                                "url" =>Url::toRoute(['service-food-beverage/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ຈັດການ ສີນ​ຄ້າ'),
                                                "url" =>Url::toRoute(['product/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin")?1:0
                                            ],
                                            
                                            
                                        ],
                                    ],

                                    [
                                        "label" => Yii::t('app','ບໍລິການ'),
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" =>Yii::t('app','ບໍລິການຂາຍ ປີ້​ເຂົ້າ​ສວນ​ພືກ​ສາ'),
                                                "url" =>Url::toRoute(['service-ticket/saleticket']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin" || Yii::$app->user->identity->type=="User")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ບໍລິການຂາຍ ປີ້​​ນຳ​ໃຊ້​ພາ​ຫະ​ນະ'),
                                                "url" =>Url::toRoute(['service-electric-car/saleticketcar']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin" || Yii::$app->user->identity->type=="User")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ບໍລິການຂາຍ ອາ​ຫານ ແລະ ​ເຄື່ອງ​ດື່ມ'),
                                                "url" =>Url::toRoute(['service-food-beverage/sale']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin" || Yii::$app->user->identity->type=="User")?1:0
                                            ],
                                            
                                            
                                        ],
                                    ],

                                    [
                                        "label" => Yii::t('app','ສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                                        "url" => "#",
                                        "icon" => "table",
                                        "items" => [
                                            [
                                                "label" =>Yii::t('app','ສັ່ງ​ຊື້​ສີນ​ຄ້າເຂົ້າ'),
                                                "url" =>Url::toRoute(['product-order/index']),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin" || Yii::$app->user->identity->type=="User")?1:0
                                            ],
                                            [
                                                "label" =>Yii::t('app','ຮັບ​ສີນ​ຄ້າສັ່ງ​ຊື້ເຂົ້າ'),
                                                "url" =>Url::toRoute(['product-order/index','id'=>True]),
                                                'visible' =>(Yii::$app->user->identity->type=="Admin" || Yii::$app->user->identity->type=="User")?1:0
                                            ],
                                            
                                            
                                            
                                            
                                        ],
                                    ],

                                    [
                                        "label" => Yii::t('app','​ລາຍ​ງາຍ'),
                                        "url" => "#",
                                        "icon" => "list",
                                        "items" => [
                                            [
                                                "label" =>Yii::t('app','ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ເ​ຂົ້າ​ສວນ'),
                                                "url" =>Url::toRoute(['report/report','rt'=>'date']),
                                            ],
                                            [
                                                "label" =>Yii::t('app','ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ລົດ​ຳ​ໃຊ້​ທ່ຽວ​ສວນ'),
                                                "url" =>Url::toRoute(['report/reportcar','rt'=>'date']),
                                            ],
                                            [
                                                "label" =>Yii::t('app','ລາຍ​ງານ​ການ​ຂາຍອາ​ຫານ ​ແລະ​ ເຄື່ອງ​ດີ່ມ'),
                                                "url" =>Url::toRoute(['report/reportsfb','rt'=>'date']),
                                            ],
                                            [
                                                "label" =>Yii::t('app','ລາຍ​ງານ​ການສັ່ງ​ຊື້​ສີນ​ຄ້າ​ເຂົ້າ​'),
                                                "url" =>Url::toRoute(['report/reportpod','rt'=>'date']),
                                            ],
                                            
                                        ],
                                    ],
                                ],
                            ]
                        )
                        ?>
                        </div>

                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" title="Settings">
                            <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Lock">
                            <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>
                        <?php
                        if(Yii::$app->user->identity->type=="Admin" || Yii::$app->user->identity->type=="User")
                        {
                        ?>
                            <ul class="nav navbar-nav navbar-left">
                                <li class="">
                                    <a href="<?=Url::toRoute(['service-ticket/saleticket'])?>">
                                        <span class=" fa fa-cart-arrow-down"></span>
                                        <?=Yii::t('app','ຂາຍ​ປີ້​ເຂົ້າ​ສວນ​ພືກ​ສາ')?>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?=Url::toRoute(['service-electric-car/saleticketcar'])?>">
                                        <span class=" fa fa-shopping-cart"></span>
                                        <?=Yii::t('app','ຂາຍ​ປີ້​ລົດ​ນຳ​ໃຊ້​ທ່ຽວ​ສວນ​ພືກ​ສາ')?>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?=Url::toRoute(['service-food-beverage/sale'])?>">
                                        <span class=" fa fa-shopping-bag"></span>
                                        <?=Yii::t('app','ຂາຍ​ອາ​ຫານ ແລະ ເຄື່ອງ​ດື່ມ')?>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="<?=Url::toRoute(['product-order/index'])?>">
                                        <span class=" fa fa-shopping-basket"></span>
                                        <?=Yii::t('app','ສັ່ງ​ຊື້​ສີນ​ຄ້າເຂົ້າ')?>
                                    </a>
                                </li>
                            </ul>
                            <?php
                        }else{
                            ?>
                            <ul class="nav navbar-nav navbar-left">
                                <li class="">
                                    <a href="<?=Url::toRoute(['service-food-beverage/chef'])?>">
                                        <span class=" fa fa-cart-arrow-down"></span>
                                        <?=Yii::t('app','ລາຍ​ການ ອາ​ຫານ​ທີ່​ສັ່ງ​ຊື້')?>
                                    </a>
                                </li>
                            </ul>
                            <?php
                        }
                            ?>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                    aria-expanded="false">
                                    <?php
                                        $profile=UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();
                                        if($profile)
                                        {
                                    ?>
                                    <img src="<?=Yii::$app->request->baseUrl?>/images/<?=$profile->photo?>"
                                        alt=""><?=$profile->first_name?>
                                    <?php
                                        }else{
                                            ?>
                                    <img src="http://placehold.it/128x128" alt="">John Doe
                                    <?php
                                        }
                                    ?>
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu pull-right">
                                    <li><a href="<?=Url::toRoute(['user/profile'])?>"><i
                                                class="fa fa-user-circle-o pull-right"></i><?=Yii::t('app','Profile')?></a>
                                    </li>
                                    <li><a href="<?=Url::toRoute(['/site/logout'])?>"><i
                                                class="fa fa-sign-out pull-right"></i>
                                            <?=Yii::t('app','Log Out')?></a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->

            <!-- page content -->
            <div class="right_col" role="main">
                <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Go!</button>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="clearfix"></div>
                <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
                <?= $content ?>
            </div>
            <!-- /page content -->
            <!-- footer content -->
            <!--<footer>
                <div class="pull-right">
                    Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com" rel="nofollow"
                        target="_blank">Colorlib</a><br />
                    Extension for Yii framework 2 by <a href="http://yiister.ru" rel="nofollow"
                        target="_blank">Yiister</a>
                </div>
                <div class="clearfix"></div>
            </footer> -->
            <!-- /footer content -->
        </div>

    </div>

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>
    <!-- /footer content -->
    <?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>