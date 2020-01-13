<?php
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Product;
$opt="<option></option>";
foreach(Product::find()->all() as $pd){
$opt.="<option value='".$pd->id."'>".$pd->name."</option>";
}
$script = <<< JS
$(document).ready(function()
{
    $('.money').simpleMoneyFormat();

   
    $(".add-row").click(function()
    {  
        var html  = "";
        html+= "<tr><td><input type='checkbox' name='record[]'></td><td>"; 
        html+= "<select name='product[]' class='js-example-basic-single form-control id_pd' >";
        html+= "$opt";
        html+= "</select></td>"; 
        html+= "<td><input type='number' name='quatity[]' class='form-control' min='1'></td>"; 
        html+= "<td><input type='text' name='price[]' class='form-control money' ></td>"; 
        html+= "<td><input type='text' name='unit[]' class='form-control'></td></tr>"; 
 
        $("table tbody#emp_details").append(html);
    });
    // Find and remove selected table rows
    $(".delete-row").click(function()
    {
        var row_count = $("#emp_details").find('input[name="record[]"]').length;
        var checked_row_count = $('[name="record[]"]:checked').length;
 
        if(row_count != checked_row_count)
        {
            $("#emp_details").find('input[name="record[]"]').each(function()
            {
                if($(this).is(":checked"))
                {
                    $(this).parents("#emp_details tr").remove();
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
                                $('table tbody#emp_details').append(response);
                            }
                            });return false;",
                            'class' => 'btn btn-primary btn-sm',
                            ]);?>
                    -
                    <?= Html::submitButton("<il class='fa fa-remove'></il> ".Yii::t('app', '​​ລຶບລາຍ​ການ'), ['class' => 'delete-row btn btn-danger btn-sm']) ?>
                </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered table-striped">
                        <tbody id="emp_details">
                            <tr>
                                <th><?=Yii::t('app','ລ​/ດ')?></th>
                                <th><?=Yii::t('app','ສີນ​ຄ້າ')?></th>
                                <th><?=Yii::t('app','ຈຳ​ນວນ')?></th>
                                <th><?=Yii::t('app','ລາ​ຄາ​ຊື້')?></th>
                                <th><?=Yii::t('app','ຫົວໜ່ວຍ')?></th>
                                <th><?=Yii::t('app','ລວມ')?></th>
                            </tr>
                            <tr>
                                <td><input type='checkbox' name='record[]'></td>
                                <td>
                                    <?php
                                    echo Select2::widget([
                                        'name' => 'product[]',
                                        'data' =>ArrayHelper::map(Product::find()->all(),'id','name'),
                                        'options' => ['placeholder' => 'Select a state ...', 'class'=>'form-control id_pd'],
                                        'pluginOptions' => [
                                            'allowClear' => true
                                        ],
                                    ]);
                                ?>
                                </td>
                                <td><input type='number' name='quatity[]' class="form-control" min='1'></td>
                                <td><input type="text" name="price[]" class="form-control money"></td>
                                <td><input type='text' name='unit[]' class="form-control"></td>
                                <td></td>

                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</div>