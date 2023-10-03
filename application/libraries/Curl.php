<?php 

class Curl{

	private $url;
    public function __construct()
    {

       $CI =& get_instance();
       $CI->load->helper('url');
       $CI->load->library('session');
       $CI->load->database();
       //$this->url = "http://phplaravel-775269-2637853.cloudwaysapps.com/api/";
      $this->url = "https://api2.listmyticket.com/api/";
      // $this->url = "http://phplaravel-871000-3013214.cloudwaysapps.com/api2/api/";
    }

    function post($path,$data="")
    {
    	
       	$url = $this->url.$path;
		$postdata = json_encode($data);
		$headers =  array(
				'Content-Type: application/json','domainkey: https://www.1boxoffice.com/en/');
		$ch = curl_init($url); 
		curl_setopt($ch, CURLOPT_POST, true);
		if($postdata) curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		curl_setopt($ch, CURLOPT_HTTPHEADER,$headers);
		$result = curl_exec($ch);
		curl_close($ch);
		// echo "<pre>";
		// print_r (json_decode($result));
		return json_decode($result,true);
    }
}