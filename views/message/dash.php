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
    <title>Messages</title>
</head>
<body>
    
    <a href=<?=BASE_DIR?>>Dashbaord</a>

    <h1>Messages</h1>

    <h2>Sent Messages</h2>
    <?php
        if ($sent_flag) {
            echo "<table><tbody>";
            foreach ($sent_arr as $row) {
                echo "<tr>
                <td>" . $row['Details'] . "</td>
                <td><form action=" . BASE_DIR . "Message/delete/".$row['Message_id']." method='POST'>
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


    <h2>Receieved Messages</h2>
    <?php
        if ($receieved_flag) {
            echo "<table><tbody>";
            foreach ($receieved_arr as $row) {
                echo "<tr>
                <td>" . $row['Details'] . "</td>
                <td><form action=" . BASE_DIR . "Message/markAsRead/".$row['Message_id']." method='POST'>
                        <button class='btn btn-primary' name='mark_as_read'>Mark as Read</button>
                    </form>
                </td>
                <td><form action=" . BASE_DIR . "Message/delete/".$row['Message_id']." method='POST'>
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

</body>
</html>