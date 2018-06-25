<?php 
include 'yggdrasil.php';
$date=date("Y-m-d");
$three_days_ago=date("Y-m-d",strtotime("-3 day"));
$time=date("Ym");
function cpdo(){
	$dsn = 'mysql:host=139.196.96.149;dbname=jdnew;port=13306';
	$user_name = 'dataway-rw';
	$user_pw = 'QqHVMhmN*8';

	$pdo = new PDO($dsn, $user_name, $user_pw);
	$pdo->exec("SET NAMES 'utf8'");
	return $pdo;
}	
$cat_id = new ygdrasil();
$cat_id->initial();
$pdo=cpdo();


$sqlget="select * from jdnew.ads_activity_new where type>0 and type<=3";

$resultget=$pdo->query($sqlget)->fetchAll();
for($i=0;$i<count($resultget);$i++){
	$url=$resultget[$i]['url'];
	$act_id=$resultget[$i]['id'];
	$cat_id->set("/\/\/sale\.jd\.com\/act\/[^\.]+\.html/",$url); 
	$cat_id->go();
	$resultF1 = $cat_id->result[0];

	for($j=0;$j<count($resultF1);$j++){
		$url_erj=$resultF1[$j];
		$finalurl=$fl[1];
		$sql4="select * from jdnew.ads_activity_new where url='https:$finalurl'";
		$result4=$pdo->query($sql4)->fetchAll();			
		if(count($result4)>0){
			//echo "step in this update";
			$final=$result4[0]['id'];
			$sql5="update jdnew.ads_activity_new set last_update_time='$date' where id=$final ;";
			echo $sql5."\n";
			$pdo->exec($sql5);
		}else{
			//echo "step in this insert";
			$sql3="insert ignore jdnew.ads_activity_new(url,type,last_update_time) values('https:$finalurl',9,'$date')";
			$pdo->exec($sql3);
			echo $sql3."\n";
			
		}		

	}
	
	
}