<?php
use bsadnu\googlecharts\AreaChart;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
$type_name="...";
if(isset($_GET['type']) && !empty($_GET['type']))
{
	$product=\app\models\Product::find()->where(['id'=>$_GET['type']])->one();
	$type_name=$product->name;
}else{
	$_GET['type']="";
}
?>
<?php $form = ActiveForm::begin(['action'=>Yii::$app->session['report_url'],'method'=>'get']); ?>
<div class="row">
	<div class="col-md-2"><input type="number" min="2019" name="year_start" class="form-control" value="<?=isset($_GET['year_start'])?$_GET['year_start']:''?>" required></div>
	<div class="col-md-1" align="center" style="padding-top:5px"><?=Yii::t('app','ຫາ')?></div>
    <div class="col-md-2"><input type="number" min="2019" name="year_end" class="form-control" value="<?=isset($_GET['year_end'])?$_GET['year_end']:''?>" required></div>
	<div class="col-md-2">
		<select name="type" class="form-control" >
        <option value="" selected><?=Yii::t('app','=== ເລືອກຕາມ​ສີນ​ຄ້າ ===')?></option>
			<?php
			$products=\app\models\Product::find()->all();
			foreach($products as $stk)
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

	<div class="col-md-2"><button type="submit" class="btn btn-success"><il class="fa fa-search"></il> <?=Yii::t('app','ຄົ້ນ​ຫາ')?></button></div>
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
                            <h2><b><?=Yii::t('app','ລາຍ​ງານ​ການສັ່ງ​ຊື້​ສີນ​ຄ້າ​ເຂົ້າ​ສວນ​ພຶກ​ສາ')?></b></h2>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

	<table class="table table-bordered">
		<tr>
			<td colspan="6" align="right"><?=Yii::t('app','ລາຍ​ງານ​ການສັ່ງ​ຊື້​ສີນ​ຄ້າ​ເຂົ້າ​ສວນ​ພຶກ​ສາປີ:')?><?=isset($_GET['year_start'])?date('m/d/Y', strtotime($_GET['year_start'])):date('m/d/Y')?> - <?=isset($_GET['year_end'])?date('m/d/Y', strtotime($_GET['year_end'])):date('m/d/Y')?>, <?=Yii::t('app','ປະ​ເພດ:').$type_name?></td>
		</tr>
		<tr>
			<th><?=Yii::t('app','')?></th>
			<th><?=Yii::t('app','ອານ​ຫານ/​ເ​ຄື່ອງ​ດື່ມ')?></th>
			<th><?=Yii::t('app','ຈຳ​ນວນ')?></th>
			<th><?=Yii::t('app','ລວມລາ​ຄາ')?></th>
		</tr>
		<?php
		$i=0;
		$total=0;
		if(isset($_GET['year_start']) && isset($_GET['year_end']))
		{
			$start =$_GET['year_start'];
			$end = $_GET['year_end'];
			$type=$_GET['type'];
			
		}else{
			$start =date('Y');
			$end = date('Y');
			$type="";
		}
		while($start <= $end)
		{
		 $i++;
		 $connection = Yii::$app->getDb();
		 $sale_fbs = $connection->createCommand('SELECT id FROM product_order WHERE  year(order_date)="'.$start.'" and status="Done"')->queryAll();
		 $id_sal=[0];
		 foreach($sale_fbs as $sale_fb)
		 {
			$id_sal[]=$sale_fb['id'];
		 }
		 if(!empty($type))
		 {
			$bysfb= $connection->createCommand('SELECT itod.*, SUM(price* quatity) as amount, SUM(quatity) as sum_qtt FROM `item_order` as itod WHERE product_order_id IN('.implode(",", $id_sal).') and product_id='.$type.'')->queryAll();
		 }else{
			$bysfb= $connection->createCommand('SELECT itod.*, SUM(price* quatity) as amount, SUM(quatity) as sum_qtt FROM `item_order` as itod WHERE product_order_id IN('.implode(",", $id_sal).') GROUP BY product_id')->queryAll();
		 }
		 
		?>
		<tr>
			<td  colspan="4" style="background-color:#F3F6F7"><b><?=Yii::t('app','ປ​ີ:').$start?></b></td>
		</tr>
		<?php
		if($bysfb && !empty($bysfb[0]['id']))
		{
			$j=0;
			foreach($bysfb as $sfb)
			{
				$j++;
				$total+=$sfb['amount'];
			?>
			<tr>
				<td><?=$j?></td>
				<td><?=$sfb['product_name']?></td>
				<td><?=$sfb['sum_qtt']?></td>
				<td><?=number_format($sfb['amount'],2)?></td>
			</tr>
			<?php
			}
		}else{
		?>
			<tr>
				<td colspan="4" align="center"><?=Yii::t('app','ບໍ່​ມີ​ລາຍການ​ສັ່ງ​ຊື້')?></td>
				
			</tr>
		<?php
		}
		$start =$start+1;
		}
		
		?>
		<tr>
			<td align="right" colspan="3"><b><?=Yii::t('app','ລວ​ມ​​ຈຳ​ນວນ​ເງີນ​ທັງ​ໝົດ')?></b></td>
			<td><b><?=number_format($total,2)?> <?=Yii::t('app','ກີບ')?></b></td>
		</tr>
	</table>
</div>