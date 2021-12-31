<?php
$session_arr = isset($_SESSION['data']) ? $_SESSION['data'] : 0;
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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/sessions.css" ?>>
    <title>Search Session</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class='container'>
        <h2>All Sessions</h2>

        <?php
        if ($session_arr) {
            echo "<div>
            <table class='table table-bordered table-hover' style='color:white'>
                <thead>
                    <tr>
                        <th>Session Id</th>
                        <th>Session Name</th>
                        <th>Coach</th>
                        <th>pariticipants</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Price($)</th>
                        <th>select</th>
                        
                    </tr>
                </thead>
                <tbody>";
            foreach ($session_arr as $row) {
                echo "<tr>
                    <td>" . $row['Session_id'] . "</td>
                    <td>" . $row['Session_Name'] . "</td>
                    <td>" . $row['Coach_Email'] . "</td>
                    <td>" . $row['Num_Participants'] . "</td>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['Start_Time'] . "</td>
                    <td>" . $row['End_Time'] . "</td>
                    <td>" . $row['Price'] . "</td>
                   
                    
                    <td><form action=" . BASE_DIR . "Session/view/" . $row['Session_id'] . " method='POST'>
                        <button class='btn btn-outline-light btn-sm' name='select'>Select</button>
                        </form></td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        } else {
            echo "<p>No available sessions yet</p>";
        }


        ?>


    </div>

    <?php
    require 'public/html/footer.html';
    ?>

</body>

</html>