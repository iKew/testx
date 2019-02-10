<?php // callback.php

require 'vendor/autoload.php';
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');
require_once 'PDO.php';

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

$columns = array();
$conn = conpdo('localhost','id8699731_pyrc','id8699731_pyrc','volk20021997');
$sql = "SELECT * FROM `menu` LIMIT 5";
$rs = getpdo($conn ,$sql);
foreach ($rs as $value) {

	$data = [
		"thumbnailImageUrl" => "https://pyrc.000webhostapp.com/administer/uploads/".$value['menu_img'],
		"title" => $value['menu_name'],
		"text" => $value['menu_price'],
		"actions" => [
			[
				"type" => "url",
				"label" => 'View detail',
				'uri' => 'https://pyrc.000webhostapp.com/index.php?user='.$userId.'&menu=menu'.$value['menu_id'],
			],
		]
	];
	array_push($columns,$data);
}

$messages = [
	"type"=> "template",
	"altText"=> "this is a carousel template",
	"template"=> [
		"type"=> "carousel",
		"actions"=> [],
		"columns"=> $columns
	]
];

$data = [
	'replyToken' => $replyToken,
	'messages' => [$messages],
];
$post = json_encode($data);

$headers = array('Content-Type: application/json', 'cache-control: no-cache', 'Authorization: Bearer ' . $access_token);

if(isset($intent) && $intent == 'BUY'){
	$curl = curl_init();
	curl_setopt_array($curl, array(
		CURLOPT_URL => 'https://api.line.me/v2/bot/message/reply',
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
}
