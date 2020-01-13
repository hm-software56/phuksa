<?php
use yii\web\View;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Product;
use kartik\money\MaskMoney;
$opt="<option></option>";
foreach(Product::find()->all() as $pd){
$opt.="<option value='".$pd->id."'>".$pd->name."</option>";
}
?>
<tr>
    <td><input type='checkbox' name='record[]'></td>
    <td>
        <select name='product[]' class='form-control id_pd' required>
            <?=$opt?>
        </select>
    </td>
    <td><input type='number' name='quatity[]' class="form-control" min='1' required></td>
    <td><input type="number" name="price[]" class="form-control" min='1' required></td>
    <td><input type='text' name='unit[]' class="form-control" required></td>
    <td></td>
</tr>