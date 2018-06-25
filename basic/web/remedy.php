<?php
ini_set('memory_limit','1024M');


	function cpdo(){
		$dsn = 'mysql:host=127.0.0.1;dbname=kaola;port=13306';
		$user_name = 'dataway-rw';
		$user_pw = 'QqHVMhmN*8';
		$pdo = new PDO($dsn, $user_name, $user_pw);
		$pdo->exec("SET NAMES 'utf8'");
		return $pdo;
	}
	
	/*
	
	function cpdo(){
		$dsn = 'mysql:host=192.168.0.14;dbname=kaola;port=13306';
		$user_name = 'dataway-rw';
		$user_pw = 'QqHVMhmN*8';
		$pdo = new PDO($dsn, $user_name, $user_pw);
		$pdo->exec("SET NAMES 'utf8'");
		return $pdo;
}

*/
	
	$pdo=cpdo();


	/*
$location=0;


$sql="select max(item_id) from kaola.sales_estimate_comment_201805";
$resultfirst=$pdo->query($sql)->fetchAll();
$max_item_id=$resultfirst[0]['max(item_id)'];

echo $max_item_id."\n";

while($location<$max_item_id){	
	$sql="select concat(item_id,'#',sku_id) as real_id,sales,volume,date FROM kaola.sales_estimate_comment_201805 where item_id>=$location  order by item_id,sku_id,date limit 100000";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
	//print_r($result);exit;
	foreach($result as $item_sku => $value ){
		$stack=explode('#',$item_sku);
		$item_id=$stack[0];
		$sku_id=$stack[1];	
		$location=$item_id;
		
		$sumsales=0;
		$sumnum=0;
		foreach($value as $detail){
			$sumsales+=$detail['sales'];
			$sumnum+=$detail['volume'];
		}
		$avgsales=round($sumsales/19/100)*100;
		$avgnum=round($sumnum/19);
		$datehistory='2018-05-01';
		while($datehistory!='2018-05-13'){
			$tail.="($item_id,'$sku_id',$avgsales,$avgnum,$datehistory),";
			$datehistory=date('Y-m-d',strtotime($datehistory."+1 day"));
		}
	
	}
	echo $tail;exit;
	#$sql="insert ignore artificial.sales_estimate_comment_201805 values $tail";
	#$pdo->exec($sql);
	
	
}

*/

/*

$location=0;


$sql="select max(item_id) from kaola.sales_estimate_new_201805";
$resultfirst=$pdo->query($sql)->fetchAll();
$max_item_id=$resultfirst[0]['max(item_id)'];

echo $max_item_id."\n";

while($location<$max_item_id){	
	$sql="select concat(item_id,'#',sku_id) as real_id,sales,volume,date FROM kaola.sales_estimate_new_201805 where item_id>=$location  order by item_id,sku_id,date limit 100000";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
	//print_r($result);exit;
	foreach($result as $item_sku => $value ){
		$stack=explode('#',$item_sku);
		$item_id=$stack[0];
		$sku_id=$stack[1];	
		$location=$item_id;
		
		$sumsales=0;
		$sumnum=0;
		foreach($value as $detail){
			$sumsales+=$detail['sales'];
			$sumnum+=$detail['volume'];
		}
		$avgsales=round($sumsales/count($value)/100)*100;
		$avgnum=round($sumnum/count($value));
		$datehistory='2018-05-01';
		while($datehistory!='2018-06-01'){
			$tail.="($item_id,'$sku_id',$avgsales,$avgnum,$datehistory),";
			$datehistory=date('Y-m-d',strtotime($datehistory."+1 day"));
		}
	
	}
	echo $tail;exit;
	$sql="insert ignore artificial.sales_estimate_new_201805 values $tail";
	$pdo->exec($sql);
	
	
}

*/

$location=0;


$sql="select max(item_id) from kaola.sales_estimate_stock_201805";
$resultfirst=$pdo->query($sql)->fetchAll();
$max_item_id=$resultfirst[0]['max(item_id)'];

echo $max_item_id."\n";

while($location<$max_item_id){	
	$sql="select concat(item_id,'#',sku_id) as real_id,sales,volume,date FROM kaola.sales_estimate_stock_201805 where item_id>=$location  order by item_id,sku_id,date limit 10000";
	//echo $sql;
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
	//print_r($result);exit;
	foreach($result as $item_sku => $value ){
		$stack=explode('#',$item_sku);
		$item_id=$stack[0];
		$sku_id=$stack[1];	
		$location=$item_id;
		
		$sumsales=0;
		$sumnum=0;
		foreach($value as $detail){
			$sumsales+=$detail['sales'];
			$sumnum+=$detail['volume'];
		}
		$avgsales=ceil($sumsales/10/100)*100;
		$avgnum=ceil($sumnum/10);
		$datehistory='2018-05-01';
		while($datehistory!='2018-05-22'){
			$tail.="($item_id,'$sku_id',$avgsales,$avgnum,'$datehistory'),";
			$datehistory=date('Y-m-d',strtotime($datehistory."+1 day"));
		}
		$tail=substr($tail,0,strlen($tail)-1);
		$sql1="insert ignore artificial.sales_estimate_stock_201805 values $tail";
		$pdo->exec($sql1);
		echo $sql1;
		$tail='';
			
		exit;
	
	}
	//echo $tail;exit;

	
}





	
	
	

	