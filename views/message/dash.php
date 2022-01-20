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
    require_once("public/HTML/boostraplinks.html");
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



        <div class="m-4">
            <h3>Receieved Messages</h3>
            <form action=<?= BASE_DIR . "Message" ?> method='post'>
                <!-- <label>Show</label> -->

                <div class="d-flex justify-content-center flex-row bd-highlight mb-3">

                    <div class="d-flex flex-column m-1 bd-highlight ">
                        <select class="form-select m-1" name='sent_select'>
                            <option value='unread' checked>Only unread messages</option>
                            <option value='all'>All messages</option>
                            <option value='read'>Only read messages</option>
                        </select>
                    </div>
                    <div class="d-flex flex-column m-1 bd-highlight ">
                        <button class='btn btn-outline-light m-1 '>Show </button>
                    </div>
                </div>
            </form>
            <?php
            if ($receieved_flag) {
                echo " <div>
                <table class='table table-hover' style='color:white'>
            <tr>
                <th>Message</th>
                <th>Sender</th>
                <th></th>
                <th></th>
            </tr>
            <tbody>";
                foreach ($receieved_arr as $row) {
                    echo "<tr>
                <td>" . $row['Message'] . "     </td>
                <td>";

                    if (substr($row['Type'], 0, 1) === '3')
                        echo "Coach   ";
                    elseif (substr($row['Type'], 0, 1) === '4')
                        echo "Admin   ";
                    echo $row["Sender_Email"] . "</td>";
                    if ($row['Mark_as_read'] == 0)
                        echo "<td><form action=" . BASE_DIR . "Message/markAsRead/" . $row['Message_id'] . " method='POST'>
                        <button class='btn btn-primary' name='mark_as_read'>Mark as Read</button>
                    </form>
                </td>";
                    else
                        echo "<td></td>";

                    echo "<td><form action=" . BASE_DIR . "Message/delete/" . $row['Message_id'] . " method='POST'>
                        <button  class='btn btn-danger' name='delete_rec'>Delete</button>
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


        <div class="m-4">

            <h3>Sent Messages</h3>
            <?php
            if ($sent_flag) {
                $type_arr = array(
                    MESSAGE_COACH_TO_ALL_CUSTOMERS => "To All Customers",
                    MESSAGE_COACH_TO_REGISTERED_CUSTOMERS => "To All Registered Customers",
                    MESSAGE_ADMIN_TO_ALL_CUSTOMERS => "To All Customers",
                    MESSAGE_ADMIN_TO_ALL_COACHES => "To All Coaches",
                    MESSAGE_COACH_TO_SESSION_REGISTERED_CUSTOMERS=>"To All Session Registered Customers"
                );
                echo "
                <table class='table table-hover' style='color:white'>
            <tbody>";
                foreach ($sent_arr as $row) {
                    echo "<tr>
                <td>" . $row['Message'] . "</td>
                <td>" . $type_arr[$row['Type']] . "</td>  
                <td><form action=" . BASE_DIR . "Message/delete/" . $row['Message_Sent_id'] . " method='POST'>
                    <button  class='btn btn-danger' name='delete_sent_for_me'>Delete For Me</button>
                    <button  class='btn btn-danger' name='delete_sent_for_everyone'>Delete For Everyone</button>
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
        </div>


    </div>


    <?php
    require_once 'public/html/footer.html';
    ?>


</body>

</html>