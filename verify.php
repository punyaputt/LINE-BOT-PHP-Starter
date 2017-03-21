<?php
$access_token = 'w+SWcsg4jof6nv79x2Z1j2Iyz/qtEYFPYEzpG1DhfLONgcdldUA6HhZFW6OkAuO097bY9ZRPPwqEMd36PYCyAxC2VSafarA0gB3mWcc4SEauoM4Tz0QBXo48ihqBQJH2rVVKTjMuj3fMRDzki3yqyQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
