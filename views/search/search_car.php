<?php
use bsadnu\googlecharts\AreaChart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = Yii::t('app', 'ຄົ້ນຫາ');
$this->params['breadcrumbs'][] =Yii::t('app', 'ຄົ້ນຫາ');
$this->params['breadcrumbs'][] =Yii::t('app', '​ຂາຍ​ປີ້​ລົດ​ຳ​ໃຊ້​ທ່ຽວ​ສວນ');
?>
<?php $form = ActiveForm::begin(['action'=>['search/searchcar'],'method'=>'get']); ?>
<div class="row">
	<div class="col-md-2"><input type="date" name="date_start" class="form-control" value="<?=isset($_GET['date_start'])?$_GET['date_start']:''?>"></div>
	<div class="col-md-1" align="center" style="padding-top:5px"><?=Yii::t('app','ຫາ')?></div>
    <div class="col-md-2"><input type="date" name="date_end" class="form-control" value="<?=isset($_GET['date_end'])?$_GET['date_end']:''?>" ></div>
	<div class="col-md-2">
    <input type="text" name="no_number" class="form-control" value="<?=isset($_GET['no_number'])?$_GET['no_number']:''?>" placeholder="ເລກ​ທີ່" >
	</div>
	<div class="col-md-2"><button type="submit" class="btn btn-success"><il class="fa fa-search"></il> <?=Yii::t('app','ຄົ້ນ​ຫາ')?></button></div>
	
</div>
<?php ActiveForm::end(); ?>
<div id="print">
	<table class="table table-bordered">
		<tr>
			<th>ລດ</th>
			<th><?=Yii::t('app','ເລກ​ທີ່')?></th>
			<th><?=Yii::t('app','ປະ​ເພດ​ປີ້ລົດ')?></th>
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