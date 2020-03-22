<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            #'type',
            [
                'attribute'=>'type',
                'value'=>function($model)
                {
                    if($model->type=='Admin')
                    {
                        return "ຜູ້​ດຄຸ້ມ​ຄອງລະ​ບົບ";
                    }elseif($model->type=='User'){
                        return "​ພະ​ນັ​ກ​ງານ​ຂາຍ";
                    }else{
                        return "ພະ​ນັ​ກ​ງານ​ຫ​້ອງ​ຄົວ";
                    }
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($model)
                {
                    if($model->status==1)
                    {
                        return "ໃຊ້​ງານ";
                    }else{
                        return "ປິດໃຊ້​ງານ";
                    }
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons' => [
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


</div>