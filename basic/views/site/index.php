<?php
	use yii\grid\GridView;
	use yii\data\ArrayDataProvider;
	use yii\data\ActiveDataProvider;
	use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
//print_r($data);
//echo $data['wsali']['finishle'];
?>




<div class="site-index">

	
    <div class="body-content">

        <div class="row">
            <div class="col-lg-6">
                <h3>阿里卫生巾</h3>

                <p>本月混合装总量:<canvas id="myCanvas" height="10" width="170"></canvas><?php echo $data['wsal']['allnum'];?><p>
				<p>已完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvas1"  height="10" width="170"></canvas><?php echo $data['wsal']['finishnum'];?></p>
				<p>未完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvas2"  height="10" width="170"></canvas><?php echo $data['wsal']['notnum'];?></p>
				<p>跳过:&emsp;&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvas3"  height="10" width="170"></canvas><?php echo $data['wsal']['skipnum'];?></p>
                <p><a class="btn btn-default" href="/index.php?r=weishengjin%2Fexplode">前往 &raquo;</a></p>
            </div>
            <div class="col-lg-6">
                <h3>京东卫生巾</h3>

                <p>本月混合装总量:<canvas id="myCanvasjd" height="10" width="170"></canvas><?php echo $data['wsjd']['allnum'];?><p>
				<p>已完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjd1"  height="10" width="170"></canvas><?php echo $data['wsjd']['finishnum'];?></p>
				<p>未完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjd2"  height="10" width="170"></canvas><?php echo $data['wsjd']['notnum'];?></p>
				<p>跳过:&emsp;&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjd3"  height="10" width="170"></canvas><?php echo $data['wsjd']['skipnum'];?></p>
                <p><a class="btn btn-default" href="/index.php?r=weishengjin%2Fexplodejd">前往 &raquo;</a></p>
            </div>
			
			
			
			
			
            <div class="col-lg-6">
                <h3>阿里坚果</h3>

                <p>本月混合装总量:<canvas id="myCanvasjg" height="10" width="170"></canvas><?php echo $data['jgal']['allnum'];?><p>
				<p>已完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjg1"  height="10" width="170"></canvas><?php echo $data['jgal']['finishnum'];?></p>
				<p>未完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjg2"  height="10" width="170"></canvas><?php echo $data['jgal']['notnum'];?></p>
				<p>跳过:&emsp;&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjg3"  height="10" width="170"></canvas><?php echo $data['jgal']['skipnum'];?></p>

                <p><a class="btn btn-default" href="">前往 &raquo;</a></p>
            </div>
			<div class="col-lg-6">
                <h3>京东坚果</h3>

                <p>本月混合装总量:<canvas id="myCanvasjgjd" height="10" width="170"></canvas><?php echo $data['jgjd']['allnum'];?><p>
				<p>已完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjgjd1"  height="10" width="170"></canvas><?php echo $data['jgjd']['finishnum'];?></p>
				<p>未完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjgjd2"  height="10" width="170"></canvas><?php echo $data['jgjd']['notnum'];?></p>
				<p>跳过:&emsp;&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjgjd3"  height="10" width="170"></canvas><?php echo $data['jgjd']['skipnum'];?></p>

                <p><a class="btn btn-default" href="">前往 &raquo;</a></p>
            </div>
			
        </div>
		
		<div class="row">			
			
            <div class="col-lg-6">
                <h3>阿里坚果SKU</h3>

                <p>本月混合装总量:<canvas id="myCanvasjgsku" height="10" width="170"></canvas><?php echo $data['jgalsku']['allnum'];?><p>
				<p>已完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjg1sku"  height="10" width="170"></canvas><?php echo $data['jgalsku']['finishnum'];?></p>
				<p>未完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjg2sku"  height="10" width="170"></canvas><?php echo $data['jgalsku']['notnum'];?></p>
				<p>跳过:&emsp;&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjg3sku"  height="10" width="170"></canvas><?php echo $data['jgalsku']['skipnum'];?></p>

                <p><a class="btn btn-default" href="">前往 &raquo;</a></p>
            </div>
			<div class="col-lg-6">
                <h3>京东坚果SKU</h3>

                <p>本月混合装总量:<canvas id="myCanvasjgjdsku" height="10" width="170"></canvas><?php echo $data['jgjdsku']['allnum'];?><p>
				<p>已完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjgjd1sku"  height="10" width="170"></canvas><?php echo $data['jgjdsku']['finishnum'];?></p>
				<p>未完成:&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjgjd2sku"  height="10" width="170"></canvas><?php echo $data['jgjdsku']['notnum'];?></p>
				<p>跳过:&emsp;&emsp;&emsp;&emsp;&emsp;<canvas id="myCanvasjgjd3sku"  height="10" width="170"></canvas><?php echo $data['jgjdsku']['skipnum'];?></p>

                <p><a class="btn btn-default" href="">前往 &raquo;</a></p>
            </div>
			
        </div>
		
<div class="row">
<?php
$dir="/excercise/basic/web/excel/"	;
$file = scandir($dir);


foreach($file as $key=>$v){
	if($key>1){
		$filedata[$v]=['filename'=>$v,];
	}
}



//print_r($filedata);		
	

	$dataProvider = new ArrayDataProvider([
		'allModels' => $filedata,
		'pagination' => [
			'pageSize' => 5,
		],
		'sort' => [
			'attributes' => ['filename'],
		],
	]);
	
	
	
	
?>
<div class="col-lg-10">
 <h3>报表下载</h3>
<?php 
//$model=array('1','2','3');
	echo GridView::widget([
		'dataProvider' => $dataProvider,
		'columns' => [
			 'filename',
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
				  
				'template' => ' {view} {download}',  
				  
				'header' => '操作',  
				  
				'buttons' => [  
					  
					'download' => function ($url,$filedata, $key) {  
					  
					return Html::a('/download', $url, ['title'=> 'download'] );  
					  
					},  
				  
				],  
			  
			], 
			
			
			
		],
	]);
	//print_r($model);
	
	
	
?>		   
		</div>

    </div>

</div>



<script type="text/javascript">
var fnle=<?php echo $data['wsal']['finishle'];?>;
var notle=<?php echo $data['wsal']['notle'];?>;
var skiple=<?php echo $data['wsal']['skiple'];?>;
var canvas=document.getElementById('myCanvas');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#2894FF';
ctx.fillRect(0,0,150,10);




var canvas=document.getElementById('myCanvas1');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#00BB00';
ctx.fillRect(0,0,fnle,10);

var canvas=document.getElementById('myCanvas2');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,notle,10);

var canvas=document.getElementById('myCanvas3');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FFD306';
ctx.fillRect(0,0,skiple,10);


var fnle=<?php echo $data['wsjd']['finishle'];?>;
var notle=<?php echo $data['wsjd']['notle'];?>;
var skiple=<?php echo $data['wsjd']['skiple'];?>;

var canvas=document.getElementById('myCanvasjd');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#2894FF';
ctx.fillRect(0,0,150,10);


var canvas=document.getElementById('myCanvasjd1');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#00BB00';
ctx.fillRect(0,0,fnle,10);

var canvas=document.getElementById('myCanvasjd2');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,notle,10);

var canvas=document.getElementById('myCanvasjd3');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FFD306';
ctx.fillRect(0,0,skiple,10);




var fnle=<?php echo $data['jgal']['finishle'];?>;
var notle=<?php echo $data['jgal']['notle'];?>;
var skiple=<?php echo $data['jgal']['skiple'];?>;

var canvas=document.getElementById('myCanvasjg');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#2894FF';
ctx.fillRect(0,0,150,10);


var canvas=document.getElementById('myCanvasjg1');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#00BB00';
ctx.fillRect(0,0,fnle,10);

var canvas=document.getElementById('myCanvasjg2');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,notle,10);

var canvas=document.getElementById('myCanvasjg3');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FFD306';
ctx.fillRect(0,0,skiple,10);




var fnle=<?php echo $data['jgjd']['finishle'];?>;
var notle=<?php echo $data['jgjd']['notle'];?>;
var skiple=<?php echo $data['jgjd']['skiple'];?>;

var canvas=document.getElementById('myCanvasjgjd');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#2894FF';
ctx.fillRect(0,0,150,10);


var canvas=document.getElementById('myCanvasjgjd1');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#00BB00';
ctx.fillRect(0,0,fnle,10);

var canvas=document.getElementById('myCanvasjgjd2');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,notle,10);

var canvas=document.getElementById('myCanvasjgjd3');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FFD306';
ctx.fillRect(0,0,skiple,10);




var fnle=<?php echo $data['jgalsku']['finishle'];?>;
var notle=<?php echo $data['jgalsku']['notle'];?>;
var skiple=<?php echo $data['jgalsku']['skiple'];?>;

var canvas=document.getElementById('myCanvasjgsku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#2894FF';
ctx.fillRect(0,0,150,10);


var canvas=document.getElementById('myCanvasjg1sku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#00BB00';
ctx.fillRect(0,0,fnle,10);

var canvas=document.getElementById('myCanvasjg2sku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,notle,10);

var canvas=document.getElementById('myCanvasjg3sku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FFD306';
ctx.fillRect(0,0,skiple,10);




var fnle=<?php echo $data['jgjdsku']['finishle'];?>;
var notle=<?php echo $data['jgjdsku']['notle'];?>;
var skiple=<?php echo $data['jgjdsku']['skiple'];?>;

var canvas=document.getElementById('myCanvasjgjdsku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#2894FF';
ctx.fillRect(0,0,150,10);


var canvas=document.getElementById('myCanvasjgjd1sku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#00BB00';
ctx.fillRect(0,0,fnle,10);

var canvas=document.getElementById('myCanvasjgjd2sku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FF0000';
ctx.fillRect(0,0,notle,10);

var canvas=document.getElementById('myCanvasjgjd3sku');
var ctx=canvas.getContext('2d');
ctx.fillStyle='#FFD306';
ctx.fillRect(0,0,skiple,10);





</script>
