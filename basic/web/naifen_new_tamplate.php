<?php
$tomonth=date("Ym");
function cpdo(){
		$dsn='mysql:host=127.0.0.1;dbname=dw_entity;port=18306';
		$user_name='qbt';
		$user_pw='QBT094bt';
		$pdo = new PDO($dsn, $user_name, $user_pw);//3956468
		$pdo->exec("SET NAMES 'utf8'");
		return $pdo;
	}	
	
	$pdo=cpdo();
	
	
	$datemap=array(1602,1603,1604,1605,1606,1607,1608,1609,1610,1611,1612,1701,1702,1703,1704,1705,1706,1707,1708,1709,1710,1711,1712,1801);
	$sqlmap[]="select alias_bid,round(sum(sales/100)) FROM pedlar.entity_2_bak_2 where sid=9281929 and date_format(date,'%y%m')=this_is_date and shop_type ='天猫超市' and flag!=88 and alias_bid in(4873162,5695391,8221218,8313275) group by alias_bid order by alias_bid;";
	$sqlmap[]="select alias_bid,sum(num*pack_num) FROM pedlar.entity_2_bak_2 where sid=9281929 and date_format(date,'%y%m')=this_is_date and shop_type ='天猫超市' and flag!=88 and alias_bid in(4873162,5695391,8221218,8313275) group by alias_bid order by alias_bid;";
	$sqlmap[]="select use_age,round(sum(sales/100)) FROM pedlar.entity_2_bak_2 where sid=9281929 and date_format(date,'%y%m')=this_is_date and shop_type ='天猫超市' and flag!=88 group by use_age order by use_age;";
	$sqlmap[]="select use_age,sum(pack_num*num) FROM pedlar.entity_2_bak_2 where sid=9281929 and date_format(date,'%y%m')=this_is_date and shop_type ='天猫超市' and flag!=88 group by use_age order by use_age;";
	$sqlmap[]="SELECT concat(ifnull(pack_weight,''),'g*',ifnull(pack_num,'')),round(sum(sales/100)) FROM pedlar.entity_2_bak_2 where sid=9281929 and date_format(date,'%y%m')=this_is_date  and shop_type ='天猫超市' and flag!=88 group by concat(ifnull(pack_num,''),ifnull(pack_weight,'')) order by concat(ifnull(pack_num,''),ifnull(pack_weight,''));";
	$sqlmap[]="SELECT concat(ifnull(pack_weight,''),'g*',ifnull(pack_num,'')),sum(num) FROM pedlar.entity_2_bak_2 where sid=9281929 and date_format(date,'%y%m')=this_is_date  and shop_type ='天猫超市' and flag!=88 group by concat(ifnull(pack_num,''),ifnull(pack_weight,''))   order by concat(ifnull(pack_num,''),ifnull(pack_weight,''));";
	$flag=1;
	
	foreach($sqlmap as $sql){
		foreach($datemap as $date){
			$sql_now=str_replace('this_is_date',$date,$sql);
			//echo $sql_now."\n";
			$count=$pdo->query($sql_now)->fetchAll();
			for($i=0;$i<count($count);$i++){
				$all[$flag][$count[$i][0]][$date]=$count[$i][1];
			}
		}
		$flag++;
	}
	print_r($all);

	for($flag=1;$flag<7;$flag++){
		$fp = fopen("naifen$tomonth_$flag.csv","w");
		foreach($all[$flag] as $key=>$v){
			$excel="$key,";
			for($j=0;$j<count($datemap);$j++){
				if($v[$datemap[$j]]){
				$s=$v[$datemap[$j]];
				$excel.="$s,";
				}else{
				$excel.="0,";	
				}
			}
			//echo $excel."\n";
			fwrite($fp,$excel."\n");
			
		}
	}
	
	
	
	/*
	//ksort($all);
	
	foreach($all as $key=>$v){
		$excel="$key,";
		for($j=0;$j<count($datemap);$j++){
			if($v[$datemap[$j]]){
			$s=$v[$datemap[$j]];
			$excel.="$s,";
			}else{
			$excel.="0,";	
			}
		}
		echo $excel."\n";
		fwrite($fp,$excel."\n");
		
	}
	//print_r($all);