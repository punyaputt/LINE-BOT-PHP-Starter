<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
 //oHsGoAFIBFIoUHn2Gio8UuTrnv6EtuUYaWM7STkebTm mytoken
 //wcyEAm1ppXmTosJbJnzChSz3won2MBNNkFxdv9RHkK7 secure group token
$token = "wcyEAm1ppXmTosJbJnzChSz3won2MBNNkFxdv9RHkK7"; //ใส่Token ที่copy เอาไว้
$cctv = "http://baokung.ddns.eagleeyes.tw:1414";


$str = "เกิดเหตุฉุกเฉิน โปรดเช็คกล้องที่ http://baokung.ddns.eagleeyes.tw:1414"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
 
$res = notify_message($str,$token);

print_r($res);

function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}
?>
