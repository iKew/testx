<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

$access_token = 'nbNiHyLgU5prZPC7JvvpNZgnX2zGYIihVT8tA4vQrdH1sILvxpfPjzM4YpBauEQkeIXVLtCUm1OY0yfvA6TtU+1sS8sp/+kdmSjZWENUDMWMq8vAkT0PJxsqYJdxtEqzsnvNfLTyCX45iVXfVV8lgFGUYhWQfeY8sLGRXgo3xvw=';

// Get POST body content
$content = file_get_contents('php://input');
echo $content['responseId'];
$userId = $content['originalDetectIntentRequest']['payload']['data']['source']['userId'];

$replyToken = $content['responseId'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $userId
			];

			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => '51df74ef-06f0-d225-cba8-d8a71a295b05',
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";



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
// 			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
// 			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
// 			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
// 			$result = curl_exec($ch);
// 			curl_close($ch);

// 			echo $result . "\r\n";
// 		}
// 	}
// }
// 
// curl -X POST -H 'Content-Type: application/json' -d '{"responseId":"a36be434-21f4-416b-b020-3273fc54ab60","queryResult":{"queryText":"test","parameters":{"any":"test"},"allRequiredParamsPresent":true,"fulfillmentMessages":[{"text":{"text":["test $test"]},"platform":"LINE"},{"payload":{},"platform":"LINE"},{"text":{"text":[""]}}],"intent":{"name":"projects/volkenzo-92814/agent/intents/68358027-f1e6-44a7-885e-7ead1610b8f1","displayName":"test"},"intentDetectionConfidence":1,"diagnosticInfo":{"end_conversation":true},"languageCode":"th"},"originalDetectIntentRequest":{"payload":{}},"session":"projects/volkenzo-92814/agent/sessions/51df74ef-06f0-d225-cba8-d8a71a295b05"}' 'https://aqueous-refuge-61338.herokuapp.com/webhooks.php'
echo "OK";
