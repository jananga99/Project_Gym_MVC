<?php
$backAddress="";
if(isset($_SESSION['back_flag'])){
    if($_SESSION['back_flag']==="createSession")
        $backAddress=BASE_DIR . "Session/create";
    elseif($_SESSION['back_flag']==="registerSession")
        $backAddress=BASE_DIR . "Session/register";
}
echo $backAddress;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
</head>
<body>
    
    <h1>PAYMENT SUCCESS</h1>

    <a href=<?=$backAddress; ?>>Go back to where you left</a>



</body>
</html>