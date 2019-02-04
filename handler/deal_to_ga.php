<?php

date_default_timezone_set("Europe/Moscow");


$precious = str_replace('.00','',$_GET["sum"]);

$ga_cid = $_GET["ga_cid"];

$ga_sent = $_GET["ga_sent"];


if(!$ga_sent){


    $curlURL = 'https://www.google-analytics.com/collect?v=1&tid=UA-133447071-1&cid='.$ga_cid.'&t=event&ec=b24&ea=deal&el=won&ev='.$precious.'&dh=karmy.su&dp=/home';


    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_RETURNTRANSFER => 1,
        
        CURLOPT_URL => $curlURL,
        
    ));
    $sendURL = curl_exec($myCurl);
    curl_close($myCurl);


    if($sendURL){

        $fd = fopen("log_deals.txt", 'a') or die("cant open file");

$str = "\n Deal triggered at: ".date("Y-m-d H:i:s",time())." SUM: ".$precious." :: cid: ".$ga_cid." :: ga_sent: ".$ga_sent."\n";


        $str = "Sent to GA at: ".date("Y-m-d H:i:s",time())." \n ";
        fwrite($fd, $str);

    }

    else{

        $str = "Error sending to GA at: ".date("Y-m-d H:i:s",time())." \n ";
        fwrite($fd, $str);
    }

}

else{

    $str = "\n Unable to send to GA at: ".date("Y-m-d H:i:s",time())." cos GA_SENT param= ".$ga_sent."\n ";
    fwrite($fd, $str);
}

fclose($fd);

