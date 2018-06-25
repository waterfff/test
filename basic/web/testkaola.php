<?php 
$today = date("Y-m-d");
$tomonth=date("Ym");
$stocktable="stock_$tomonth";



function sts($project_id){
	$postFields = array(
            'username' => 'admin',
            'password' => "spider",
            
	);
	$ch = curl_init();
	$cookie_jar = "pachongdenglu$project_id.tmp";
	curl_setopt($ch,CURLOPT_URL,'http://stat.qbtchina.com:8000/login');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postFields));
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
	curl_exec($ch);
	curl_close($ch);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,'http://stat.qbtchina.com:8000/stat');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
	$page=curl_exec($ch);
	preg_match_all("/<td><a href=\"\/stat\/remain_task\?id=$project_id\">$project_id<\/a><\/td>\s*.*\s+.*\s+(.*)\s+.*/",$page,$result);
	preg_match("/(?<=<span class=\"finished\">)[0-9]+(?=<\/span>)/",$result[0][0],$backnum);
	curl_close($ch);
	//unlink($cookie_jar);
	return $backnum[0];	
}

$eight=sts(1000417);
$night=sts(1000418);

print_r($eight);
print_r($night);