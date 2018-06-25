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
	
	echo "insert 1\n";
	$sql="insert into kaola.sales_estimate_final_201805 select * from kaola.sales_estimate_new_201805";
	$pdo->exec($sql);
	
	$sql="select distinct(item_id) from kaola.sales_estimate_new_201805 ";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids=implode(',',$result);
	
	echo "insert 2\n";
	$sql="insert into kaola.sales_estimate_final_201805 select * from kaola.sales_estimate_stock_201805 where item_id not in ($item_ids)";
	$pdo->exec($sql);
	
	$sql="select distinct(item_id) from kaola.sales_estimate_final_201805 ";
	$result=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	$item_ids=implode(',',$result);

	
	$sqll="select count(distinct(item_id)) from kaola.sales_estimate_final_201805 where item_id not in ($item_ids)";
	$result1=$pdo->query($sqll)->fetchAll();
	//print_r($result1);
	
	echo "insert 3\n";
	$sql="insert into kaola.sales_estimate_final_201805 select * from kaola.sales_estimate_comment_201805 where item_id not in ($item_ids)";
	$pdo->exec($sql);*/