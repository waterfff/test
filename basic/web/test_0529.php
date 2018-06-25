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
	
	$pdo=cpdo();

$location=0;


$sql="select max(item_id) from kaola.sales_estimate_final_201805 where item_id=1791060";
$resultfirst=$pdo->query($sql)->fetchAll();
$max_item_id=$resultfirst[0]['max(item_id)'];

echo $max_item_id."\n";

while($location<$max_item_id){	
	$sql="select concat(item_id,'#',sku_id) as real_id,sales,volume,date FROM kaola.sales_estimate_final_201805 where item_id>=$location and item_id=1791060  order by item_id,sku_id,date limit 100000";
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
		//echo $avgnum;
		$dd=0;
		for($i=0;$i<31;$i++){
			if($value[$i]){
				$x=$value[$i]['volume'];
			}else{
				$x=0;
			}
			//print_r($x);
			$dn=($x-$avgnum)*($x-$avgnum);
			$dd+=$dn;
		}
		$dd=sqrt($dd/10);
		echo "$item_id   $sku_id   $dd \n";
		//echo $dd."\n";
		//print_r($value);
		//$tail="";
		foreach($value as $detail){
			if($detail['volume']>2*$dd){
				$date=$detail['date'];
				$tail.="($item_id,'$sku_id','$date'),";
			}
		}
		
	
		
	}
	
	echo $tail."\n";
	$tail=substr($tail,0,strlen($tail)-1);
	//$sql="delete from kaola.sales_estimate_stock_201805 where (item_id,sku_id,date) in ($tail)";
	//echo $sql;
	//$pdo->exec($sql);
	$tail="";
	
}


/*
	$sql="select item_id from kaola.item where catepage is not null";
					
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids1=implode(',',$result);
	
	$sql="select count(distinct(item_id)) from kaola.kaola_test_store_201805 where item_id in ($item_ids1)";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	print_r($result);exit;
	//$item_ids2_1=implode(',',$result);
	
	/*
	$sql="select distinct(item_id) from kaola.kaola_test_sales_201805 where item_id in ($item_ids1)";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids2_1=implode(',',$result);
	$sql="select distinct(item_id) from kaola.kaola_test_store_201805 where item_id in ($item_ids1) and store_num!=99";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids2_2=implode(',',$result);
	$item_ids2=$item_ids2_1.','.$item_ids2_2;
	*/
	/*
	$sql="select sum(sales) from kaola.sales_estimate_201804 where item_id in ($item_ids2)";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$sales1=$result[0];
	
	$sql="select sum(sales) from kaola.sales_estimate_201804 where item_id in ($item_ids1)";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$sales2=$result[0];
	
	echo $sales1/$sales2;
*/
/*
	$sql="SELECT item_id,sum(sales),sum(volume) FROM kaola.sales_estimate_new_201805 group by item_id order by sum(sales) desc limit 100";					
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids1=implode(',',$result);
	echo $item_ids1."\n";
	$sql="select * from (SELECT item_id,sum(sales),sum(volume) FROM kaola.sales_estimate_201804 group by item_id order by sum(sales) desc limit 100)a where a.item_id not in ($item_ids1) ";		
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids2=implode(',',$result);
	echo $item_ids2."\n";
*/	
/*
$sql="SELECT distinct(item_id) FROM kaola.kaola_test_sales_201805";					
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids1=implode(',',$result);
	echo $item_ids1."\n";
*/











	/*
	
$sql="select concat(item_id,'#',sku_id),sku_num,comment_num,date from (select a.item_id,a.sku_id,a.sku_num,b.comment_num,b.date from kaola.kaola_sku_list a left join kaola.comment_dayly_201805 b on a.item_id=b.item_id order by item_id,date,sku_id) a 
				where comment_num is not null  limit 5000";
				
$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);


print_r($result);
				
	*/			