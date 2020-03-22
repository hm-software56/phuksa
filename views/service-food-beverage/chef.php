<?php
use yii\helpers\Html;
if(count($model)<=0)
{
    echo "<br/><br/><br/><br/><br/><h1 class='text-center'>".Yii::t('app', 'ບໍ່​ມີ​ລາຍ​ການ​ໃຫ້​ຄົວ.!')."</h1>";
}
?>

<table class="table">
    <?php
    $i=0;
    foreach($model as $model)
    {
    ?>
    <thead>
        <tr class="bg-warning">
            <th>ລະ​ຫັດ: <?=$model->code_sale?>, ເວ​ລາ: <?=$model->date?></th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>
            <table class="table">
                <thead>
                    <tr>
                        <th>​ຊື່​ລາຍ​ການອາ​ຫານ</th>
                        <th>ຈຳ​ນວນ</th>
                        <th>
                        <div align="right">
                            <?= Html::a("<il class='fa fa-plus-circle'></il> ". \Yii::t('app', 'ຄົວ​ສ​ຳ​ເລັດ'), ['chef','id'=>$model->id], ['class' => 'btn btn-danger','data-method' => 'POST']) ?>
                        </div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $items=\app\models\ItemFoodBeverage::find()->joinWith('serviceFoodBeverage')->where(['sale_food_beverage_id'=>$model->id])->andWhere(['type'=>'Food'])->all();
                    foreach($items as $item)
                    {
                    ?>
                    <tr>
                        <td scope="row"><?=$item->name?></td>
                        <td><?=$item->quantity?></td>
                        <td></td>
                    </tr>
                    <?php
                        }
                    ?>
                </tbody>
            </table>
    
            </td>
        </tr>
    </tbody>
    <?php
    }
    ?>
</table>