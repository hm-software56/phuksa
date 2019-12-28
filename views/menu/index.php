<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\Alert;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Menus');
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
<div class="menu-index">

    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'Create Menu'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'menu_name',
            'link',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->status==1)
                    {
                        return Yii::t('app','Active');
                    }else{
                        return Yii::t('app','Inactive');
                    }
                },
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