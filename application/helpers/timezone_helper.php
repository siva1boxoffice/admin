<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 

 

 function time_zone_calc($zone,$date)
    {
    $utc = new DateTimeZone('+0000');
    if($zone == ""){
    $zone= "0000";
    }
    $ph  = new DateTimeZone('+'.$zone);
    $datetime = new DateTime( $date, $utc ); // UTC timezone
    $datetime->setTimezone( $ph ); // Philippines timezone

    return $datetime->format('Y-m-d H:i:s');
    }

function pr($data){
   echo "<pre>";
   print_r($data);
   echo "</pre>";
}


function prd($data){
   echo "<pre>";
   print_r($data);
   echo "</pre>";
   die;
}
