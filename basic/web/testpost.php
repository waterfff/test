<?php 
$today = date("Y-m-d");
var_dump($today);
echo "\n";
/*
function sts($project_id,$today){
	$postFields = array(
            'user' => 'fu.yukun',
            'passwd' => "j6v}D4Zrpw*4",       
	);
	
	$data_string =  json_encode($postFields);
	//print_r($data_string);
	$ch = curl_init();
	$cookie_jar = "D://excercise//basic//web//pachongdenglu.tmp";
	curl_setopt($ch,CURLOPT_URL,'https://stat.qbtchina.com:8000/api/user');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
	curl_exec($ch);
	//print_r($test);
	curl_close($ch);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,'https://stat.qbtchina.com:8000/api/project/stat');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
	$page=curl_exec($ch);
	$page_json=json_decode($page,true);
	//print_r($page_json);
	
	foreach($page_json['data'] as $data){
		echo $data['id']."\n";
		if($data['id']==$project_id){
			
			print_r($data[$today][0]);
			break;
		}	
	}
*/
	
	//preg_match_all("/<td><a href=\"\/stat\/remain_task\?id=$project_id\">$project_id<\/a><\/td>\s*.*\s+.*\s+(.*)\s+.*/",$page,$result);
	//preg_match("/(?<=<span class=\"finished\">)[0-9]+(?=<\/span>)/",$result[0][0],$backnum);
	//curl_close($ch);
	//unlink($cookie_jar);
	//return $backnum[0];	
	/*
}
*/

function sts($project_id,$today){
	$postFields = array(
            'user' => 'fu.yukun',
            'passwd' => "j6v}D4Zrpw*4",       
	);
	$data_string =  json_encode($postFields);
	$ch = curl_init();
	$cookie_jar = "D://excercise//basic//web//pachongdenglu.tmp";
	curl_setopt($ch,CURLOPT_URL,'https://stat.qbtchina.com:8000/api/user');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_jar);
	curl_exec($ch);
	curl_close($ch);
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,'https://stat.qbtchina.com:8000/api/project/stat');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
	$page=curl_exec($ch);
	$page_json=json_decode($page,true);
	//print_r($page_json);
	
	foreach($page_json['data'] as $data){
		if($data['id']==$project_id){
			//print_r($data[$today]);
			$success=$data[$today][0];
			break;
		}	
		
	}
	curl_close($ch);
	//unlink($cookie_jar);
	return $success;
}

echo sts(1000113,$today);

/*
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$this->url);
		curl_setopt($ch,CURLOPT_HEADER,FALSE);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);

		if($this->page=curl_exec($ch)){
			echo "";
		}else{
			echo "fail";		
		}*/