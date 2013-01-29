<?php


$to = isset($_GET['to'])?trim($_GET['to']):'';
$name = isset($_GET['name'])?trim($_GET['name']):'';
$email = isset($_GET['email'])?trim($_GET['email']):'';
$content = isset($_GET['content'])?trim($_GET['content']):'';

$error = true;
if($to == '' || $email == '' || $content == '' || $name == '') $error = false;



if($error){
	$subject = 'A message from '.$name;
	$headers = 'From: '.$email . "\r\n" . 'Reply-To: '.$email . "\r\n";
	mail($to, $subject, $content, $headers);
}