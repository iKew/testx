<?php // callback.php

$access_token = 'nbNiHyLgU5prZPC7JvvpNZgnX2zGYIihVT8tA4vQrdH1sILvxpfPjzM4YpBauEQkeIXVLtCUm1OY0yfvA6TtU+1sS8sp/+kdmSjZWENUDMWMq8vAkT0PJxsqYJdxtEqzsnvNfLTyCX45iVXfVV8lgFGUYhWQfeY8sLGRXgo3xvw=';


date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');
$time = date('H:i:s');
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$replyToken = $request['originalDetectIntentRequest']['payload']['data']['replyToken'];
$queryText = $request['queryResult']['queryText'];
$userId = $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];
$intent = $request['queryResult']['intent']['displayName'];
$log = $date.'-'.$time.'\t'.$userId.'\t'.$queryText.'\n';

$messages = [
	'type' => 'text',
	'text' => 'ไอห่าโฟร์ค'
];

$data = [
	'to' => 'U3a23ef7fc7a6bff7cb7400d5f829b5fe',
	'messages' => [$messages],
];
$post = json_encode($data);

$headers = array('Content-Type: application/json', 'cache-control: no-cache', 'Authorization: Bearer ' . $access_token);

$curl = curl_init();
curl_setopt_array($curl, array(
	CURLOPT_URL => 'https://api.line.me/v2/bot/message/push',
	CURLOPT_SSL_VERIFYPEER => false,
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => '',
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => 'POST',
	CURLOPT_POSTFIELDS => $post,
	CURLOPT_HTTPHEADER =>$headers,
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
	echo 'cURL Error #:' . $err;
} else {
	echo $response;

}