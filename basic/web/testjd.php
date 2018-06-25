<?php 

include 'yggdrasil.php';
$cat_id = new ygdrasil();
$cat_id->initial();
$url="https://ai.jd.com/index_new?app=Seckill&action=pcSeckillBrand&callback=pcSeckillBrand";//各种列表页面以及部分商品
$cat_id->set("/{.*}/",$url); 
$cat_id->go();
$resultF1 = $cat_id->result[0];

print_r($resultF1);
/*
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,'https://www.jd.com/');
curl_setopt($ch,CURLOPT_HEADER,FALSE);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_jar);
$page=curl_exec($ch);

print_r($page);