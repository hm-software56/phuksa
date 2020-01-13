<?php
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Product;
use app\models\ItemOrder;
$script = <<< JS
$(document).ready(function()
{
    
    // Find and remove selected table rows
    $(".delete-row").click(function()
    {
        var row_count = $("#item_details").find('input[name="record[]"]').length;
        var checked_row_count = $('[name="record[]"]:checked').length;
 
        if(row_count != checked_row_count)
        {
            $("#item_details").find('input[name="record[]"]').each(function()
            {
                if($(this).is(":checked"))
                {
                    $(this).parents("#item_details tr").remove();
                }
            });
        }
        else
        {
            alert("All rows can't be deleted");
            return false;
        }
    }); 
}); 
// 
JS;
$this->registerJs($script, View::POS_END);
?>
<div class="container">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style="text-align: left;"><?=Yii::t('app','ລາຍ​ການ​​ສີນ​ຄ້າ')?></th>
                <th style="text-align: right;">
                    <?=Html::a('<span class="fa fa-edit"></span> '.Yii::t('app', 'ເພີ່ມ​ລາຍ​ການ').'', '#', [
                            'onclick' => "
                            $.ajax({
                            type:'POST',
                            cache: false,
                            url:'".Url::toRoute(['product-order/additems'])."',
                            success:function(response) {
                                $('table tbody#item_details').append(response);
                            }
                            });return false;",
                            'class' => 'btn btn-primary btn-sm',
                            ]);?>
                    -
                    <?= Html::button("<il class='fa fa-remove'></il> ".Yii::t('app', '​​ລຶບລາຍ​ການ'), ['class' => 'delete-row btn btn-danger btn-sm']) ?>
                </th>
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
                            </tr>
                            <?php
                            $items=ItemOrder::find()->where(['product_order_id'=>$model->id])->all();
                            if($items){
                                foreach($items as $item)
                                {
                            ?>
                            <tr>
                                <td><input type='checkbox' name='record[]'></td>
                                <td>
                                    <?php
                                    $opt="<option></option>";
                                    foreach(Product::find()->all() as $pd){
                                    if($item->product_id==$pd->id)
                                    {
                                        $opt.="<option value='".$pd->id."' selected>".$pd->name."</option>";
                                    }else{
                                        $opt.="<option value='".$pd->id."'>".$pd->name."</option>";
                                    }
                                    }
                                ?>
                                    <select name='product[]' class='form-control id_pd' required>
                                        <?=$opt?>
                                    </select>
                                </td>
                                <td><input type='number' name='quatity[]' class="form-control" min='1'
                                        value="<?=$item->quatity?>" required>
                                </td>
                                <td><input type="text" name="price[]" class="form-control" value="<?=$item->price?>"
                                        required>
                                </td>
                                <td><input type='text' name='unit[]' class="form-control" value="<?=$item->unit?>"
                                        required></td>

                            </tr>
                            <?php
                                }
                            }else{
                                ?>
                            <tr>
                                <td><input type='checkbox' name='record[]'></td>
                                <td>
                                    <?php
                                    $opt="<option></option>";
                                    foreach(Product::find()->all() as $pd){
                                    $opt.="<option value='".$pd->id."'>".$pd->name."</option>";
                                    }
                                ?>
                                    <select name='product[]' class='form-control id_pd' required>
                                        <?=$opt?>
                                    </select>
                                </td>
                                <td><input type='number' name='quatity[]' class="form-control" min='1' required></td>
                                <td><input type="text" name="price[]" class="form-control money" required></td>
                                <td><input type='text' name='unit[]' class="form-control" required></td>


                            </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>