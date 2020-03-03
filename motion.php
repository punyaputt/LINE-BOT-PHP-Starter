<?php
$photo = $_GET["photo"];
define('LINE_API',"https://notify-api.line.me/api/notify");
 //oHsGoAFIBFIoUHn2Gio8UuTrnv6EtuUYaWM7STkebTm mytoken/
 //wcyEAm1ppXmTosJbJnzChSz3won2MBNNkFxdv9RHkK7 secure group token
$token = "Xr0dlthqsczXQjQVlcHzRvFCy6qTPiwRNhCEkfx5YyL"; //ใส่Token ที่copy เอาไว้
$access_token = "Xr0dlthqsczXQjQVlcHzRvFCy6qTPiwRNhCEkfx5YyL";
$cctv = "http://baokung.ddns.eagleeyes.tw:1414";
$line_api = 'https://notify-api.line.me/api/notify';


$str = "detected"; //ข้อความที่ต้องการส่ง สูงสุด 1000 ตัวอักษร


 
$res = notify_message($str,$token); //ไม่รันฟังชั่นเลย แต่รันเป้นการแทนตัวแปรเพื่อรับค่ารีเทิร์น


print_r($res);


function notify_message($message,$token){ //รูปแบบลำดับตัวแปรขณะเรียกฟังก์ชั่น
 $queryData = array('message' => $message  ); //'ชื่ออาเร' => $ค่าอาเร
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
$imageFile = new CurlFile('temp.jpg','image/jpg','temp.jpg');
$message_data = array('imageFile' => $imageFile);

$result = send_notify_message($line_api, $access_token, $message_data);
print_r($result);

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
