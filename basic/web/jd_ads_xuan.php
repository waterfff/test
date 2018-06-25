<?php 


function cpdo(){
	$dsn = 'mysql:host=139.196.96.149;dbname=jdnew;port=13306';
	$user_name = 'dataway-rw';
	$user_pw = 'QqHVMhmN*8';

	$pdo = new PDO($dsn, $user_name, $user_pw);
	$pdo->exec("SET NAMES 'utf8'");
	return $pdo;
}

$pdo=cpdo();
$date=date("Y-m-d");
$month=date("Ym");
include 'yggdrasil.php';
$cat_id = new ygdrasil();
$cat_id->initial();

$url="https://www.jd.com/";
$cat_id->set("/  pageConfig.focusData = \[ {.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
preg_match("/{.*}/",$resultF1[0],$json);
$jsonMain = json_decode($json[0],true);
$urlmap[]='https:'.$jsonMain['href'];
$imgmap[]='https:'.$jsonMain['src'];

#	  https://f.3.cn/recommend/focus_gateway/get?pin=&uuid=1523346832360223853076&jda=122270672.1523346832360223853076.1523346832.1523413961.1523424367.3&callback=jsonpFocus&_=1523424557540
$url="https://f.3.cn/recommend/focus_gateway/get?pin=&uuid=1523346832360223853076&jda=122270672.1523346832360223853076.1523346832.1523346832.1523346832.1&callback=jsonpFocus";
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
$jsonNext = json_decode($resultF1[0],true);

foreach($jsonNext['data'] as $value){
	$urlmap[]='https:'.$value[0]['href'];
	$imgmap[]='https:'.$value[0]['src'];
}
foreach($imgmap as $img){
	$insert="insert ignore jdnew.ads_img_new(date,img_url) values('$date','$img')";
	//echo $insert."\n";
	$pdo->exec($insert);
	$select="select id from jdnew.ads_img_new where date='$date' and img_url='$img' ";
	$result=$pdo->query($select)->fetchAll(PDO::FETCH_COLUMN);
	$imgIdMap[]=$result[0];
	//$imgIdMap[]=$pdo->lastInsertId();
}

foreach($urlmap as $key=>$url){
	echo $url."\n";
	$imgid=$imgIdMap[$key];
	$cat_id->set("/<input\s*id=\"vender_id\"\s*type=\"hidden\"\s*value=\"(\d*)\"/",$url); 
	//$cat_id->set("/<input id=\"vender_id\" type=\"hidden\" value=\"(.*)\"/",$url);
	$cat_id->go();
	$resultF1 = $cat_id->result;
	//print_r($resultF1);
	
	if($resultF1[1][0]){
		//echo "66666666\n";
		$sid=$resultF1[1][0];
		$sql="insert ignore ads_xuan_$month(date,location,item_id,sid,img_id) values('$date',1,0,$sid,$imgid)\n";
		echo $sql;
		$pdo->exec($sql);
	}else{
		
	
		$cat_id->set("/<input\s*type=\"hidden\"\s*value=\"([0-9]+)\"\s*id=\"pageInstance_id\"\/>/",$url); 
		//$cat_id->set("/pageInstance_id/",$url); 
		$cat_id->go();
		$resultF1 = $cat_id->result;
		$pageInstance_id=$resultF1[1][0];
		//echo $pageInstance_id."\n";
		
		
		
		
		$cat_id->set("/\/\/item\.jd\.com\/([0-9]+)\.html/",$url); 
		$cat_id->go();
		$resultF1 = $cat_id->result[1];
		$static = $resultF1;
		foreach($static as $staticItem){
			$tail.="('$date',1,$staticItem,0,$imgid),";
		}
		
		//print_r($static);
	
		
		$cat_id->set("/<div\s*class=\"j-module\"\s*module-function=\"secKillTab\" module-param=\"{sucaiId:'([0-9]+)',\s*size:\s*'.*', tabNum:\s*'.*', position:\s*'.*',\s*numForce:\s*'.*'}/",$url); 
		//$cat_id->set("/<script type=\"text\/template\" data-groupid=\"([0-9]+)\" class=\"js-bitemplate\">/",$url); 
		$cat_id->go();
		$resultQ1 = $cat_id->result;
		$sucaiIdsMiaoSha = $resultQ1[1];
		//print_r($sucaiIdsMiaoSha);
		if($sucaiIdsMiaoSha){
			//$sucaiIdsMiaoSha = array_unique($sucaiIdsMiaoSha);
			
			$sucaiId=$sucaiIdsMiaoSha[0];
			$url2="https://api.m.jd.com/client.action?functionId=queryPcBabelProducts&callback=jQuery5477463&body={\"groupId\":\"$sucaiId\",\"size\":\"10\",\"num\":\"3\",\"position\":0,\"pageId\":\"$pageInstance_id\",\"mcChannel\":1,\"avatar\":\"\"}&client=wh5&clientVersion=1.0.0";
			//echo $url2;
			$cat_id->set("/{.*}/",$url2); 
			$cat_id->go();
			$resultF1 = $cat_id->result[0];
			$jsonMain = json_decode($resultF1[0],true);
			//print_r($jsonMain);
			//echo "秒杀商品------------\n";
			foreach($jsonMain['list'] as $goodsList){
				foreach($goodsList['groupInfoList'] as $goods){
					$shopId=$goods['venderId'];
					$itemId=$goods['skuId'];	
					$name=$goods['name'];
					$tail.="('$date',1,$itemId,0,$imgid),";
					//echo $name."\n";
				}
			}
		
		}
		
		$cat_id->set("/<div class=\"j-module\" front-function=\"batchGetProduct\" module-param=\"{size:\s*.*,\s*sucaiId:\s*'([0-9]+)'/",$url); 
		
		$cat_id->go();
		$resultQ1 = $cat_id->result;
		if(!$resultQ1[1]){
			$cat_id->set("/<div class=\"jSortContent\">\s*<script type=\"text\/template\" data-groupid=\"([0-9]+)\" class=\"js-bitemplate\">/",$url); 
			$cat_id->go();
			$resultQ1 = $cat_id->result;
			//echo "??????????????????????\n";
		}
		//print_r($resultQ1);
		$sucaiIds = $resultQ1[1];
		
		//$sucaiIds = array_unique($sucaiIds);
		//print_r($sucaiIds);
		if($sucaiIds){
			//echo "促销商品------------\n";
			$flag=0;
			foreach($sucaiIds as $sucaiId){
				$flag++;
				$idsstr.="$sucaiId,";
				if($flag==15){
					$idsstr=substr($idsstr,0,strlen($idsstr)-1);
					$url1="https://api.m.jd.com/client.action?callback=jQuery603597&body={\"sysCode\":\"chaoshi\",\"ids\":\"$idsstr\",\"currentStageFlag\":\"Y\",\"avatar\":\"\",\"pageId\":\"$pageInstance_id\",\"previewTime\":\"\",\"mcChannel\":1}&functionId=queryPcBabelProducts&client=wh5&clientVersion=1.0.0";
					//echo $url1."\n";
					$cat_id->set("/{.*}/",$url1); 
					$cat_id->go();
					$resultF1 = $cat_id->result[0];
					//print_r($resultF1);
					$jsonMain = json_decode($resultF1[0],true);
					//print_r($jsonMain);
					foreach($jsonMain['list'] as $goodsStat){
						foreach($goodsStat['groupInfoList'][0]['groupInfoList'] as $goods){
							$shopId=$goods['venderId'];
							$itemId=$goods['skuId'];	
							$name=$goods['name'];
							$tail.="('$date',1,$itemId,0,$imgid),";
							//echo $name."\n";
						}
					}
					
					$flag=0;
					$idsstr='';
				}	
			}
			$idsstr=substr($idsstr,0,strlen($idsstr)-1);
			$url1="https://api.m.jd.com/client.action?callback=jQuery603597&body={\"sysCode\":\"chaoshi\",\"ids\":\"$idsstr\",\"currentStageFlag\":\"Y\",\"avatar\":\"\",\"pageId\":\"$pageInstance_id\",\"previewTime\":\"\",\"mcChannel\":1}&functionId=queryPcBabelProducts&client=wh5&clientVersion=1.0.0";
			//echo $url1."\n";
			//echo $url1."\n";
			$cat_id->set("/{.*}/",$url1); 
			$cat_id->go();
			$resultF1 = $cat_id->result[0];
			//print_r($resultF1);
			$jsonMain = json_decode($resultF1[0],true);
			//print_r($jsonMain['list']);
			foreach($jsonMain['list'] as $goodsStat){
				foreach($goodsStat['groupInfoList'][0]['groupInfoList'] as $goods){
					$shopId=$goods['venderId'];
					$itemId=$goods['skuId'];	
					$name=$goods['name'];
					$tail.="('$date',1,$itemId,0,$imgid),";
					//echo $name."\n";
				}
			}
			$flag=0;
			$idsstr='';
		}
		$tail=substr($tail,0,strlen($tail)-1);
		$sql="insert ignore ads_xuan_$month(date,location,item_id,sid,img_id) values $tail\n";	
		echo $sql;
		$pdo->exec($sql);
		$tail='';
			
			
		
		
		
	}
	
	
}


