<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\Alert;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Orders');
$this->params['breadcrumbs'][] = $this->title;

if(Yii::$app->session->hasFlash('yes')){
    echo Alert::widget([
        'type' =>Alert::TYPE_SUCCESS,
        'title' => Yii::t('app','Well done!'),
        'icon' => 'fas fa-ok-circle',
        'body' =>Yii::$app->session->getFlash('yes'),
        'showSeparator' => true,
        'delay' => 2000
    ]);
}
?>
<div class="product-order-index">

    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'ສັ່ງ​ຊື້​ສີນ​ຄ້າ'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'order_code',
                'label'=>Yii::t('app','ລະ​ຫັດ​ສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                'format' => 'raw',
                'value' =>function($data) {
                   return $data->order_code;
                }
            ],
            [
                'attribute' => 'status',
                'label'=>Yii::t('app','ສະ​ຖາ​ນະສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                'format' => 'raw',
                'filter'=>['Draft'=>'​ຮ່າງ​ການ​ສັ່ງ​ຊື້','Order'=>'​ລໍ​ຖ້າ​ການ​ສັ່ງ​ຊື້','Done'=>'ສຳ​ເລັດສັ່ງ​ຊື້','Cancle'=>'ຍົກ​​ເລີກສັ່ງ​ຊື້'],
                'value' =>function($data) {
                    if($data->status=="Draft"){
                        return Yii::t('app','​ຮ່າງ​ການ​ສັ່ງ​ຊື້');
                    }elseif($data->status=="Order"){
                        return Yii::t('app','​ລໍ​ຖ້າ​ການ​ສັ່ງ​ຊື້');
                    }elseif($data->status=="Cancle"){
                        return Yii::t('app','ຍົກ​​ເລີກສັ່ງ​ຊື້');
                    }else{
                        return Yii::t('app','ສຳ​ເລັດສັ່ງ​ຊື້');
                    }
                }
            ],
            
            [
                'attribute' => 'order_date',
                'label'=>Yii::t('app','ວັນ​ທີ່ສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                'format' => 'raw',
                'filter'=>\yii\jui\DatePicker::widget(['language' => 'en', 'dateFormat' => 'dd-MM-yyyy','options' => ['class' => 'form-control']]),
                'value' =>function($data) {
                    return date('d-m-Y',strtotime($data->order_date));
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{view} {update} {delete}',
                'visibleButtons' => [
                    'delete' => function ($model) {
                        return ($model->status=="Draft")?true:false;
                     },
                     'update' => function ($model) {
                        return ($model->status=="Draft")?true:false;
                     }
                    ],
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>', $url, [
                                    'class' => 'btn btn-primary btn-xs',
                                    ]
                        );
                    },
                    'update' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-edit"></span>', $url, [
                                    'class' => 'btn btn-success btn-xs',
                                    ]
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'data-method' => "post",
                                    'data-confirm' => Yii::t('app', 'Are you want to delete this item.?'),
                                    'class' => 'btn btn-danger btn-xs',
                                    ]
                        );
                    },
                ],
                'contentOptions' => ['style' => 'width: 120px'],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>