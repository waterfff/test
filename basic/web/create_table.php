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



for($i=3;$i<10;$i++){
$figger="-$i month";
$month=date("Ym",strtotime($figger));

$sql1="create table jdnew.ads_che_$month like jdnew.ads_che_201803";
$sql2="create table jdnew.ads_xuan_$month like jdnew.ads_xuan_201803";
$sql3="create table jdnew.ads_zhannei_$month like jdnew.ads_zhannei_201803";
$sql4="create table jdnew.ads_activity_$month like jdnew.ads_activity_201803";
$sql5="create table jdnew.ads_miaosha_$month like jdnew.ads_miaosha_201803";
$sql6="create table jdnew.ads_shangou_$month like jdnew.ads_shangou_201803";

echo $sql1."\n";

$pdo->exec($sql1);
$pdo->exec($sql2);
$pdo->exec($sql3);
$pdo->exec($sql4);
$pdo->exec($sql5);
$pdo->exec($sql6);

}