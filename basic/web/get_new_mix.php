<?php 

$time=date("ym");

function cpdo(){
		$dsn='mysql:host=127.0.0.1;dbname=dw_entity;port=18306';
		$user_name='qbt';
		$user_pw='QBT094bt';
		$pdo = new PDO($dsn, $user_name, $user_pw);//3956468
		$pdo->exec("SET NAMES 'utf8'");
		return $pdo;
	}

$pdo=cpdo();


$monthL=1610;
$monthR=1711;
$monthMM=1710;
	
/*	
$sqlali="select tb_item_id from  artificial.entity_1359_item_final where is_mix=1 and month>$monthL and month<$monthR and shop_type in('天猫','天猫超市','天猫国际') group by tb_item_id order by sum(sales) desc limit 800";
$resultali=$pdo->query($sqlali)->fetchAll();

$sqlalimix="select tb_item_id from artificial.entity_1359_mix";
$resultalimix=$pdo->query($sqlalimix)->fetchAll();


//print_r($result1);
//print_r($result2);

for($i=0;$i<count($resultali);$i++){
	$flag=0;
	for($j=0;$j<count($resultalimix);$j++){
		if($resultali[$i][0]==$resultalimix[$j][0]){
			$flag+=1;
		}else{
			$flag+=0;
		}
		
	}
	if($flag==0){
		//echo $result1[$i][0]."\n";
		$tb_item_ids.=$resultali[$i][0].",";
	}
}
$tb_item_ids=substr($tb_item_ids,0,strlen($tb_item_ids)-1);
//echo $tb_item_ids;
$rr=explode(',',$tb_item_ids) ;
print_r($rr);




$sqlinali="insert into artificial.entity_1359_mix(tb_item_id, month, name, sid, shop_name, shop_type, cid, region_str, brand, alias_bid, sub_brand, sub_brand_name, product, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, avg_price, trade, num, sales, serface_material, is_import, size, classification, fragrance, insert_way, thick, is_mix, b_num, p_num, sum_sales, checked, checked_month) select tb_item_id, month, name, sid, shop_name, shop_type, cid, region_str, brand, alias_bid, sub_brand, sub_brand_name, product, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, avg_price, trade, num, sales, serface_material, is_import, size, classification, fragrance, insert_way, thick, is_mix, b_num, p_num, sum(sales),0,$monthMM from artificial.entity_1359_item_final where tb_item_id in($tb_item_ids) group by tb_item_id order by sum(sales) desc";
echo "insert into artificial.entity_1359_mix(tb_item_id, month, name, sid, shop_name, shop_type, cid, region_str, brand, alias_bid, sub_brand, sub_brand_name, product, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, avg_price, trade, num, sales, serface_material, is_import, size, classification, fragrance, insert_way, thick, is_mix, b_num, p_num, sum_sales, checked, checked_month) select tb_item_id, month, name, sid, shop_name, shop_type, cid, region_str, brand, alias_bid, sub_brand, sub_brand_name, product, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, avg_price, trade, num, sales, serface_material, is_import, size, classification, fragrance, insert_way, thick, is_mix, b_num, p_num, sum(sales),0,$monthMM from artificial.entity_1359_item_final where tb_item_id in($tb_item_ids) group by tb_item_id order by sum(sales) desc\n";
$pdo->exec($sqlinali);

*/

$tb_item_ids='';
$sqljd="select tb_item_id from  artificial.entity_1359_jd_final where  date_format(date,'%y%m')>$monthL and date_format(date,'%y%m')<$monthR and is_mix=1 group by tb_item_id order by sum(sales) desc limit 200";
$resultjd=$pdo->query($sqljd)->fetchAll();

$sqljdmix="select tb_item_id from artificial.entity_1359_jd_mix";
//$sql2="select tb_item_id from  artificial.entity_1359_item_final where  month>1604 and month<1705 and is_mix=1 group by tb_item_id order by sum(sales) desc limit 1000";

$resultjdmix=$pdo->query($sqljdmix)->fetchAll();



for($i=0;$i<count($resultjd);$i++){
	$flag=0;
	for($j=0;$j<count($resultjdmix);$j++){
		if($resultjd[$i][0]==$resultjdmix[$j][0]){
			$flag+=1;
		}else{
			$flag+=0;
		}
		
	}
	if($flag==0){
		$tb_item_ids.=$resultjd[$i][0].",";
	}
	
	
}
$tb_item_ids=substr($tb_item_ids,0,strlen($tb_item_ids)-1);
//echo $tb_item_ids;
$rr=explode(',',$tb_item_ids) ;
print_r($rr);

$sqlinjd="insert ignore artificial.entity_1359_jd_mix(tb_item_id, name, sid, shop_name, shop_type, cid, region_str, brand, sub_brand, date, avg_price, trade, num, sales, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, jd_alias_bid, alias_bid, serface_material, is_import, size, classification, fragrance, insert_way, thick, is_mix, b_num, p_num,checked,checked_month) select tb_item_id, name, sid, shop_name, shop_type, cid, region_str, brand, sub_brand, date, avg_price, trade, sum(num) as num, sum(sales) as sales, p1, p2, p3, p4, p5, p6, p7, p8, p9, p10, p11, p12, p13, p14, p15, p16, p17, p18, p19, p20, p21, p22, p23, p24, p25, p26, p27, p28, p29, p30, p31, p32, p33, p34, p35, p36, p37, p38, p39, p40, p41, p42, p43, p44, p45, p46, p47, p48, p49, p50, p51, p52, p53, p54, p55, p56, p57, p58, p59, p60, p61, p62, p63, p64, p65, p66, p67, p68, p69, p70, p71, p72, p73, p74, p75, p76, p77, p78, p79, p80, p81, p82, p83, p84, p85, p86, p87, p88, p89, p90, p91, p92, p93, p94, p95, p96, p97, p98, p99, p100, alias_bid, ali_alias_bid, serface_material, is_import, size, classification, fragrance, insert_way, thick, is_mix, b_num, p_num,0,$monthMM from artificial.entity_1359_jd_final where tb_item_id in($tb_item_ids) group by tb_item_id order by sum(sales) desc";
echo $sqlinjd;
$pdo->exec($sqlinjd);
	
	
	