<?php
include 'yggdrasil.php';


$cat_id = new ygdrasil();
$cat_id->initial();





	$url = 'https://www.kaola.com/product/1342466.html?ri=33660&rt=product&zid=zid_1842210488&zp=product1&zn=%E7%B2%BE%E9%80%89%E6%8E%A8%E8%8D%90';
	

	$cat_id->set("/.*/",$url); 
	$cat_id->go();
	$resultF = $cat_id->result[0];
	
	print_r($resultF);
	

	
	
	
	
	
	
	
	
	
	
	
	
	
	