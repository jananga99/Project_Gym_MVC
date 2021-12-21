<?php
$notification_arr = $_SESSION['data'];
if(sizeof($notification_arr)==0) $flag=0;
else    $flag=1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
</head>
<body>

    <h1>Notifications</h1>
    
    <?php 
        if($flag){
            echo "<div>
            <table border='2'>
                <thead>
                    <tr>
                    <th>Notification</th>
                    </tr>
                </thead>
                <tbody>";
            foreach($notification_arr as $row){
                echo "<tr>
                <td>".$row['Details']."</td>
                <td><form action=".BASE_DIR."Notification/read method='POST'>
                    <input type='text' name='notification_id' value=".$row['Notification_id']." readonly style='display:none'>
                    <button name='mark_as_read'>Mark as Read</button>
                    </form>
                </td>
                <td><form action=".BASE_DIR."Notification/delete method='POST'>
                    <input type='text' name='notification_id' value=".$row['Notification_id']." readonly style='display:none'>
                    <button name='delete'>Delete</button>
                    </form>
                </td>
                </tr>"
                
                
                ;
            }
            echo "</tbody>
            </table>
        </div>";
        }else{
            echo "<p>You have no notifications yet.</p>";
        }
        ?>

</body>
</html>