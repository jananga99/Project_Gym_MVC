<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Send</title>
</head>
<body>
    
    <h1>Message Send</h1>


    <form action=<?=BASE_DIR."Message/send"?> method="post">

        <input type="text" name="message" >
        <input type="submit" value="SEND">



    </form>



</body>
</html>