<?php
class ygdrasil{
	
	public $zhengze;
	public $url;
	public $result;
	public $ch;
	public $page;
	
	
	
	public function initial(){
	$this->ch = curl_init();
	}
	
	public function set($zhengzez,$urlz){
		
		$this->zhengze = $zhengzez;
		$this->url = $urlz;	
		curl_setopt($this->ch,CURLOPT_URL,$this->url);
		curl_setopt($this->ch,CURLOPT_HEADER,TRUE);
		curl_setopt($this->ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION,1);
		//curl_setopt($ch,CURLOPT_HEADER,FALSE);
		//curl_setopt($ch,CURLOPT_RETURNTRANSFER,TRUE);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST,false);
		curl_setopt($this->ch,CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.101 Safari/537.36");
		if($this->page=curl_exec($this->ch))
			echo "";
		else
			echo "fail";		
	}
	
	public function go(){
		return preg_match_all($this->zhengze,$this->page,$this->result);	
	}
	
	public function view(){
		print_r($this->result);
	}	
	
	public function shut(){
		curl_close($this->ch);

	}
}

/*
$catid = new ygdrasil();
$catid->set("/\/\/item\.jd\.com\/[0-9]*\.html/",
		    "http://list.jd.com/list.html?cat=670,671,673");
$catid->go();
$a=$catid->result; 
print_r($a);
//$catid->view();
$catid->shut();
*/