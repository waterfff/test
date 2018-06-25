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
//得到类目页数
$sql="select id,key_words from jdnew.ads_che_list where type=1;";
$result1=$pdo->query($sql)->fetchAll();
print_r($result1);
foreach($result1 as $value){
	$id=$value['id'];
	$key_words=$value['key_words'];
	$cids=explode('-',$key_words);
	$lastcid=$cids[count($cids)-1];
	$cidss.="$lastcid,";
	
}
$cidss=substr($cidss,0,strlen($cidss)-1);
$sql="select page_num from item_category where cid in($cidss)";
$result2=$pdo->query($sql)->fetchAll();
print_r($result2);

for($i=0;$i<count($result1);$i++){
	$tail.="(".$result1[$i]['id'].','.$result2[$i]['page_num']."),";	
}
$tail=substr($tail,0,strlen($tail)-1);
$insert="insert ignore jdnew.ads_che_list(id,page) values $tail on duplicate key update page=values(page)";
$pdo->exec($insert);
*/
/*

//将类目表插入
$sql="select cid,name,lv1cid,lv2cid from jdnew.item_category where level=2;";
$result1=$pdo->query($sql)->fetchAll();
foreach($result1 as $value){
	$key_words=$value['lv1cid'].'-'.$value['lv2cid'];
	$name=$value['name'];
	$tail.="('$name','$key_words',1),";
}
$tail=substr($tail,0,strlen($tail)-1);
$insert="insert ignore jdnew.ads_che_list(`describe`,key_words,type) values $tail on duplicate key update `describe`=values(`describe`)";
$pdo->exec($insert);
echo $insert."\n";

$sql="select cid,name,lv1cid,lv2cid,lv3cid from jdnew.item_category where level=3;";
$result1=$pdo->query($sql)->fetchAll();
foreach($result1 as $value){
	$key_words=$value['lv1cid'].'-'.$value['lv2cid'].'-'.$value['lv3cid'];
	$name=$value['name'];
	$tail.="(\"$name\",'$key_words',1),";
}
$tail=substr($tail,0,strlen($tail)-1);
$insert="insert ignore jdnew.ads_che_list(`describe`,key_words,type) values $tail on duplicate key update `describe`=values(`describe`)";
$pdo->exec($insert);
echo $insert."\n";

*/
$file=fopen('333.txt','r');
$flag=0;
while($key_words=fgets($file)){
	$key_words=str_replace("\r\n","",$key_words);
	$tail.="(\"$key_words\",'$key_words',2),";
	$flag++;
	if($flag==5000){
		$tail=substr($tail,0,strlen($tail)-1);
		$insert="insert ignore jdnew.ads_che_list(`describe`,key_words,type) values $tail on duplicate key update `describe`=values(`describe`)";
		$pdo->exec($insert);
		echo $insert;
		$flag=0;
		$tail='';
	}
}
if($tail){
$tail=substr($tail,0,strlen($tail)-1);
$insert="insert ignore jdnew.ads_che_list(`describe`,key_words,type) values $tail on duplicate key update `describe`=values(`describe`)";
$pdo->exec($insert);
echo $insert;
}






//得到关键词页数？？？






/*
$sql="select id,key_words from jdnew.ads_che_list where type=2;";
$result=$pdo->query($sql)->fetchAll();
*/