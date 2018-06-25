<?php 

function cpdo(){
			$dsn='mysql:host=127.0.0.1;dbname=dw_entity;port=18306';
			$user_name='qbt';
			$user_pw='QBT094bt';
			$pdo = new PDO($dsn, $user_name, $user_pw);//3956468
			$pdo->exec("SET NAMES 'utf8'");
			return $pdo;
		}

	$pdo=cpdo();


	
//$file = fopen('tianmao_paichu.csv','r'); 
$file = fopen('tianmaochaoshi_paichu.csv','r'); 
		while ($data = fgetcsv($file,",")) { 
		 $firstdata[] = $data;
		 }
		// print_r($firstdata);exit;
		
		foreach($firstdata as $v){
			$line.="'".$v[0]."',";
		
		
		}
		
		
	$line=substr($line,0,strlen($line)-1);
	
	
	$sql="select tb_item_id from artificial.entity_1359_item_bak_final where name in($line)";
	//echo $sql;
	$result=$pdo->query($sql)->fetchAll();
	
	
	//print_r($result);
	
	
	foreach($result as $v){
			$linel.=$v[0].",";	
	}
		
	$linel=substr($linel,0,strlen($linel)-1);
echo 	$linel;