<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = Yii::t('app', 'ລາຍ​ງານ​ການ​ຂາຍອາ​ຫານ​ແລະ​ເຄື່ອງ​ດື່ມ​ສວນ​ພຶກ​ສາ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" align="right">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li>   
			<?php
				echo yii\helpers\Html::a('<span class="glyphicon glyphicon-th-large "></span> '.Yii::t('app','ລາຍ​ງານ​ຕ​າມ​ວັນ​ທີ່'),Url::toRoute(['report/reportsfb','rt'=>'date']));
			?> 
			</li>
			<li>
				<?php
					echo yii\helpers\Html::a('<span class="fa fa-cutlery "></span> '.Yii::t('app','ລາຍ​ງານ​ຕ​າມເດືອນ'), Url::toRoute(['report/reportsfb','rt'=>'month']));
				?> 
			</li>
			<li>
				<?php
					echo yii\helpers\Html::a('<span class="fa fa-glass "></span> '.Yii::t('app','ລາຍ​ງານ​ຕ​າມປີ'), Url::toRoute(['report/reportsfb','rt'=>'year']));
					?> 
			</li>
		</ul>
	</div>
</div>
<?php
if($_GET['rt']=="month")
{
	echo $this->render('report_foodbeverage_by_month');
}elseif($_GET['rt']=="year")
{
	echo $this->render('report_foodbeverage_by_year');
}else{
	echo $this->render('report_foodbeverage_by_date');
}
?>
 
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