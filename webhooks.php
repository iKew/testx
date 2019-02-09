<?php // callback.php

require 'vendor/autoload.php';
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'nbNiHyLgU5prZPC7JvvpNZgnX2zGYIihVT8tA4vQrdH1sILvxpfPjzM4YpBauEQkeIXVLtCUm1OY0yfvA6TtU+1sS8sp/+kdmSjZWENUDMWMq8vAkT0PJxsqYJdxtEqzsnvNfLTyCX45iVXfVV8lgFGUYhWQfeY8sLGRXgo3xvw=';

// // Get POST body content
// $content = file_get_contents('php://input');
// $events = json_decode($content, true);
//$userId = $events['originalDetectIntentRequest']['payload']['data']['source']['userId'];

// $replyToken = $events['responseId'];

// 			// Build message to reply back
// 			$messages = [
// 				'type' => 'text',
// 				'text' => 'dddd'
// 			];

// 			// Make a POST Request to Messaging API to reply to sender
// 			$url = 'https://api.line.me/v2/bot/message/reply';
// 			$data = [
// 				'replyToken' => $replyToken ,
// 				'messages' => [$messages],
// 			];
// 			$post = json_encode($data);


// 			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

//  			$ch = curl_init($url);
//  			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
//  			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//  			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//  			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//  			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
//  			$result = curl_exec($ch);
//  			curl_close($ch);

// 			echo $result . '\r\n';



//echo $content;
// Parse JSON
// $events = json_decode($content, true);
// // Validate parsed JSON data
// if (!is_null($events['events'])) {
// 	// Loop through each event
// 	foreach ($events['events'] as $event) {
// 		// Reply only when message sent is in 'text' format
// 		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
// 			// Get text sent
// 			$text = $event['source']['userId'];
// 			// Get replyToken
// 			$replyToken = $event['replyToken'];

// 			// Build message to reply back
// 			$messages = [
// 				'type' => 'text',
// 				'text' => $text
// 			];

// 			// Make a POST Request to Messaging API to reply to sender
// 			$url = 'https://api.line.me/v2/bot/message/reply';
// 			$data = [
// 				'replyToken' => $replyToken,
// 				'messages' => [$messages],
// 			];
// 			$post = json_encode($data);
// 			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

// 			$ch = curl_init($url);
// 			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// 			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 			$result = curl_exec($ch);
// 			curl_close($ch);

// 			echo $result . '\r\n';
// 		}
// 	}
// }
// 
//echo 'OK';
//




date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d');
$time = date('H:i:s');
$json = file_get_contents('php://input');
$request = json_decode($json, true);
$queryText = $request['queryResult']['queryText'];
$action = $request['queryResult']['action'];
$userId = $request['originalDetectIntentRequest']['payload']['data']['source']['userId'];
$myfile = fopen('log$date.txt', 'a') or die('Unable to open file!');
$log = $date.'-'.$time.'\t'.$userId.'\t'.$queryText.'\n';


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
		CURLOPT_POSTFIELDS => '{\r\n\r\n \'to\': \'userid_line ของเรา\',\r\n\r\n \'messages\': [{\r\n\r\n \'type\': \'text\',\r\n\r\n \'text\': \'$userId ส่งข้อความมาว่า $queryText\'\r\n\r\n }]\r\n\r\n}',
		CURLOPT_HTTPHEADER => array(
			'authorization: Bearer line_token',
			'cache-control: no-cache',
			'content-type: application/json',
			'postman-token: 7f766920-b207–53c4–6059–6d20ceec77ea'
		),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);

	if ($err) {
		echo 'cURL Error #:' . $err;
	} else {
		echo $response;
	}
