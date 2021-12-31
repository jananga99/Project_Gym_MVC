<?php
$sent_arr = $_SESSION['sent_messages'];
if (sizeof($sent_arr) == 0) $sent_flag = 0;
else    $sent_flag = 1;
$receieved_arr = $_SESSION['receieved_messages'];
if (sizeof($receieved_arr) == 0) $receieved_flag = 0;
else    $receieved_flag = 1;
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
    <title>Messages</title>
</head>

<body>

    <!-- <a href=<?= BASE_DIR ?>>Dashbaord</a> -->

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
        <h1>Messages</h1>

        <h3>Sent Messages</h3>
        <?php
        if ($sent_flag) {
            echo "<table class='table table-hover' style='color:white'>
            <tbody>";
            foreach ($sent_arr as $row) {
                echo "<tr>
                <td>" . $row['Details'] . "</td>
                <td><form action=" . BASE_DIR . "Message/delete/" . $row['Message_id'] . " method='POST'>
                    <button  class='btn btn-danger' name='delete'>Delete</button>
                    </form>
                </td>
                </tr>";
            }
            echo "</tbody>
            </table>
        ";
        } else {
            echo "<p>You haven't send any messages yet.</p>";
        }
        ?>


        <h3>Receieved Messages</h3>
        <?php
        if ($receieved_flag) {
            echo "<table><tbody>";
            foreach ($receieved_arr as $row) {
                echo "<tr>
                <td>" . $row['Details'] . "</td>
                <td><form action=" . BASE_DIR . "Message/markAsRead/" . $row['Message_id'] . " method='POST'>
                        <button class='btn btn-primary' name='mark_as_read'>Mark as Read</button>
                    </form>
                </td>
                <td><form action=" . BASE_DIR . "Message/delete/" . $row['Message_id'] . " method='POST'>
                        <button  class='btn btn-danger' name='delete'>Delete</button>
                    </form>
                </td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        } else {
            echo "<p>You haven't receieve any messages yet.</p>";
        }
        ?>

    </div>


    <?php
    require 'public/html/footer.html';
    ?>


</body>

</html>