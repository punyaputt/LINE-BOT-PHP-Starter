<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
 //oHsGoAFIBFIoUHn2Gio8UuTrnv6EtuUYaWM7STkebTm mytoken/
 //wcyEAm1ppXmTosJbJnzChSz3won2MBNNkFxdv9RHkK7 secure group token
$token = "Xr0dlthqsczXQjQVlcHzRvFCy6qTPiwRNhCEkfx5YyL"; //ใส่Token ที่copy เอาไว้
$cctv = "http://baokung.ddns.eagleeyes.tw:1414";


$str = "detected"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$pic = curl_file_create('@temp.jpeg', 'image/jpeg', 'temp.jpeg');

 
$res = notify_message($img,$str,$pic,$token); //ไม่รันฟังชั่นเลย แต่รันเป้นการแทนตัวแปรเพื่อรับค่ารีเทิร์น

print_r($res);

function notify_message($message,$imageFile,$token){ //รูปแบบลำดับตัวแปรขณะเรียกฟังก์ชั่น
 $queryData = array('message' => $message , 'imageFile' => $imageFile ); //'ชื่ออาเร' => $ค่าอาเร
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
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
