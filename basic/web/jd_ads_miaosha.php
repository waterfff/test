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
include 'yggdrasil.php';
$cat_id = new ygdrasil();
$cat_id->initial();





//主页秒杀广告
//爬取LIST
$url="https://ai.jd.com/index_new?app=Seckill&action=pcMiaoShaAreaList&callback=pcMiaoShaAreaList";//各种列表页面以及部分商品
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
$jsonMain = json_decode($resultF1[0],true);
print_r($json_main);
foreach($jsonMain['groups'] as $brandMiaosha){
	$gid=$brandMiaosha['gid'];
	$name=$brandMiaosha['name'];	
	echo "insert into jdnew.ads_miaosha_gid_list values($gid,'$name')\n";
	$insert="insert ignore jdnew.ads_miaosha_gid_list values($gid,'$name');";
	$pdo->exec($insert);
}



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
		echo "insert into jdnew.ads_miaosha_201803 values('$date',0,$wareId,$sid)\n";
		$insert="insert ignore jdnew.ads_miaosha_201803 values('$date',0,$wareId,$sid)\n";
		$pdo->exec($insert);
	}
}
	
	
}





//分类目秒杀广告

//爬取LIST
$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillCategory&callback=pcSeckillCategory&_=1522206181136";//类目URL
//https://ai.jd.com/index_new?app=Seckill&action=pcSeckillCategoryGoods&callback=pcSeckillCategoryGoods&id=29&_=1522219846214//对应类目的商品json
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
$jsonCate = json_decode($resultF1[0],true);
print_r($jsonCate);
foreach($jsonCate['categories'] as $cateMiaosha){
	$cateId=$cateMiaosha['cateId'];
	$categoryName=$cateMiaosha['categoryName'];
	$insert="insert ignore jdnew.ads_miaosha_category_list values($cateId,'$categoryName');";
	//$pdo->exec($insert);
}


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
		$insert="insert ignore jdnew.ads_miaosha_201803 values('$date',$type,$wareId,$sid)\n";
		$pdo->exec($insert);
		echo "$insert\n";
		
		
	}
	
}




//品牌秒杀广告

//爬取LIST
//$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillNewBrand&callback=pcSeckillNewBrand&_=1522206425618";//品牌页面列表
$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillNewBrand&callback=pcSeckillNewBrand";
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
$json_brand = json_decode($resultF1[0],true);
//print_r($json_brand);
foreach($json_brand['data']['list'] as $data){
	$brandName=$data['brandName'];
	$title=$data['title'];
	$brandIdOld=$data['brandIdOld'];
	$brandId=$data['id'];
	$insert="insert ignore jdnew.ads_miaosha_brand_list values($brandId,$brandIdOld,\"$brandName\",\"$title\",'$date')";
	$pdo->exec($insert);
	echo "$insert\n";
}


//爬取ADS
$sql="select brandId from jdnew.ads_miaosha_brand_list";
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
	$insert="insert ignore jdnew.ads_miaosha_201803 values('$date',$type,$wareId,$sid)\n";
	$pdo->exec($insert);
	echo "$insert\n";


}





//品类秒杀广告

//爬取LIST
$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillBrand&callback=pcSeckillBrand";//品类页面列表
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];
$json_brand = json_decode($resultF1[0],true);
//print_r($json_brand);exit;
foreach($json_brand['data']['list'] as $data){
	$date=date("Y-m-d");
	$brandName=$data['brandName'];
	$title=$data['title'];
	$brandIdOld=$data['brandIdOld'];
	$brandId=$data['id'];	
	$insert="insert ignore jdnew.ads_miaosha_pinlei_list values($brandId,$brandIdOld,\"$brandName\",\"$title\",'$date')";
	$pdo->exec($insert);
}

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
		$insert="insert ignore jdnew.ads_miaosha_201803 values('$date',$type,$wareId,$sid)\n";
		$pdo->exec($insert);
		echo "$insert\n";


	}

}

