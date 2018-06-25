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

	$sql="select cid from kaola.item_category where level=2";
	$lv2cids=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
	foreach($lv2cids as $lv2cid){
		$sql="select cid from kaola.item_category where lv2cid=$lv2cid";
		$cidMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
		$cids=implode(',',$cidMap);
		$sql="select item_id from kaola.item where cid in($cids)";
		$itemIdMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
		if($itemIdMap){
			$itemIds=implode(',',$itemIdMap);
			$dataMap[$lv2cid]['itemIds']=$itemIds;  
		}
	}
	//print_r($dataMap);exit;
	
	foreach($dataMap as $lv2cid=>$itemIdData){
		$itemIds=$itemIdData['itemIds'];
		$sql="select item_id from kaola.sales_estimate_new_201805 where item_id in ($itemIds)";
		
		$realIdMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
		if($realIdMap){
			$realIds=implode(',',$realIdMap);
			$dataMap[$lv2cid]['realIds']=$realIds;	
		}
	}
	foreach($dataMap as $lv2cid=>$itemIdData){
		$realIds=$itemIdData['realIds'];
		if($realIds){
			$sql="select sum(volume)*31/18 from kaola.sales_estimate_new_201805 where item_id in ($realIds)";
			//echo $sql."\n";
			$volume=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
			$sql="select sum(comment_num) from kaola.comment_estimate_201805 where item_id in ($realIds)";
			$commentNum=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
			if($commentNum[0]){
				$dataMap[$lv2cid]['proportion']=$volume[0]/$commentNum[0];	
			}
		}
	}
	//print_r($dataMap);exit;
	
	
	foreach($dataMap as $lv2cid=>$itemIdData){
		echo "$lv2cid:";
		$itemIds=$itemIdData['itemIds'];
		$proportion=$itemIdData['proportion'];
		//echo $itemIds."\n";
		//echo $proportion."\n";
		$tail='';
		if($itemIds&&$proportion){
			$location=0;
			$sql="select max(item_id) from 
				(select a.item_id,a.sku_id,a.sku_num,b.comment_num,b.date,c.sale_price from kaola.kaola_sku_list a 
					left join kaola.comment_dayly_201805 b on a.item_id=b.item_id 
					left join kaola.item c on a.item_id=c.item_id order by item_id,date,sku_id) a 
				where comment_num is not null and item_id in($itemIds)";
			$resultfirst=$pdo->query($sql)->fetchAll();
			$max_item_id=$resultfirst[0]['max(item_id)'];

		
			while($location<$max_item_id){	
				$sql="select concat(item_id,'#',sku_id),sku_num,comment_num,date,sale_price from 
				(select a.item_id,a.sku_id,a.sku_num,b.comment_num,b.date,c.sale_price from kaola.kaola_sku_list a 
					left join kaola.comment_dayly_201805 b on a.item_id=b.item_id 
					left join kaola.item c on a.item_id=c.item_id order by item_id,date,sku_id) a 
				where comment_num is not null and item_id>=$location and item_id in($itemIds) limit 10000";
				$result=$pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC | PDO::FETCH_GROUP);
				//print_r($result);exit;
				foreach($result as $itemid_skuid => $value){
					$stack=explode('#',$itemid_skuid);
					$item_id=$stack[0];
					$sku_id=$stack[1];	
					$location=$item_id;
					
					foreach($value as $detail){
						$sales_num=round($detail['comment_num']*$proportion/$detail['sku_num']);
						$sales=$detail['sale_price']*$sales_num;
						//echo $detail['sale_price'].' '.$sales_num.' '.$sales."\n";
						$date=$detail['date'];
						if($item_id&&$sku_id&&$sales&&$sales_num&&$date){
							$tail.="($item_id,'$sku_id',$sales,$sales_num,'$date'),";
						}
					}
				}
				$tail=substr($tail,0,strlen($tail)-1);
				$sqlinsert="insert into kaola.sales_estimate_comment_201805(item_id,sku_id,sales,volume,date) values $tail 
				on duplicate key 
				update sales=values(sales),volume=values(volume)";
				//echo $sqlinsert;
				$pdo->exec($sqlinsert);
				//exit;
				echo $location."\n";
			}	
		}
		
	}
	
	
	
    //print_r($dataMap);
/*	
	foreach($DataMap as $lv2cid=>$itemIds){
		$sql="select item_id from sales_estimate_new_201805 where item_id in ($itemIds)";
		$realIdMap=$pdo->query($sql)->fetchAll(PDO::FETCH_COLUMN);
		$realIds=implode(',',$realIdMap);
		$DataMap[$lv2cid]['realIds']=$realIds;	
	}
*/	
  
  