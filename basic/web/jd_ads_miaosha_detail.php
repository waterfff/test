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

//主页秒杀广告
//爬取ADS
$sql="select gid from jdnew.ads_miaosha_gid_list";
$gidMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
foreach($gidMap as $gid){

    $url="https://ai.jd.com/index_new?app=Seckill&action=pcMiaoShaAreaList&callback=pcMiaoShaAreaList&gid=$gid";//各种列表页面以及部分商品
	$cat_id->set("/{.*}/",$url); 
	$cat_id->go();
	$resultF1 = $cat_id->result[0];
	$jsonMain = json_decode($resultF1[0],true);
	foreach($jsonMain['miaoShaList'] as $brandMiaosha){
		$wareId=$brandMiaosha['wareId'];
		echo $wareId;
		$sql="select sid from jdnew.item where item_id=$wareId;";
		$sid=$pdo->query($sql)->fetch(PDO::FETCH_COLUMN);
		if(!$sid){$sid=0};
		echo "insert into jdnew.ads_miaosha_$month values('$date',0,$wareId,$sid)\n";
		$insert="insert ignore jdnew.ads_miaosha_$month values('$date',0,$wareId,$sid)\n";
		$pdo->exec($insert);
	}
}


//分类目秒杀广告
//爬取ADS
$sql="select cid from jdnew.ads_miaosha_category_list";
$cidMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
//print_r($cidMap);
foreach($cidMap as $cid){
	$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillCategoryGoods&callback=pcSeckillCategoryGoods&id=$cid";
	$cat_id->set("/{.*}/",$url); 
	$cat_id->go();
	$resultF1 = $cat_id->result[0];
	$jsonCate = json_decode($resultF1[0],true);
	foreach($jsonCate['goodsList'] as $cateGoods){
		$type=1;
		$wareId=$cateGoods['wareId'];
		$sql="select sid from jdnew.item where item_id=$wareId;";
		$sid=$pdo->query($sql)->fetch(PDO::FETCH_COLUMN);
		if(!$sid){$sid=0};
		$insert="insert ignore jdnew.ads_miaosha_$month values('$date',$type,$wareId,$sid)\n";
		$pdo->exec($insert);
		echo "$insert\n";
		
		
	}
	
}

//品牌秒杀广告
//爬取ADS
$sql="select brandId from jdnew.ads_miaosha_brand_list where date ='$date'";
$brandIdMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
foreach($brandIdMap as $brandId){
$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillNewBrandGoods&callback=pcSeckillNewBrandGoods&brandId=$brandId";
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
$json_brand_detail = json_decode($resultF1[0],true);
	foreach($json_brand_detail['data']['goodsList'] as $data){
		$type=2;
		$wareId=$data['wareId'];
		$sql="select sid from jdnew.item where item_id=$wareId;";
		$sid=$pdo->query($sql)->fetch(PDO::FETCH_COLUMN);
		if(!$sid){$sid=0};
		$insert="insert ignore jdnew.ads_miaosha_$month values('$date',$type,$wareId,$sid)\n";
		$pdo->exec($insert);
		echo "$insert\n";


	}
}


//品类秒杀广告
//爬取ADS
$sql="select brandId from jdnew.ads_miaosha_pinlei_list where date='$date'";
$brandIdMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
print_r($brandIdMap);
foreach($brandIdMap as $brandId){
	$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillBrandGoods&callback=pcSeckillBrandGoods&brandId=$brandId";
	$cat_id->set("/{.*}/",$url); 
	$cat_id->go();
	$resultF1 = $cat_id->result[0];
	$json_pinlei_detail = json_decode($resultF1[0],true);
	foreach($json_pinlei_detail['data']['brandInfo']['goodsList'] as $data){
		$type=3;
		$wareId=$data['wareId'];
		$sql="select sid from jdnew.item where item_id=$wareId;";
		$sid=$pdo->query($sql)->fetch(PDO::FETCH_COLUMN);
		if(!$sid){$sid=0};
		$insert="insert ignore jdnew.ads_miaosha_$month values('$date',$type,$wareId,$sid)";
		$pdo->exec($insert);
		echo "$insert\n";
	}
}