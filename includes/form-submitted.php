<?php
$vin = $_POST['ove_vin'];
$ove_link = $_POST['ove_link'];
$retail_link = $_POST['retail_link'];
$name = trim($_POST['buyer_name']);
$email = trim($_POST['buyer_email']);
$phone = trim($_POST['buyer_phone']);
$subject = trim($_POST['buyer_subject']);
$message = $_POST['buyer_message'];
$car_link = $_POST['perma_link'];

if($name == ''){
	$notification = "<div class='error'><p> Name is required !</p></div>";
	return;
}
if(!is_email($email)){
	$notification = "<div class='error'><p> Invalid Email ! </p></div>";
	return;
}
$p = preg_replace('/[^0-9]/','',$phone);

if(strlen($p) != 10){
	$notification = "<div class='error'><p> Invalide Phone Number! </p></div>";
	return;
}

if(strlen($message) < 5){
	$notification = "<div class='error'><p> Empty Description! </p></div>";
	return;
}

$blogname = get_option('blogname');	
$to = 'daniel.tynski@voltierdigital.com';
$headers = 'From : '.$blogname.' < '.$email.' >' . "\r\n" .
	'Reply-To: '. $email . "\r\n" .
	'X-Mailer: PHP/' . phpversion();

$msg = " Name: $name \n Email: $email \n Phone: $phone \n Car Link: $car_link \n Ove Link: $ove_link \n Retail Link: $retail_link \n Message: $message";
if(wp_mail($to,$subject,$msg,$headers)){
	$notification = "<div class='updated'><p>Email has been sent! </p></div>";
	
}
else{
	$notification = "<div class='error'><p> Email can't be sent! Please check the information and try again </p></div>";
}
