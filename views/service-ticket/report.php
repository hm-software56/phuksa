<?php
use bsadnu\googlecharts\AreaChart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$this->title = Yii::t('app', 'ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ເຂົ້າ​ສວນ​ພຶກ​ສາ');
$this->params['breadcrumbs'][] = $this->title;
?>
 <?php $form = ActiveForm::begin(['action'=>Url::toRoute('service-ticket/report'),'method'=>'get']); ?>
<div class="row">
	<div class="col-md-2"><input type="date" name="date_start" class="form-control" value="<?=isset($_GET['date_start'])?$_GET['date_start']:''?>" required></div>
	<div class="col-md-2"><input type="date" name="date_end" class="form-control" value="<?=isset($_GET['date_end'])?$_GET['date_end']:''?>" required></div>
	<div class="col-md-2">
		<select name="type" class="form-control" >
			<option value=""></option>
			<?php
			foreach($service_ticket as $stk)
			{
				$selected="";
				if(isset($_GET['type']) && $_GET['type']==$stk->id)
				{
					$selected="selected";
				}
			?>
			<option value=<?=$stk->id?> <?=$selected?>><?=$stk->name?></option>
			<?php
			}
			?>
		</select>
	</div>
	<div class="col-md-3"><button type="submit" class="btn btn-success"><il class="fa fa-search"></il> <?=Yii::t('app','ຄົ້ນ​ຫາ')?></button></div>
	<div class="col-md-3" align="right">
		<a class="btn btn-danger btn-sm" onclick="printDiv('print')">
			<il class="fa fa-print"></il> <?=Yii::t('app','ພີມອອກ')?>
		</a>
	</div>
</div>
<?php ActiveForm::end(); ?>
<div id="print">
	<div id="show_logo" style="display:none">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td width="50">
                        <img src="<?=\Yii::$app->request->BaseUrl . '/images/logo.jpg'?>" class="img-circle"
                            width="80" />
                    </td>
                    <td align="center">
                        <div align="center">
                            <h2><b><?=Yii::t('app','ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ເຂົ້າ​ສວນ​ພຶກ​ສາ')?></b></h2>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

	<table class="table table-bordered">
		<tr>
			<td colspan="6" align="right"><?=Yii::t('app','ລາຍ​ງານ​​ວັນ​ທີ່:')?><?=isset($_GET['date_start'])?date('m/d/Y', strtotime($_GET['date_start'])):date('m/d/Y')?> - <?=isset($_GET['date_end'])?date('m/d/Y', strtotime($_GET['date_end'])):date('m/d/Y')?></td>
		</tr>
		<tr>
			<th>ລດ</th>
			<th><?=Yii::t('app','ເລກ​ທີ່')?></th>
			<th><?=Yii::t('app','ຜູ້​ເຂົ້າ')?></th>
			<th><?=Yii::t('app','ຈຳ​ນວນ')?></th>
			<th><?=Yii::t('app','ລາ​ຄາ')?></th>
			<th><?=Yii::t('app','ລວມ')?></th>
		</tr>
		<?php
		$i=0;
		$total=0;
		foreach($model as $model)
		{
			$i++;
			$total+=$model->price*$model->quantity;
		?>
		<tr>
			<td><?=$i?></td>
			<td><?=$model->order_code?></td>
			<td><?=$model->order_name?></td>
			<td><?=$model->quantity?></td>
			<td><?=number_format($model->price,2)?></td>
			<td><?=number_format($model->price*$model->quantity,2)?></td>
		</tr>
		<?php
		}
		?>
		<tr>
			<td align="right" colspan="5"><b><?=Yii::t('app','ລວ​ມ​​ຈຳ​ນວນ​ເງີນ​ທັງ​ໝົດ')?></b></td>
			<td><b><?=number_format($total,2)?> <?=Yii::t('app','ກີບ')?></b></td>
		</tr>
	</table>
</div>
<script>
function printDiv(divName) {
	document.getElementById("show_logo").style.display = "block";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
	document.getElementById("show_logo").style.display = "none";
}
</script>