<?php


/*

//sheet 1

echo "creating sheet 1\n";
$fp= fopen("sheet1.csv","w"); 
$sql="select date_format(date,'%Y') as year,'双十一' as month,category,subcategory,shop_type,
if(shop_type='集市'||shop_type='全球购',sum(sales/100)*1.15,sum(sales/100))  as sales
from artificial.entity_1366  
where   (date='2016-11-11' or date='2017-11-11') and (category is not null and category !='others')
group by date_format(date,'%Y%m'),category,subcategory,shop_type
order by date_format(date,'%Y%m'),category,subcategory,shop_type";
sql_to_csv($sql,$fp);
fclose($fp);
echo "sheet 1 done\n";


//sheet 2


echo "creating sheet 2\n";
$fp= fopen("sheet2.csv","w"); 
$sql="select date_format(date,'%Y') as year,'双十一' as month,brand_name,category,subcategory,shop_type,sum(sales/100) as sales  
from artificial.entity_1366 
where    (date='2016-11-11' or date='2017-11-11') and (brand_name is not null and brand_name !='') and (category is not null and category !='others')
group by date_format(date,'%Y%m'),brand_name,category,subcategory,shop_type
order by date_format(date,'%Y%m'),brand_name,category,subcategory,shop_type";
sql_to_csv($sql,$fp);
fclose($fp);
echo "sheet 2 done\n";



//sheet 3
$fp= fopen("sheet3_1.csv","w"); 
$category_map=array('Skin Care','Makeup','Fragrance');
$date_map=array('2016-11-11','2017-11-11');



foreach($category_map as $category){
	foreach($date_map as $date){
	$sql="select a.*,a.sales/b.sales as percent from (select brand_name,category,date_format(date,'%Y') as year,'双十一' as month,shop_name,sum(sales/100) as sales,sum(num) as num
	from artificial.entity_1366 
	where brand_name='Chanel' and category='$category' and date='$date' 
	group by sid order by sum(sales) desc limit 10) a  
	left join 
	(select brand_name,category,date_format(date,'%Y') as year,'双十一' as month,sum(sales/100) as sales
	from artificial.entity_1366 
	where brand_name='Chanel' and category='$category' and date='$date' 
	) b on a.brand_name=b.brand_name and a.category=b.category and a.year=b.year and a.month=b.month";
	echo $sql;
	
	sql_to_csv_rank($sql,$fp);	
	}
}

fclose($fp);
echo "sheet 3_1 done\n";


/*
$fp= fopen("sheet3_2.csv","w"); 
$category_map=array('Skin Care','Makeup','Fragrance');
$date_map=array(2014,2015,2016,2017);



foreach($category_map as $category){
	foreach($date_map as $date){
	$sql="select a.*,a.sales/b.sales as percent from (select brand_name,category,date_format(date,'%Y') as year,shop_name,sum(sales/100) as sales,sum(num) as num
	from artificial.entity_1366 
	where brand_name='Chanel' and category='$category' and date_format(date,'%Y')='$date' and date<'2017-06-01' 
	group by sid order by sum(sales) desc limit 10) a  
	left join 
	(select brand_name,category,date_format(date,'%Y') as year,sum(sales/100) as sales
	from artificial.entity_1366 
	where brand_name='Chanel' and category='$category' and date_format(date,'%Y')='$date' and date<'2017-06-01' 
	) b on a.brand_name=b.brand_name and a.category=b.category and a.year=b.year ";
	echo $sql;
	
	sql_to_csv_rank($sql,$fp);	
	}
}

fclose($fp);
echo "sheet 3_2 done\n";
*/



/*
//sheet 4
echo "creating sheet 4 \n";
$fp= fopen("sheet4.csv","w"); 
$category_map=array('Skin Care','Makeup','Fragrance');
$date_map=array('2016-11-11','2017-11-11');


foreach($date_map as $date){
	$sql="select a.*,a.sales/b.sales as percent from (select brand_name,date_format(date,'%Y') as year,'双十一' as month,shop_name,sum(sales/100) as sales,sum(num) as num
	from artificial.entity_1366 
	where brand_name='Chanel' and (category is not null and category !='others') and subcategory is not null and date='$date' 
	group by sid order by sum(sales) desc limit 10) a  
	left join 
	(select brand_name,date_format(date,'%Y') as year,'双十一' as month,sum(sales/100) as sales
	from artificial.entity_1366 
	where brand_name='Chanel' and date='$date' 
	) b on a.brand_name=b.brand_name  and a.year=b.year";
	//echo $sql;

	sql_to_csv_rank($sql,$fp);	
}


fclose($fp);
echo "sheet 4 done\n";
*/




//sheet 5

echo "creating sheet 5 \n";
$fp= fopen("sheet5.csv","w"); 
$brandname_map=array('Chanel','Dior','Bobbi Brown','Fresh','shiseido','Estee Lauder','Laneige','MAC','CPB','SKII','Lancome','LA MER','YSL','JO MALONE','kiehls');
$category_map=array('Skin Care','Makeup','Fragrance');
$subcategory_map=array('面膜','身体护理','others','面部磨砂/去角质','面部','眼部','彩妆工具','指甲','眼唇护理','男士护理','唇部','面部护理套装','洁面/卸妆','女士香水','其他香水','中性香水','彩妆套装','彩妆盘','防晒','男士香水','CC 霜','乳液/面霜','化妆水/爽肤水','面部精华');
$date_map=array('2016-11-11','2017-11-11');
foreach($brandname_map as $brand_name){
	foreach($subcategory_map as $subcategory){

		foreach($date_map as $date){
			$sql="select a.*,a.sales/b.sales as percent from (select brand_name,category,subcategory,date_format(date,'%Y') as year,'双十一' as month,tb_item_id,name,shop_name,sum(sales/100) as sales,sum(num) as num
			from artificial.entity_1366 
			where brand=$brand_name  and subcategory=$subcategory and date='$date' 
			group by tb_item_id order by sum(sales) desc limit 20) a  
			left join 
			(select brand_name,date_format(date,'%Y') as year,'双十一' as month,sum(sales/100) as sales
			from artificial.entity_1366 
			where brand=$brand_name and date='$date' 
			) b on a.brand_name=b.brand_name  and a.year=b.year and a.month=b.month";
			echo $sql;

			sql_to_csv_rank($sql,$fp);	
		}
	}
}



fclose($fp);
echo "sheet 5 done\n";




/*
echo "creating sheeet 5\n";
$fp= fopen("sheet5_1.csv","w"); 
$sql="select category,date_format(date,'%Y') as year,count(distinct(sid)) as shopnum 
from artificial.entity_1366 
where   date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') 
group by category,date_format(date,'%Y')
union 
select 'Total' as category,date_format(date,'%Y') as year,count(distinct(sid)) as shopnum 
from artificial.entity_1366 
where   date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') 
group by date_format(date,'%Y')
order by year,category";
sql_to_csv($sql,$fp);
fclose($fp);



$fp= fopen("sheet5_2.csv","w"); 
$sql="select shop_type,date_format(date,'%Y') as year,count(distinct(sid)) as shopnum 
from artificial.entity_1366 
where   date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') 
group by shop_type,date_format(date,'%Y')
union
select 'Total' as shop_type,date_format(date,'%Y') as year,count(distinct(sid)) as shopnum 
from artificial.entity_1366 
where   date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') 
group by date_format(date,'%Y')
order by year,shop_type";
sql_to_csv($sql,$fp);
fclose($fp);


echo "sheeet 5 done\n";
*/

//sheet 6
/*
echo "creating sheeet 6\n";
$fp= fopen("sheet6_1.csv","w"); 
$sql="select brand_name,category,date_format(date,'%Y') as year,count(distinct(sid)) as shop_num
from artificial.entity_1366 
where    date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') and  (brand_name is not null and brand_name !='') 
group by brand_name,category,date_format(date,'%Y')
union
select brand_name,'Total' as category,date_format(date,'%Y') as year,count(distinct(sid)) as shop_num
from artificial.entity_1366 
where    date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') and  (brand_name is not null and brand_name !='') 
group by brand_name,date_format(date,'%Y')
order by brand_name,category,year";
sql_to_csv($sql,$fp);
fclose($fp);
$fp= fopen("sheet6_2.csv","w"); 
$sql="select brand_name,shop_type,date_format(date,'%Y') as year,count(distinct(sid)) as shop_num
from artificial.entity_1366 
where   date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') and (brand_name is not null and brand_name !='') 
group by brand_name,shop_type,date_format(date,'%Y')
union
select brand_name,'Total' as shop_type,date_format(date,'%Y') as year,count(distinct(sid)) as shop_num
from artificial.entity_1366 
where   date>'2013-12-31' and date<'2017-10-01' and (category is not null and category !='others') and (brand_name is not null and brand_name !='') 
group by brand_name,date_format(date,'%Y')
order by brand_name,shop_type,year";
sql_to_csv($sql,$fp);
fclose($fp);
echo "sheeet 6 done\n";
*/

//sheet 7
/*
echo "creating sheeet 7_1\n";
$fp= fopen("sheet7_1.csv","w"); 
$sql="select brand_name,category,subcategory,
case when sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666) then '旗舰店' when shop_name like '%旗舰店%' then '专营店' when shop_name like '%专营店%' then '专营店' when shop_name like '%专卖店%' then '专卖店' else 'Others' end shoptype,
date_format(date,'%Y') as year,date_format(date,'%m') as month,sum(sales/100) as sales ,sum(num) as num ,count(distinct(sid)) as shopnum
from artificial.entity_1366 
where date>'2013-12-31' and date<'2017-10-01'  and (category is not null and category !='others') and subcategory is not null and  (brand_name is not null and brand_name !='') 
group by brand_name,category,subcategory,shoptype,date_format(date,'%Y%m')
union
select brand_name,category,'Total' as subcategory,
case when sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666) then '旗舰店' when shop_name like '%旗舰店%' then '专营店' when shop_name like '%专营店%' then '专营店' when shop_name like '%专卖店%' then '专卖店' else 'Others' end shoptype,
date_format(date,'%Y') as year,date_format(date,'%m') as month,sum(sales/100) as sales ,sum(num) as num ,count(distinct(sid)) as shopnum
from artificial.entity_1366 
where date>'2013-12-31' and date<'2017-10-01'  and (category is not null and category !='others') and subcategory is not null and  (brand_name is not null and brand_name !='') 
group by brand_name,category,shoptype,date_format(date,'%Y%m')
union
select brand_name,'Total' as category,'Total' as subcategory,
case when sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666) then '旗舰店' when shop_name like '%旗舰店%' then '专营店' when shop_name like '%专营店%' then '专营店' when shop_name like '%专卖店%' then '专卖店' else 'Others' end shoptype,
date_format(date,'%Y') as year,date_format(date,'%m') as month,sum(sales/100) as sales ,sum(num) as num ,count(distinct(sid)) as shopnum
from artificial.entity_1366 
where date>'2013-12-31' and date<'2017-10-01'  and (category is not null and category !='others') and subcategory is not null and  (brand_name is not null and brand_name !='') 
group by brand_name,shoptype,date_format(date,'%Y%m')
order by brand_name,category,subcategory,shoptype,year,month";
sql_to_csv($sql,$fp);
fclose($fp);
echo "sheeet 7_1 done\n";//10-23改为Others
*/
/*10-23号后删除
echo "creating sheeet 7_2\n";
$fp= fopen("sheet7_2.csv","w"); 
$sql="select brand_name,category,subcategory,
case when sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666) then '旗舰店' when shop_name like '%旗舰店%' then '专营店' when shop_name like '%专营店%' then '专营店' when shop_name like '%专卖店%' then '专卖店' else 'Other' end shoptype,
date_format(date,'%Y') as year,sum(sales/100) as sales ,sum(num) as num ,count(distinct(sid)) as shopnum
from artificial.entity_1366 
where date>'2013-12-31' and date<'2017-10-01'  and (category is not null and category !='others') and subcategory is not null and  (brand_name is not null and brand_name !='') 
group by brand_name,category,subcategory,shoptype,date_format(date,'%Y')
union
select brand_name,category,'Total' as subcategory,
case when sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666) then '旗舰店' when shop_name like '%旗舰店%' then '专营店' when shop_name like '%专营店%' then '专营店' when shop_name like '%专卖店%' then '专卖店' else 'Other' end shoptype,
date_format(date,'%Y') as year,sum(sales/100) as sales ,sum(num) as num ,count(distinct(sid)) as shopnum
from artificial.entity_1366 
where date>'2013-12-31' and date<'2017-10-01'  and (category is not null and category !='others') and subcategory is not null and  (brand_name is not null and brand_name !='') 
group by brand_name,category,shoptype,date_format(date,'%Y')
union
select brand_name,'Total' as category,'Total' as subcategory,
case when sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666) then '旗舰店' when shop_name like '%旗舰店%' then '专营店' when shop_name like '%专营店%' then '专营店' when shop_name like '%专卖店%' then '专卖店' else 'Other' end shoptype,
date_format(date,'%Y') as year,sum(sales/100) as sales ,sum(num) as num ,count(distinct(sid)) as shopnum
from artificial.entity_1366 
where date>'2013-12-31' and date<'2017-10-01'  and (category is not null and category !='others') and subcategory is not null and  (brand_name is not null and brand_name !='') 
group by brand_name,shoptype,date_format(date,'%Y')
order by brand_name,category,subcategory,shoptype,year";
sql_to_csv($sql,$fp);
fclose($fp);
echo "sheeet 7_2 done\n";
*/





//sheet 8
echo "creating sheeet 8\n";
$fp= fopen("sheet8.csv","w"); 
$sql="select a.*,a.sales/b.sales as percent from
(select brand_name,shop_name,category,subcategory,
date_format(date,'%Y') as year,'双十一' as month,sum(sales/100) as sales ,sum(num) as num
from artificial.entity_1366 
where (date='2016-11-11' or date='2017-11-11')  and (category is not null and category !='others') and  (brand_name is not null and brand_name !='') and sid in(67205748,168546218,188659566,173135867,188131757,12815168,163647538,185497853,12360236,167095446,188301666)
group by brand_name,shop_name,category,subcategory,date_format(date,'%Y%m')
order by brand_name,category,subcategory,date_format(date,'%Y%m')) a 
left join 
(select brand_name,date_format(date,'%Y') as year,'双十一' as month,sum(sales/100) as sales 
from artificial.entity_1366 
where (date='2016-11-11' or date='2017-11-11')  and (category is not null and category !='others') and  (brand_name is not null and brand_name !='') 
group by brand_name,date_format(date,'%Y%m')
) b on a.brand_name=b.brand_name  and a.date=b.date ";
sql_to_csv($sql,$fp);
fclose($fp);
echo "sheeet 8 done\n";



function sql_to_csv($sql,$fp){
	date_default_timezone_set("PRC");
	$t1=microtime(true);
	$date1=date("H-i-s");
	echo "strat at $date1 \n";
	$pdo=cpdo();
	$result=$pdo->query($sql)->fetchAll();	
	//print_r ($result);
	//$resultall=$pdo->query($sql)->fetchAll();
	$flag=0;
	foreach($result as $unit){
		$tip=0;
		foreach($unit as $head=>$headvalue){
			if($tip%2==0){
				$headline.=$head.",";
				$headvalueline.=$headvalue.",";
			}
			$tip++;
		}
		
		if($flag==0){
			fwrite($fp,$headline."\n");
		}
		fwrite($fp,$headvalueline."\n");
		$headline='';
		$headvalueline='';
		$flag++;
	}
	$date2=date("H-i-s");
	$t2=microtime(true);
	echo "end at $date2 \n";
	echo 'use'.round($t2-$t1,3)."sec\n";
}


function sql_to_csv_rank($sql,$fp){
	date_default_timezone_set("PRC");
	$t1=microtime(true);
	$date1=date("H-i-s");
	echo "strat at $date1 \n";
	$pdo=cpdo();
	$result=$pdo->query($sql)->fetchAll();	
	
	//print_r ($result);exit;
	//$resultall=$pdo->query($sql)->fetchAll();
	$flag=0;
	foreach($result as $rank=>$unit){
		$tip=0;
		foreach($unit as $head=>$headvalue){
			if($tip%2==0){
				if($head=='month'){//10-23改为rank排名在month后
				$headline.=$head.",rank,";
				$headvalueline.=$headvalue.",".($rank%10+1).",";
				}else{
				$headline.=$head.",";
				$headvalueline.=$headvalue.",";	
				}
			}
			$tip++;
		}
		
		if($flag==0){
			fwrite($fp,$headline."\n");
		}
		fwrite($fp,$headvalueline."\n");
		$headline='';
		$headvalueline='';
		$flag++;
	}
	$date2=date("H-i-s");
	$t2=microtime(true);
	echo "end at $date2 \n";
	echo 'use'.round($t2-$t1,3)."sec\n";
}




function cpdo(){
		$dsn='mysql:host=127.0.0.1;dbname=dw_entity;port=18306';
		$user_name='qbt';
		$user_pw='QBT094bt';
		$pdo = new PDO($dsn, $user_name, $user_pw);//3956468
		$pdo->exec("SET NAMES 'utf8'");
		return $pdo;
}	


/*
 function cpdo(){
                $dsn='mysql:host=192.168.0.18;dbname=dw_entity;port=3306';
                $user_name='apollo-rw';
                $user_pw='QBT094bt';
                $pdo = new PDO($dsn, $user_name, $user_pw);
                $pdo->exec("SET NAMES 'utf8'");
                return $pdo;
}

*/








