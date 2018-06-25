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


$fp = fopen('brandtop30.csv','w'); 

$brandmap['Chanel']='31131,725217';
//Dior
$brandmap['Dior']='2714,199350';
//Estee Lauder
$brandmap['Estee Lauder']='11011,2196771';
//LA MER
$brandmap['LA MER']='178277';
//MAC
$brandmap['MAC']='38454';
//Bobbi Brown
$brandmap['Bobbi Brown']='8970640';
//Fresh
$brandmap['Fresh']='9985282';
//Laneige
$brandmap['Laneige']='16239,42659,340491,383924,3512869';
//shiseido
$brandmap['shiseido']='7934,243588,3466616,3485487,6933124,7122422,7122422';
//CPB
$brandmap['CPB']='3477056,7423121,10696462,11646143,18330008';
//SKII
$brandmap['SKII']='181133,244247,266608,283911';
//Lancome
$brandmap['Lancome']='8075,17414';
//YSL
$brandmap['YSL']='8997';
//JO MALONE
$brandmap['JO MALONE']='423101';
//kiehls
$brandmap['kiehls']='7600514,17712004';
//print_r(strpos('31131,725217','31131'));
$subcategory_map=array('男士香水','女士香水','中性香水','其他香水');

foreach($subcategory_map as $subcategory_fr){
$sql="select b.name,a.alias_bid,a.ss from (SELECT alias_bid,sum(sales) as ss FROM artificial.entity_1366 where subcategory='$subcategory_fr' and alias_bid!=40604 and date>'2016-12-31' and date<'2017-11-01' group by alias_bid order by sum(sales) desc limit 30) a left join dw_entity.brand b on a.alias_bid =b.bid;";				   
//echo $sql;
$result=$pdo->query($sql)->fetchAll();
echo $subcategory_fr."\n";
//print_r($result);
	foreach($result as $key=>$v){
		foreach($brandmap as $w){
			$zs=explode(',',$w);
			//print_r($zs);exit;
				if(in_array($v['alias_bid'],$zs)){
					$result[$key]['alias_bid_new']=$w;
					//echo $w.'--'.$v['alias_bid']."\n";
					break ;
				}else{
					$result[$key]['alias_bid_new']=$v['alias_bid'];
				}
			
		}
	}
//print_r($result);
	$i=0;
	foreach($result as $v){
		$data[$subcategory_fr][$i]['new']=$v['alias_bid_new'];
		$data[$subcategory_fr][$i]['old']=$v['alias_bid'];
		$i++;
	}
	
}	
print_r($data);
foreach($data as $subcategory_key=>$v){
	fwrite($fp,$subcategory_key."\n");
	fwrite($fp,"rank,brand,sales,num,\n");
	foreach($v as $rank =>$alias_bid){
		$alias_bid_new=$alias_bid['new'];
		$sql="select b.name,sum(a.sales/100),sum(num) from artificial.entity_1366 a  left join dw_entity.brand b on a.alias_bid =b.bid where a.date>'2016-12-31' and a.date<'2017-11-01' and a.alias_bid in($alias_bid_new) and a.subcategory='$subcategory_key';";
		echo $sql."\n";
		$resultF=$pdo->query($sql)->fetchAll();
		fwrite($fp,($rank+1).','.$resultF[0]['name'].','.$resultF[0]['sum(a.sales/100)'].','.$resultF[0]['sum(num)'].",\n");
		//print_r($resultF);
	}
}

//print_r($data);		
		