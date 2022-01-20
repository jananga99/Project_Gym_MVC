<?php
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/notification.css" ?>>
    <title>Session Message Send</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Notifications" => BASE_DIR . "Notification",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

    <div class="container">

        <h2>Session Message Send</h2>


        <form class="m-3" action=<?= BASE_DIR . "Message/send" ?> method="post">
            <!-- <div class="d-flex justify-content-center flex-row bd-highlight mb-3"> -->
                <div>
                <label for="">Session Id</label>
                <input class="form-control" type="text" name="session_id" value=<?=$_SESSION['data']['session_id'];?> readonly> <br>
                </div>

                <div>
                <input class="form-control" placeholder="type your msg here" type="text" name="message">
                <input type="text" name="message_type" readonly style='display:none' value=<?=MESSAGE_COACH_TO_SESSION_REGISTERED_CUSTOMERS?>>
                <input class='btn btn-outline-light m-2 ' type="submit" value="SEND">
                </div>

            <!-- </div> -->
        </form>

        <div>
            <h3>Registered Customers For The Session</h3>
            <?php
                if(isset($_SESSION['registered_customers_session']) && count($_SESSION['registered_customers_session'])>0){
                    echo "
                    <p>Number of Registered Customers   :    ".count($_SESSION['registered_customers_session'])."</p>
                    <table class='table table-bordered table-hover' style='color:white'>
                        <tr>
                            <th>Customer Email</th>
                            <th></th>
                        </tr>";
                    foreach($_SESSION['registered_customers_session'] as $customer_email){
                        echo "
                            <tr>
                                <td>".$customer_email."</td>
                                <td>
                                    <form method='post' action=".BASE_DIR."Customer/view/".$customer_email.">
                                        <button class='btn btn-outline-light btn-sm'>View Customer</button>
                                    </form>
                                </td>
                            </tr>
                        ";
                    }
                    echo "</table>";
                }else{
                    echo "
                        <div class='d-flex justify-content-center' >
                            <p>No Customers registered yet.</p>
                        </div>
                    ";
                }
            
            ?>
        </div>       

    </div>
   
    <div class="d-flex justify-content-center" >
        <p><?= $msg ?></p>
    </div>
   
   
   <?php
    require_once 'public/html/footer.html';
    ?>


</body>

</html>