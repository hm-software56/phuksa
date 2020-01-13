<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\helpers\ArrayHelper;
use app\models\Product;
use app\models\ItemOrder;
use kartik\alert\Alert;

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

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
echo $this->render('step_order',['model'=>$model]);
?>
<?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'order_code',
                'label'=>Yii::t('app','ລະ​ຫັດ​ສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                'format' => 'raw',
                'value' =>$model->order_code,
            ],
            [
                'attribute' => 'order_date',
                'label'=>Yii::t('app','ວັນ​ທີ່ສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                'format' => 'raw',
                'value' =>date('d-m-Y',strtotime($model->order_date)),
            ],
            [
                'attribute' => 'status',
                'label'=>Yii::t('app','ສະ​ຖາ​ນະສັ່ງ​ຊື້​ສີນ​ຄ້າ'),
                'format' => 'raw',
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
        ],
    ]) ?>
<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="text-align: left;"><?=Yii::t('app','ລາຍ​ການ​​ສີນ​ຄ້າ')?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered table-striped">
                        <tbody id="item_details">
                            <tr>
                                <th><?=Yii::t('app','ລ​/ດ')?></th>
                                <th><?=Yii::t('app','ສີນ​ຄ້າ')?></th>
                                <th><?=Yii::t('app','ຈຳ​ນວນ')?></th>
                                <th><?=Yii::t('app','ລາ​ຄາ​ຊື້/ກີບ')?></th>
                                <th><?=Yii::t('app','ຫົວໜ່ວຍ')?></th>
                                <th><?=Yii::t('app','ລວມ/ກີບ')?></th>
                            </tr>
                            <?php
                            $items=ItemOrder::find()->where(['product_order_id'=>$model->id])->all();
                            $total_amount=0;
                            if($items){
                                $i=0;
                                foreach($items as $item)
                                {
                                    $i++;
                                    $total_amount+=$item->price*$item->quatity;
                            ?>
                            <tr>
                                <td><?=$i?></td>
                                <td><?=$item->product_name?></td>
                                <td><?=$item->quatity?></td>
                                <td><?=number_format($item->price,2)?></td>
                                <td><?=$item->unit?></td>
                                <td><?=number_format($item->price*$item->quatity,2)?></td>

                            </tr>
                            <?php
                                }
                            }
                            ?>
                            <tr>
                                <td colspan="5">
                                    <div align="right"><b><?=Yii::t('app','ລວມ​​ຈຳ​ນວນ​ເງີນ​ທັງ​ໝົດ')?></b></div>
                                </td>
                                <td><b><?=number_format($total_amount,2)?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>