<?php
use bsadnu\googlecharts\AreaChart;
$this->title = Yii::t('app', 'ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ເຂົ້າ​ສວນ​ພຶກ​ສາ');
$this->params['breadcrumbs'][] = $this->title;
?>
<?= AreaChart::widget([
	'id' => 'my-staked-area-chart-id',
	'data' => [
		['Years', Yii::t('app','ວັນຈັນ'), Yii::t('app','ວັນ​ອັງ​ຄານ'), Yii::t('app','ວັນ​ພຸດ'), Yii::t('app','ວັນ​ພະ​ຫັດ') , Yii::t('app','ວັນ​ສຸກ'), Yii::t('app','ວັນ​ເສົາ'), Yii::t('app','ວັນ​ທິດ')],
		['2013',  870,  460, 310, 220, 870,  460, 310,],
		['2014',  460,  720, 220, 460,720, 220, 460],
		['2015',  930,  640, 340, 330,930,  640, 340],
		['2016',  1000,  400, 180, 500,1000,  400, 180]
	],
	'options' => [
		'fontName' => 'Verdana',
		'height' => 400,
		'curveType' => 'function',
		'fontSize' => 12,
		'areaOpacity' => 0.4,
		'chartArea' => [
			'left' => '5%',
			'width' => '90%',
			'height' => 350
		],
		'isStacked' => true,
		'pointSize' => 4,
		'tooltip' => [
			'textStyle' => [
				'fontName' => 'Verdana',
				'fontSize' => 13
			]
		],
		'lineWidth' => 1.5,
		'vAxis' => [
			'title' => 'Number values',
			'titleTextStyle' => [
				'fontSize' => 13,
				'italic' => false
			],        	
			'gridlines' => [
				'color' => '#e5e5e5',
				'count' => 10
			],            	
			'minValue' => 0
		],        
		'legend' => [
			'position' => 'top',
			'alignment' => 'end',
			'textStyle' => [
				'fontSize' => 12
			]
		]            
	]
]) ?>