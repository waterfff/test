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
date_default_timezone_set('prc');
$date=date("Y-m-d");
$month=date("Ym");
/*
$sql="select item_id from jdnew.ads_shangou_$month where sid=0 and date='$date'";
$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
echo count($result);
for($key=0;$key<count($result);$key++){
	$value=$result[$key];
	$item_ids.="$value,";
	echo $key."\n";
	if(!(($key+1)%10000)||($key==(count($result)-1))){
		echo $key."\n";
		$item_ids=substr($item_ids,0,strlen($item_ids)-1);
		$sql="select item_id,sid from jdnew.item_new where item_id in ($item_ids)";
		$result1=$pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_COLUMN);
		//print_r($result1);exit;
		foreach($result1 as $item_id => $sid){
			$tail.="('$date',$item_id,$sid),";
		}
		$tail=substr($tail,0,strlen($tail)-1);
		$insert="insert ignore jdnew.ads_shangou_$month(date,item_id,sid) values $tail on duplicate key update sid=values(sid)";
		$pdo->exec($insert);
		$tail='';
		$item_ids='';
	}	

}
*/


/*
$sql="select item_id from jdnew.ads_che_$month where  date='$date'";
$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
echo count($result);
for($key=0;$key<count($result);$key++){
	$value=$result[$key];
	$item_ids.="$value,";
	echo $key."\n";
	if(!(($key+1)%10000)||($key==(count($result)-1))){
		echo $key."\n";
		$item_ids=substr($item_ids,0,strlen($item_ids)-1);
		$sql="select item_id,sid,cid from jdnew.item_new where item_id in ($item_ids)";
		$result1=$pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);
		//print_r($result1);exit;
		foreach($result1 as $item_id => $scids){
			$sid=$scids['sid'];
			$cid=$scids['cid'];
			$tail.="('$date',$item_id,$sid,$cid),";
		}
		$tail=substr($tail,0,strlen($tail)-1);
		$insert="insert ignore jdnew.ads_che_$month(date,item_id,sid,cids) values $tail on duplicate key update sid=values(sid),cids=values(cids)";
		$pdo->exec($insert);
		$tail='';
		$item_ids='';
	}	

}
*/


$sql="select item_id from jdnew.ads_activity_$month where sid=0 and date='$date'";
$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
echo count($result);
for($key=0;$key<count($result);$key++){
	$value=$result[$key];
	$item_ids.="$value,";
	echo $key."\n";
	if(!(($key+1)%10000)||($key==(count($result)-1))){
		echo $key."\n";
		#echo $item_ids."\n";
		$item_ids=substr($item_ids,0,strlen($item_ids)-1);
		$sql="select a.item_id,b.sid,a.act_id from jdnew.ads_activity_$month a left join jdnew.item_new b on a.item_id=b.item_id  where a.item_id in ($item_ids) and b.sid is not null and b.cid is not null and date='$date'";
		$result1=$pdo->query($sql)->fetchAll(PDO::FETCH_UNIQUE | PDO::FETCH_ASSOC);
		#print_r($result1);exit;
		foreach($result1 as $item_id => $saids){
			$sid=$saids['sid'];
			$act_id=$saids['act_id'];
			$tail.="('$date',$item_id,$sid,$act_id),";
			//echo $tail;exit;
		}
		
		$tail=substr($tail,0,strlen($tail)-1);
		$insert="insert ignore jdnew.ads_activity_$month(date,item_id,sid,act_id) values $tail on duplicate key update sid=values(sid)";
		//echo $insert;
		//exit;
		$pdo->exec($insert);
		$tail='';
		$item_ids='';
	}	

}










