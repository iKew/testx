<?php
$access_token = 'nbNiHyLgU5prZPC7JvvpNZgnX2zGYIihVT8tA4vQrdH1sILvxpfPjzM4YpBauEQkeIXVLtCUm1OY0yfvA6TtU+1sS8sp/+kdmSjZWENUDMWMq8vAkT0PJxsqYJdxtEqzsnvNfLTyCX45iVXfVV8lgFGUYhWQfeY8sLGRXgo3xvw=';


$url = 'https://api.line.me/v2/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;