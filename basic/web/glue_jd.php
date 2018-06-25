<?php 

/*
	function cpdo(){
		$dsn='mysql:host=139.196.138.184;dbname=dw_entity;port=28018';
		$user_name='apollo-rw';
		$user_pw='QBT094bt';
		$pdo = new PDO($dsn, $user_name, $user_pw);
		return $pdo;
	}
	*/
		function cpdo(){
			$dsn='mysql:host=127.0.0.1;dbname=dw_entity;port=18306';
			$user_name='qbt';
			$user_pw='QBT094bt';
			$pdo = new PDO($dsn, $user_name, $user_pw);//3956468
			$pdo->exec("SET NAMES 'utf8'");
			return $pdo;
		}
	
	$pdo=cpdo();
	$sql="select * from artificial.entity_vida_exploded_jd ";
	$result=$pdo->query($sql)->fetchAll();
	//print_r($result);
	
	foreach($result as $v){
		if($v['p_ids']){
			$tb_item_id=$v['tb_item_id'];
			$pid=$v['p_ids'];
			$pid=substr($pid,0,strlen($pid)-1);
			$pnum=$v['p_nums'];
			$pnum=substr($pnum,0,strlen($pnum)-1);
			$pids=explode(',',$pid);
			$pnums=explode(',',$pnum);
		
			
			
			
			$sqlexploded="select * from artificial.entity_vida_product where id in($pid)";
			echo $sqlexploded;
			$resultexploded=$pdo->query($sqlexploded)->fetchAll();
			$wholeprice=0;
			for($i=0;$i<count($resultexploded);$i++){	
				$wholeprice+=($resultexploded[$i]['avg_price']*$pnums[$i]);
				
			}	
			//echo $wholeprice;
			
			
			$sqlitem="select * from artificial.entity_1359_jd_bak_final where tb_item_id=$tb_item_id and  date>'2017-09-31';";
			//echo $sqlitem;exit;
			$resultitem=$pdo->query($sqlitem)->fetchAll();
			

			foreach($resultitem as $v1){
				$date=$v1['date'];
				$sales=$v1['sales'];
				$num=$v1['num'];
				$sid=$v1['sid'];
				$shop_name=$v1['shop_name'];
				$alias_bid=$v1['alias_bid'];
				$shop_type=$v1['shop_type'];
				$ali_alias_bid=$v1['ali_alias_bid'];
				$insertflag=1;
				for($i=0;$i<count($resultexploded);$i++){
					$name_f=$resultexploded[$i]['name'];
					$num_f=$num;
					$b_numf=$pnums[$i];
					$classification=$resultexploded[$i]['classification'];
					$serface_material=$resultexploded[$i]['serface_material'];
					$is_import=$resultexploded[$i]['is_import'];
					$fragrance=$resultexploded[$i]['fragrance'];
					$insert_way=$resultexploded[$i]['insert_way'];
					$size=$resultexploded[$i]['size'];
					$series=$resultexploded[$i]['series'];
					$pice_numf=$resultexploded[$i]['p_num']*$pnums[$i];
					//echo $sales;
					$salesfinal=round($sales*$resultexploded[$i]['avg_price']*$pnums[$i]/$wholeprice);
					

					$sqlfinset="insert into artificial.entity_1359_jd_bak_final (tb_item_id,date,name,sid,shop_name,shop_type,alias_bid,ali_alias_bid,sales,num,classification,serface_material,is_import,fragrance,insert_way,size,p_num,b_num) 
					values('$tb_item_id"."_"."$i'".",'$date','$name_f',$sid,'$shop_name','$shop_type',$alias_bid,$ali_alias_bid,$salesfinal,$num_f,'$classification','$serface_material','$is_import','$fragrance','$insert_way','$size',$pice_numf,$b_numf)";
					//echo $sqlfinset."\n";
					$insertnum=$pdo->exec($sqlfinset);
					if($insertnum==0){
						echo $sqlfinset."\n";
					}
					$insertflag*=$insertnum;
					//exit;
				
				}
				#echo $insertflag;
				
				if($insertflag){
					$sqldelete="delete from artificial.entity_1359_jd_bak_final where tb_item_id='$tb_item_id' and date='$date'";
					//echo $sqldelete."\n";
					$pdo->exec($sqldelete);
				}
			}
		}
	
	}
	
	