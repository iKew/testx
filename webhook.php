<?php

	date_default_timezone_set('Asia/Bangkok');
	$date = date('Y-m-d');
	$time = date('H:i:s');
	$json = file_get_contents('php://input');
	$request = json_decode($json, true);
	$queryText = $request['queryResult']['queryText'];
	$userId = $request['originalDetectIntentRequest']['payload’][‘data']['source']['userId'];
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


?>