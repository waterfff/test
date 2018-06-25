<?php 


function cpdo(){

		$dsn = 'mysql:host=127.0.0.1;dbname=kaola;port=13306';
		$user_name = 'dataway-rw';
		$user_pw = 'QqHVMhmN*8';
		$pdo = new PDO($dsn, $user_name, $user_pw);
		$pdo->exec("SET NAMES 'utf8'");
		return $pdo;
}



	$pdo=cpdo();


$sqlgetitem="select item_id from kaola.item where created>'2017-11-11'";
$result=$pdo->query($sqlgetitem)->fetchAll();

foreach($result as $v){
$item_id=$v['item_id'];
$sql="SELECT concat(item_id,'#',sku_id) as real_id,sku_price,cid,sales,store_num,sku_map,date FROM kaola.stock_201711 where item_id=$item_id  order by item_id,date";
//echo $sql;
$result1=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
//print_r($result1);

foreach($result1 as $itemid_skuid => $v){
	$stack=explode('#',$itemid_skuid);
	$item_id=$stack[0];
	$sku_id=$stack[1];	
	$sales_priceall=$v[0]['sales']*$v[0]['sku_price'];
	$sales=$v[0]['sales'];
	$date='2017-11-11';
	if($sales!=0){
		$value.="($item_id,'$sku_id',$sales_priceall,$sales,'$date'),";	
	}
	$allfosales+=$sales_priceall;
	//echo $item_id.'----' .$sales_priceall."\n";
}
//echo $value;
if($value){
	$value=substr($value,0,strlen($value)-1);
$sqlfinal="insert ignore kaola.sales_estimate_201711"."(item_id,sku_id,sales,volume,date) values $value 
					on duplicate key 
					update sales=values(sales),volume=values(volume)";
					echo $sqlfinal;


//$pdo->exec($sqlfinal);
}
$value='';
}
//echo $allfosales;

