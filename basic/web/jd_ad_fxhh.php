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


$url="https://ai.jd.com/index_new.php?app=Discovergoods&action=getDiscZdmGoodsListHead&callback=bannerCallback";
$cat_id->set("/{.*}/",$url); 
$cat_id->go();	
$resultF1 = $cat_id->result[0];
$jsonMain = json_decode($resultF1[0],true);

foreach($jsonMain['tabList'] as $value){
	$id=$value['id'];
	$pageNum=1;
	$list=array('999');
	while($list&&$pageNum<100){
		$url="https://ai.jd.com/index_new.php?app=Discovergoods&action=getDiscZdmGoodsList&callback=listCallback&type=goods&tabId=$id&page=$pageNum";
		echo $url."\n";
		$cat_id->set("/{.*}/",$url); 
		$cat_id->go();	
		$resultF2 = $cat_id->result[0];
		$jsonDetail = json_decode($resultF2[0],true);
		$list=$jsonDetail['list'];
		if($list){
			$tail='';
			foreach($list as $detail){
				$item_id=$detail['id'];
				$tail.="('$date',1,$item_id),";
			}
			$tail=substr($tail,0,strlen($tail)-1);
			$sql="insert ignore ads_zhannei_$month(date,location,item_id) values $tail";
			echo $sql."\n";
			$pdo->exec($sql);
		}
		$pageNum++;
	}
	
}


