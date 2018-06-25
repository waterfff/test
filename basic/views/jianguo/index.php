<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use app\models\JianguoexForm;
use yii\bootstrap\Modal;
//use yii\helpers\Url;



/* @var $this yii\web\View */

$this->title = 'Weishengjin';
$products=$data['products'];
$numofproduct=$data['numofproduct'];
$mix=$data['mix'];
$mixbrandname=$data['mix']['brand_name'];
$miximg=$data['miximg'];
$platform=$data['platform'];
$mix_new=$data['mix']['mix_new'];
//print_r($change_data);exit;
$mix_data['img']=$miximg;
$mix_data['mix']=$mix;

//print_r($data);

$change_data=$data['change_data'];
$type1=$change_data['type1'];
$type2=$change_data['type2'];
$flavor=$change_data['flavor'];
$size=$change_data['size'];
$number2=$change_data['number2'];

if($platform=='ali'){
	if($data['fun']=='sku'){
		$flag='_sku';
	}else{
		$flag='';
	}
}else{
	if($data['fun']=='sku'){
		$flag='jd_sku';
	}else{
		$flag='jd';
	}
}

//echo $flag;exit;
//print_r($fun);exit;

//print_r($data);
$actionID = Yii::$app->controller->action->id;
$controllerID = Yii::$app->controller->id;

?>






<div>
<nav class="navbar-fixed-top" style="padding:70px 20px 60px 30px; width:400px">
		<?php
		$_sidebar = '..\jianguo\_sidebar';
		if($actionID=='explode_sku'||$actionID=='explode'){
         echo $this->render ($_sidebar,['brand_name' => $mixbrandname , 'change_data' => $change_data , 'mix_data'=>$mix_data,'platform'=>'ali','fun'=>$data['fun']]);
		}else{
		 echo $this->render ($_sidebar,['brand_name' => $mixbrandname , 'change_data' => $change_data , 'mix_data'=>$mix_data,'platform'=>'jd','fun'=>$data['fun']]);	
		}
		?>	
</nav>
</div>





<div class="col-lg-10" style="padding:20px 0px 20px 450px;width:1800px" >
<!--<div  style="padding:20px 0px 20px 450px;width:1800px;float:left;" >-->



<form action='/index.php?r=jianguo/add<?php echo $flag?>' method='post' > 
			
			<input type="hidden" name="mix_id"  value="<?php echo $mix['tb_item_id']?>">
			<input type="hidden" name="if_out_alias"  value="<?php echo $numofproduct?>">
			<input type="hidden" name="user_id"  value="<?php echo $id_user?>">
			<input type="hidden" name="mix_alias_bid"  value="<?php echo $mix['alias_bid']?>">		
			<input type="hidden" name="date"  value="<?php echo $mix['date']?>">
			<input type="hidden" name="flavor"  value="<?php echo $mix['flavor']?>">
			<input type="hidden" name="real_id"  value="<?php echo $mix['id']?>">		
			<input type="hidden" name="mix_new"  value="<?php echo $mix['mix']?>">	
			<input type="hidden" name="size"  value="<?php echo $mix['size']?>">	
	

<?php for($j=0;$j<$numofproduct;$j+=3){ ?>
        <div class="row">	 
		<?php
			if($j<3){$r=0;}else{$r+=3;}
			if($numofproduct-3<$r){$top=$numofproduct;}else{$top=$r+3;}
			for($e=$r;$e<$top;$e++){
		?>
		<?php
			$r_str=$products[$e]['tb_item_id'].','.$products[$e]['name'].','.$products[$e]['cid'].','.$products[$e]['alias_bid'].','.$products[$e]['package'].','.$products[$e]['origin'].','.$products[$e]['weight'].','.$products[$e]['series'].','.$products[$e]['flavor'].','.$products[$e]['date'].','.$products[$e]['brand_name'].','.$products[$e]['cname_new'].','.$products[$e]['type1'].','.$products[$e]['type2'].','.$products[$e]['size'].','.$products[$e]['number1'].','.$products[$e]['number2'].','.$products[$e]['sku'].','.$products[$e]['price'].','.$products[$e]['avg_price'].','.$products[$e]['gift'].','.$products[$e]['mix'].','.$products[$e]['flag'].','.$products[$e]['is_shelled'];
			
			$flagbg=1;
			if($type1!=''){
				if($type1==$products[$e]['type1']){
					$flagbg*=1;
				}else{
					$flagbg*=0;
				}
				
				//echo $result1[$e]['type1'];
			}
			if($type2!=''){
				if($type2==$products[$e]['type2']){
					$flagbg*=1;
				}else{
					$flagbg*=0;
				}
			}
			if($flavor!=''){
				if($flavor==$products[$e]['flavor']){
					$flagbg*=1;
				}else{
					$flagbg*=0;
				}
			}
			if($size!=''){
				if($size==$products[$e]['size']){
					$flagbg*=1;
				}else{
					$flagbg*=0;
				}
			}
			if($number2!=''){
				if($number2==$products[$e]['number2']){
					$flagbg*=1;
				}else{
					$flagbg*=0;
				}
			}
				
			if($flagbg==1){ ?>
		
			<div class="col-lg-3" style="background-color:#D0D0D0;">
					
					<input type="hidden" name="r_str<?php echo $products[$e]['id']?>"  value="<?php echo $r_str?>">
					<p><a href="/index.php?r=jianguo%2Fchangeimg&tb_item_id=<?php echo $products[$e]['tb_item_id']?>&platform=<?php echo $platform?>&fun=<?php echo $data['fun']?>">"><img src="<?php if(file_exists("D:/excercise/basic/web/image/image_jianguo/".$products[$e]['tb_item_id'].'.jpg')){echo '/image/image_jianguo/'.$products[$e]['tb_item_id'].'.jpg';  }else if($products[$e]['img']){echo $products[$e]['img'];}else{echo '/image/image_jianguo/mr.png';} ?>" width="300" height="200"></a></p>
					<div style="width:300px ;height:60px"><a href="https://item.taobao.com/item.htm?id=<?php echo $products[$e]['tb_item_id']?>" target="_blank" ><?php echo $products[$e]['name']?></a><?php echo '----avg_price:'.$products[$e]['avg_price']?></div>
					<div style="width:300px ;height:40px"><?php echo $products[$e]['type1'].'   '.$products[$e]['type2'].'   '.$products[$e]['flavor'].'   '.$products[$e]['size'].'g   '.$products[$e]['number2'].'罐';  ?></div>
					<div style="width:300px ;height:20px"><?php echo $products[$e]['series'];echo '  '.$products[$e]['is_shelled'];/*if($products[$e]['is_shelled']==0){ echo "  无壳";}else if($products[$e]['is_shelled']==1){ echo "  有壳";}else{ echo "  其他";}*/ ?></div>
					<p>包含数量：<input type="text" name="<?php echo 'num'.$products[$e]['id']?>">
					<input type="submit" name="addlike<?php echo  $products[$e]['id']?>" value="添加"></p>
					<button  type="button" onclick="add(<?php echo $products[$e]['id']?>)">add</button>
			</div>
			<?php }else{ ?>
			<div class="col-lg-3">
					
					<input type="hidden" name="r_str<?php echo $products[$e]['id']?>"  value="<?php echo $r_str?>">
					<p><a href="/index.php?r=jianguo%2Fchangeimg&tb_item_id=<?php echo $products[$e]['tb_item_id']?>&platform=<?php echo $platform?>&fun=<?php echo $data['fun']?>"><img src="<?php if(file_exists("D:/excercise/basic/web/image/image_jianguo/".$products[$e]['tb_item_id'].'.jpg')){echo '/image/image_jianguo/'.$products[$e]['tb_item_id'].'.jpg';  }else if($products[$e]['img']){echo $products[$e]['img'];}else{echo '/image/image_jianguo/mr.png';} ?>" width="300" height="200"></a></p>
					<div style="width:300px ;height:40px"><a href="https://item.taobao.com/item.htm?id=<?php echo $products[$e]['tb_item_id']?>" target="_blank" ><?php echo $products[$e]['name']?></a><?php echo '----avg_price:'.$products[$e]['avg_price']?></div>
					<div style="width:300px ;height:40px"><?php echo $products[$e]['type1'].'   '.$products[$e]['type2'].'   '.$products[$e]['flavor'].'   '.$products[$e]['size'].'g   '.$products[$e]['number2'].'罐';  ?></div>
					<div style="width:300px ;height:40px"><?php echo $products[$e]['series'];echo '  '.$products[$e]['is_shelled'];/*if($products[$e]['is_shelled']==0){ echo "  无壳";}else if($products[$e]['is_shelled']==1){ echo "  有壳";}else{ echo "  其他";}*/ ?></div>
					<p>包含数量：<input type="text" name="<?php echo 'num'.$products[$e]['id']?>">
					<input type="submit" name="addlike<?php echo  $products[$e]['id']?>" value="添加"></p>
					<button  type="button" onclick="add(<?php echo $products[$e]['id']?>)">add</button>
			</div>
			<?php } ?>
		
		<?php } ?>	
		
           
		</div>      
<?php } ?>

<br><input type="submit" name="explode" value="提交"><input type="submit"  name="new" value="新建"><br>
	<td>
			<input type="radio"  name="has_snacks" value="1">有<input type="radio"  name="has_snacks" value="0" checked="checked">没有
			</td>


</form>
</div>
<script>
function add(id)
{
	alert(id);
	$.ajax({
                url:"/index.php?r=jianguo/newexplode",
                type:"post",
                data:{username:$id},
                success:function(data){
                    window.clearInterval(timer);
                    console.log("over..");
                },
                error:function(e){
                    alert("错误！！");
                    window.clearInterval(timer);
                }
            });    

}
</script>

	

