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
/*
$url="https://red.jd.com/";//闪购主页面
$cat_id->set("/<!-- nav begin -->[\s\S]*?<!-- nav end -->/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0][0];
//echo $resultF1;
preg_match_all("/<span\>(.*)\<\/span>/",$resultF1,$cateName);
preg_match_all("/<a href=\"(.*)\">/",$resultF1,$cateUrl);

for($i=0;$i<count($cateName[1]);$i++){
	$CateName=$cateName[1][$i];
	$CateUrl=$cateUrl[1][$i];
	$insert="insert ignore jdnew.ads_shangou_toplist(catename,cateurl) values('$CateName','https:$CateUrl')";
	$pdo->exec($insert);
	echo "$insert\n";
	
	
}
*/


$sql="select cateurl from jdnew.ads_shangou_toplist";
$urlMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
foreach($urlMap as $url){
	echo $url."\n";

	$cat_id->set("/[\s\S]*/",$url); 

	$cat_id->go();
	$resultF1 = $cat_id->result[0][0];
	preg_match("/<!-- 今日最新  开始 -->[\s\S]*?<!-- 今日最新  结束 -->/",$resultF1,$first);
	preg_match("/<!--右侧排行榜  开始-->[\s\S]*?<!--右侧排行榜 结束-->/",$resultF1,$second);
	preg_match("/<!-- 今日上新两排展示 开始-->[\s\S]*?<!-- 今日上新两排展示 结束-->/",$resultF1,$third);
	preg_match("/<!-- 最后疯抢 开始 -->[\s\S]*?<!-- 最后疯抢 结束 -->/",$resultF1,$forth);
	
	preg_match_all("/\/\/red\.jd\.com\/redList-([0-9]*)-[0-9]*-[0-9]*-[0-9]*\.html/",$first[0],$firsturl);
	preg_match_all("/\/\/red\.jd\.com\/redList-([0-9]*)-[0-9]*-[0-9]*-[0-9]*\.html/",$second[0],$secondurl);
	preg_match_all("/\/\/item\.jd\.com\/([0-9]*)\.html/",$second[0],$seconditem);
	preg_match_all("/\/\/red\.jd\.com\/redList-([0-9]*)-[0-9]*-[0-9]*-[0-9]*\.html/",$third[0],$thirdurl);
	preg_match_all("/\/\/red\.jd\.com\/redList-([0-9]*)-[0-9]*-[0-9]*-[0-9]*\.html/",$forth[0],$forthurl);
	
	foreach($firsturl[0] as $key=>$url){
		$act_id=$firsturl[1][$key];
		//echo "$url--------$act_id\n";
		$tail.="('$date','https:$url',$act_id),";
	}
	$tail=substr($tail,0,strlen($tail)-1);
	$insert="insert ignore jdnew.ads_shangou_secondlist values $tail" ;
	$pdo->exec($insert);
	$tail='';
	echo $insert."\n";
	foreach($secondurl[0] as $key=>$url){
		$act_id=$secondurl[1][$key];
		//echo "$url--------$act_id\n";
		$tail.="('$date','https:$url',$act_id),";
	}
	$tail=substr($tail,0,strlen($tail)-1);
	$insert="insert ignore jdnew.ads_shangou_secondlist values $tail" ;
	$pdo->exec($insert);
	$tail='';
	echo $insert."\n";
	foreach($thirdurl[0] as $key=>$url){
		$act_id=$thirdurl[1][$key];
		//echo "$url--------$act_id\n";
		$tail.="('$date','https:$url',$act_id),";
	}
	$tail=substr($tail,0,strlen($tail)-1);
	$insert="insert ignore jdnew.ads_shangou_secondlist values $tail" ;
	$pdo->exec($insert);
	$tail='';
	echo $insert."\n";
	foreach($forthurl[0] as $key=>$url){
		$act_id=$forthurl[1][$key];
		//echo "$url--------$act_id\n";
		$tail.="('$date','https:$url',$act_id),";
	}
	$tail=substr($tail,0,strlen($tail)-1);
	$insert="insert ignore jdnew.ads_shangou_secondlist(date,url,act_id) values $tail" ;
	$pdo->exec($insert);
	$tail='';
	echo $insert."\n";
	

}

$sql="select act_id from jdnew.ads_shangou_secondlist";
$actMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
foreach($actMap as $act_id){
	$url="https://red.jd.com/redList/page.html?callback=showPageData&actid=$act_id&index=1&cid=0&sortFlag=0&stockFlag=0";
	echo $url."\n";
	$cat_id->set("/{[\s\S]*}/",$url); 
	$cat_id->go();
	$resultF1 = $cat_id->result[0];
	//print_r($resultF1);
	$jsonPage = json_decode($resultF1[0],true);
	//print_r($jsonPage);
	//exit;
	$pageNum=$jsonPage['pagecount'];
	$tail.="('$date',$act_id,$pageNum),";
		
}
$tail=substr($tail,0,strlen($tail)-1);
$insert="insert ignore jdnew.ads_shangou_secondlist(date,act_id,page) values $tail on duplicate key update page=values(page)";
$pdo->exec($insert);













