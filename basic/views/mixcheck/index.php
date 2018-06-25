<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\data\ArrayDataProvider;
use yii\data\ActiveDataProvider;
?>





<?php


foreach($data as $key=>$v){
	if($key>1){
		$filedata[$v['tb_item_id']]=['tb_item_id'=>$v['tb_item_id'],'name'=>$v['name'],'avg'=>$v['avg'],'month'=>$v['month'],];
	}
}
//print_r($filedata);


		
	

	$dataProvider = new ArrayDataProvider([
		'allModels' => $filedata,
		'pagination' => [
			'pageSize' => 25,
		],
		'sort' => [
			'attributes' => ['tb_item_id'],
		],
	]);
	
	
	
	
?>
<div class="col-lg-12">
 <h3>混合装检查</h3>
<?php 
	/*echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			 'tb_item_id',
			 'name',
			 'avg',
			 'month',
			 
			// ['class' => 'yii\grid\CheckboxColumn'],
			 // ...
			[
				'class'      => 'yii\grid\ActionColumn',
				'header'     => '操作',
				'buttons'    => [],

				'urlCreator' => function ($action, $model, $key, $index) {
					switch($action)
					{
						case 'view':
							return '/xxxx/xxxview?id=' . $model->id;
						break;
					}

				},
			],
			
			
			
			
			
		],
	]);*/		
	$actionID = Yii::$app->controller->action->id;
	$controllerID = Yii::$app->controller->id;
	if($actionID)
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			 'tb_item_id',
			 'name',
			 'avg',
			 'month',
			// ['class' => 'yii\grid\CheckboxColumn'],
			 // ...
			/*[
				'class'      => 'yii\grid\ActionColumn',
				'header'     => '操作',
				'buttons'    => [],

				'urlCreator' => function ($action, $model) {
					switch($action)
					{
						case 'view':
							return '/index.php?r=site%2Fcsvobserve' . $model->id;
						break;
						
					}

				},
			],*/
			
			[  
  
				'class' => 'yii\grid\ActionColumn',  
				  
				'template' => '{to_mix}',  
				  
				'header' => '操作',  
				  
				'buttons' => [  
					  
					'to_mix' => function ($url,$filedata, $key) {  
					  
					return Html::a('to_mix', $url, ['title'=> 'to_mix'] );  
					  
					},  
				  
				],  
			  
			], 
			
			
			
		],
	]);
?>		  