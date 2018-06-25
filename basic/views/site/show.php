<?php 
	use yii\grid\GridView;
	use yii\data\ArrayDataProvider;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;


//print_r($head);exit;

?>



<p><?= Html::button('返回', ['class' => 'btn-success']) ?></p>

<?php
$dataProvider = new ArrayDataProvider([
		'allModels' => $finaldata,
		'pagination' => [
			'pageSize' => 100,
		],
		'sort' => [
			'attributes' => ['filename'],
		],
	]);
	
	
echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => $head,
	]);
	//print_r($model);
	
	
	
?>
<script type="text/javascript" src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>

<script>
	
	var a = $('.btn-success');
	a.on('click', function () {
	location.href="/index.php?r=site%2Findex";
	});


</script>