<?php
require "vendor/autoload.php";

$access_token = 'nbNiHyLgU5prZPC7JvvpNZgnX2zGYIihVT8tA4vQrdH1sILvxpfPjzM4YpBauEQkeIXVLtCUm1OY0yfvA6TtU+1sS8sp/+kdmSjZWENUDMWMq8vAkT0PJxsqYJdxtEqzsnvNfLTyCX45iVXfVV8lgFGUYhWQfeY8sLGRXgo3xvw=';

$channelSecret = 'cb793858eacb4e1fa813e3d98334bce8';
$idPush = 'U3f2bf07d27dc888a5ac554fa42b99f20'
$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient($access_token);
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => $channelSecret]);
$textMessageBuilder = new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('รักอายน้าาาาา :3');
$response = $bot->pushMessage($idPush, $textMessageBuilder);

echo $response->getHTTPStatus() . ' ' . $response->getRawBody();