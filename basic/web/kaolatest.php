<?php

	$data_string = '{"pageSize":20,"pageNo":1,"sortType":0,"desc":1,"key":" 钥匙包 男","hasMore":1,"filterList":[{"hidden":false,"itemId":11,"itemName":"考拉服务","itemType":0,"list":[],"lower":-1,"showLine":0,"upper":-1},{"hidden":false,"itemId":12,"itemName":"价格","itemType":1,"list":[],"lower":-1,"maxShowLine":1,"showLine":1,"upper":-1},{"hidden":false,"itemId":13,"itemName":"品牌","itemType":2,"list":[],"lower":-1,"maxShowLine":8,"showLine":3,"upper":-1},{"hidden":false,"itemId":14,"itemName":"分类","itemType":0,"list":[],"lower":-1,"showLine":2,"upper":-1},{"hidden":false,"id":"631","itemId":15,"itemName":"开袋方式","itemType":0,"list":[],"lower":-1,"maxShowLine":2,"showLine":1,"upper":-1},{"hidden":false,"id":"100611","itemId":15,"itemName":"产品材质","itemType":0,"list":[],"lower":-1,"maxShowLine":2,"showLine":1,"upper":-1},{"hidden":false,"id":"100233","itemId":15,"itemName":"风格","itemType":0,"list":[],"lower":-1,"maxShowLine":3,"showLine":1,"upper":-1},{"hidden":false,"id":"633","itemId":15,"itemName":"外形","itemType":0,"list":[],"lower":-1,"maxShowLine":1,"showLine":1,"upper":-1},{"hidden":false,"id":"100234","itemId":15,"itemName":"适用场景","itemType":0,"list":[],"lower":-1,"maxShowLine":3,"showLine":1,"upper":-1},{"hidden":false,"id":"100605","itemId":15,"itemName":"款式","itemType":0,"list":[],"lower":-1,"maxShowLine":2,"showLine":1,"upper":-1},{"hidden":false,"id":"100224","itemId":15,"itemName":"适用群体","itemType":0,"list":[],"lower":-1,"maxShowLine":1,"showLine":1,"upper":-1},{"hidden":false,"id":"100235","itemId":15,"itemName":"包内部结构","itemType":0,"list":[],"lower":-1,"maxShowLine":2,"showLine":1,"upper":-1},{"hidden":false,"id":"501946","itemId":15,"itemName":"折数","itemType":0,"list":[],"lower":-1,"maxShowLine":1,"showLine":1,"upper":-1},{"hidden":false,"id":"100250","itemId":15,"itemName":"闭合方式","itemType":0,"list":[],"lower":-1,"maxShowLine":1,"showLine":1,"upper":-1},{"hidden":false,"itemId":16,"itemName":"国家/地区","itemType":0,"list":[],"lower":-1,"maxShowLine":4,"showLine":1,"upper":-1}],"isMarket":false,"marketCategory":"","t":1525855556952}';
	$data_string =  json_encode($data_string,320);
	$header=array('Accept: application/json',
			'Accept-Encoding: gzip, deflate, br',
			'Accept-Language: zh-CN,zh;q=0.8,zh-TW;q=0.7,zh-HK;q=0.5,en-US;q=0.3,en;q=0.2',
			'Connection: keep-alive',
			'Content-Length: 3021',
			'Content-Type: application/json',
			'Cookie: usertrack=O2+gylryp1hEmhXrAxSFAg==; _ntes_nnid=866bc55e304625f8b5915720d565520c,1525852010860; __da_ntes_utma=163396704.1014973479.1525852011.1525852011.1525852011.1; davisit=13; __da_ntes_utmb=163396704.26.10.1525852011; __da_ntes_utmz=163396704.1525852011.1.1.utmcsr%3D(direct)%7Cutmccn%3D(direct)%7Cutmcmd%3D(none); __da_ntes_utmfc=utmcsr%3D(direct)%7Cutmccn%3D(direct)%7Cutmcmd%3D(none); MKAOLA=f4cd01b8e6f34f5555c5a791a0d3a21d9651b3ab; current_env=online; __kaola_usertrack=20180509154633228605; _da_ntes_uid=20180509154633228605; JSESSIONID-WKL-8IO=gZazG8OR69HYC3XQ0j72EqBSxSPOTgZKocDhygAyx7bqWlnluQHZqSoDhbQ2MdscpNqekvc9X9um2JsAuVTEyDxv0HAUml9ABnxugi5viX2HtmqRbcDG16YzHOeouX3aO%2BKiuWcHbUiWD87lk9A%2Bq8x6uk%5Ca7REM%5CziC7qZk2zwIaLlc%3A1525938411298; _klhtxd_=31; kl_newpopup=1; NTES_KAOLA_ADDRESS_CONTROL=310000|310100|310101|1; WM_TID=uYYdeQO6JHugTQJE7WBLX5vivdj0Ynnu',
			'Host: m.kaola.com',
			'Referer: https://m.kaola.com/goods/search.html?key=+%E9%92%A5%E5%8C%99%E5%8C%85+%E7%94%B7&zp=input&zn=h5Search',
			'User-Agent: User-Agent:Mozilla/5.0 (iPhone; U; CPU iPhone OS 4_3_3 like Mac OS X; en-us) AppleWebKit/533.17.9 (KHTML, like Gecko) Version/5.0.2 Mobile/8J2 Safari/6533.18.5',
			'X-Requested-With: XMLHttpRequest');
	print_r($data_string);
	print_r($header);
	//exit;
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,'https://m.kaola.com/ajax/searchlist.html');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	curl_setopt($ch, CURLOPT_POST, true);
	//curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	
	$page=curl_exec($ch);
	//$page_json=json_decode($page,true);
	
	print_r($page);
	curl_close($ch);
	/*
	$ch = curl_init();
	curl_setopt($ch,CURLOPT_URL,'https://m.kaola.com/activity/detail/getWapActivityShowZone/19238/15130062647190.shtml?t=1525852779604');
	curl_setopt($ch,CURLOPT_HEADER,FALSE);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
	$page=curl_exec($ch);
	print_r($page);
	
	*/
	
	
?>