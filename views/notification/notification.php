<?php
$notification_arr = $_SESSION['data'];
if (sizeof($notification_arr) == 0) $flag = 0;
else    $flag = 1;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php
    require("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/notification.css" ?>>
    <title>Notification</title>
</head>

<?php
$menu_arr = array(
    "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
    "Messages" => BASE_DIR . "Message",
    "Log Out" => BASE_DIR . "Auth/logout"
);
$navbar =  new Navbar($menu_arr);
echo $navbar->get();
?>


<body>

    <div class="container">

        <h1 class="m-4">Notifications</h1>

        <div class="m-4">
            <form action=<?=BASE_DIR."Notification"?> method='post'>
                <label >Show</label>
                <select name='select'>
                    <option value='unread' checked>Only unread notifications</option>
                    <option value='all'>All notifications</option>
                    <option value='read'>Only read notifications</option>
                </select><br>
                <button>Show Notifications</button>
            </form>
        </div>

        <?php
        if ($flag) {
            echo "<div>
            <table class='table table-hover' style='color:white'>
                <thead>
                    <tr>
                   
                    </tr>
                </thead>
                <tbody>";
            foreach ($notification_arr as $row) {
                echo "<tr>
                <td>" . $row['Details'] . "</td>
                <td>";
                if($row['Mark_As_Read']==0)
                    echo "
                        <form action=" . BASE_DIR . "Notification/markAsRead/".$row['Notification_id']." method='POST'>
                            <button class='btn btn-primary' name='mark_as_read'>Mark as Read</button>
                        </form>
                    ";
                echo "</td>
                <td><form action=" . BASE_DIR . "Notification/delete/".$row['Notification_id']." method='POST'>
                    <button  class='btn btn-danger' name='delete'>Delete</button>
                    </form>
                </td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        } else {
            echo "<p>You have no notifications yet.</p>";
        }
        ?>
    </div>


    <?php
    require 'public/html/footer.html';
    ?>


</body>



</html>