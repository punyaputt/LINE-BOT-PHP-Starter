<?php
define('LINE_API',"https://notify-api.line.me/api/notify");
 //oHsGoAFIBFIoUHn2Gio8UuTrnv6EtuUYaWM7STkebTm mytoken/
 //wcyEAm1ppXmTosJbJnzChSz3won2MBNNkFxdv9RHkK7 secure group token
$token = "Xr0dlthqsczXQjQVlcHzRvFCy6qTPiwRNhCEkfx5YyL"; //ใส่Token ที่copy เอาไว้
$access_token = "Xr0dlthqsczXQjQVlcHzRvFCy6qTPiwRNhCEkfx5YyL";
$cctv = "http://baokung.ddns.eagleeyes.tw:1414";
$line_api = 'https://notify-api.line.me/api/notify';

$absolute_path = realpath("temp.jpg");

print "Absolute path is: " . $absolute_path;


$str = "detected"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร
$imageFile = new CurlFile('C:/Users/Bao/Desktop/temp.jpg','image/jpg','temp.jpg');

 
$res = notify_message($str,$cfile,$token); //ไม่รันฟังชั่นเลย แต่รันเป้นการแทนตัวแปรเพื่อรับค่ารีเทิร์น
$result = send_notify_message($line_api, $access_token, $message_data);

print_r($res);
print_r($result);

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

//======================================================================================================================================
$message_data = array('imageFile' => $imageFile);

function send_notify_message($line_api, $access_token, $message_data){
   $headers = array('Method: POST', 'Content-type: multipart/form-data', 'Authorization: Bearer '.$access_token );

   $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $line_api);
   curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $message_data);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   $result = curl_exec($ch);
   // Check Error
   if(curl_error($ch))
   {
      $return_array = array( 'status' => '000: send fail', 'message' => curl_error($ch) );
   }
   else
   {
      $return_array = json_decode($result, true);
   }
   curl_close($ch);
return $return_array; //รีเทิร์นตัวแปรตามชื่อไปที่ตัว(แปร)เรียกฟังฟังชั่น
}
?>
