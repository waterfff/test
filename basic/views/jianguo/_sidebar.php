<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\JianguoexForm;
use yii\bootstrap\Modal;
use yii\helpers\Url;

$this->title = 'Newproduct';
$this->params['breadcrumbs'][] = $this->title;
$model = new  JianguoexForm();
$type1model[$change_data['type1']]=$change_data['type1'];
$type2model[$change_data['type2']]=$change_data['type2'];
$flavormodel[$change_data['flavor']]=$change_data['flavor'];
$sizemodel[$change_data['size']]=$change_data['size'];
$number2model[$change_data['number2']]=$change_data['number2'];
$mix=$mix_data['mix'];
$miximg=$mix_data['img'];
//print_r($mix_data);



$type1model['']='';
$type2model['']='';
$flavormodel['']='';
$sizemodel['']='';
$number2model['']='';


$sql_s1="select distinct(type1) from hengshi.hengshi_product_ali where brand_name='$brand_name'";
$type1=Yii::$app->db->createCommand($sql_s1)->queryAll();
$sql_s2="select distinct(type2) from hengshi.hengshi_product_ali where brand_name='$brand_name'";
$type2=Yii::$app->db->createCommand($sql_s2)->queryAll();
$sql_s3="select distinct(flavor) from hengshi.hengshi_product_ali where brand_name='$brand_name'";
$flavor=Yii::$app->db->createCommand($sql_s3)->queryAll();
$sql_s4="select distinct(size) from hengshi.hengshi_product_ali where brand_name='$brand_name'";
$size=Yii::$app->db->createCommand($sql_s4)->queryAll();
$sql_s5="select distinct(number2) from hengshi.hengshi_product_ali where brand_name='$brand_name'";
$number2=Yii::$app->db->createCommand($sql_s5)->queryAll();



foreach($type1 as $v){
	$type1model[$v['type1']]=$v['type1'];
}
foreach($type2 as $v){
	$type2model[$v['type2']]=$v['type2'];
}
foreach($flavor as $v){
	$flavormodel[$v['flavor']]=$v['flavor'];
}
foreach($size as $v){
	$sizemodel[$v['size']]=$v['size'];
}
foreach($number2 as $v){
	$number2model[$v['number2']]=$v['number2'];
}



//exit;


//print_r($fun);exit;
?>


<script type="text/javascript" src="http://libs.baidu.com/jquery/2.0.0/jquery.js"></script>
<div>
 
	<div>
	<?php if($platform=='ali'){ ?>
		
		<p><a href="https://item.taobao.com/item.htm?id=<?php echo $mix['tb_item_id']?>" target="_blank" ><?php if(isset($fun)&&$fun){echo $mix['name'].'---'.$mix_data['mix']['brand_name'].'---mix:'.$mix_data['mix']['mix'].'---size:'.$mix_data['mix']['size'].'---gift:'.$mix_data['mix']['gift'];}else{ echo $mix['name'].'---'.$mix_data['mix']['flavor'].'---'.$mix_data['mix']['avg_price'];}?></a></p>
	<?php }else{ echo $actionID;?>
		<p><a href="https://item.jd.com/<?php echo $mix['tb_item_id']?>.html" target="_blank" ><?php if(isset($fun)&&$fun){echo $mix['name'].'---'.$mix_data['mix']['brand_name'].'---mix:'.$mix_data['mix']['mix'].'---size:'.$mix_data['mix']['size'].'---gift:'.$mix_data['mix']['gift'];}else{ echo $mix['name'].'---'.$mix_data['mix']['flavor'].'---'.$mix_data['mix']['avg_price'];}?></a></p>
	<?php } ?>
		<p><img id="small" style="" src="<?php echo $miximg?>" width="320" height="210"></p>
		<p><img id="big" style="display:none;" src="<?php echo $miximg?>" width="640" height="420"></p>
		<p></p>
		
	</div>
</div>
<div style="padding:20px 0px 20px 20px;width:250px;">

				
 

                <?php	$actionID = Yii::$app->controller->action->id;
						$controllerID = Yii::$app->controller->id;
						//echo $actionID;
						if($actionID=='explode'and $controllerID=='jianguo'){ 
							$form = ActiveForm::begin(['id' => 'Explode-form','action' => '/index.php?r=jianguo/explode' , 'method' => 'POST']); 
						}else{
							$form = ActiveForm::begin(['id' => 'Explode-form','action' => '/index.php?r=jianguo/explodejd' , 'method' => 'POST']);	
						}
				?>

					<?= $form->field($model, 'flavor')->dropdownList($flavormodel)?>
					<?= $form->field($model, 'type1')->dropdownList($type1model)?>
					<?= $form->field($model, 'type2')->dropdownList($type2model)?>
					<?= $form->field($model, 'size')->dropdownList($sizemodel)?>
					<?= $form->field($model, 'number2')->dropdownList($number2model)?>
	
					<p align="center"><button type="submit" class="btn btn-primary" name="contact-button" style="width:230px;height:35px">检索</button></p>

                <?php ActiveForm::end(); ?>
			
				<?php if($actionID=='explode'and $controllerID=='jianguo'){?>
				 <p align="center"><a class="btn btn-primary" href="/index.php?r=jianguo%2Fchangeimg&platform=ali" style="width:230px;height:35px">上传图片</a></p>
				 <p align="center"><input type="text" name="tb_item_id" id="quickadd" style="width:140px;height:35px"><a class="btn btn-primary" onclick="quickadd('ali')" style="width:80px;height:35px">快速添加</a></p>
				 
				<?php }else{?>
				 <p align="center"><a class="btn btn-primary" href="/index.php?r=jianguo%2Fchangeimg&platform=jd" style="width:230px;height:35px">上传图片</a></p>
				 <p align="center"><input type="text" name="tb_item_id" id="quickadd" style="width:140px;height:35px"><a class="btn btn-primary" onclick="quickadd('jd')" style="width:80px;height:35px">快速添加</a></p>
				 
				<?php } ?>
	
				<?php 
				


				
				?>
				
</div>		

<script>

      function quickadd(platform){
	   
	    var  tb_item_id=document.getElementById("quickadd");
		var  val1=tb_item_id.value ; 
	    //alert(platform);
		if(alert=='ali'){
	    location.href="/index.php?r=jianguo%2Fquickadd&tb_item_id="+val1;
		}else{
		location.href="/index.php?r=jianguo%2Fquickaddjd&tb_item_id="+val1;
		}
	 
	   
	   
	  
	  }
	    
</script>


<SCRIPT  type="text/javascript"> 

$(document).ready(function(){
  $("#small").mouseover(function(){
    $("#small").css("display","none");
	$("#big").css("display","");
  });
  $("#big").mouseout(function(){
    $("#small").css("display","");
	$("#big").css("display","none");
  });
});
</SCRIPT>




