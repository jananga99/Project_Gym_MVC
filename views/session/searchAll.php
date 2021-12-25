<?php
$session_arr = $_SESSION['data'];
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

    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#053657;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">VirtualGYM</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href=<?= BASE_DIR . $_SESSION['logged_user']['type'] ?> class="nav-item nav-link ">Dashboard</a>
                    <a href="#" class="nav-item nav-link">Messages</a>


                    <a href=<?= BASE_DIR . "Auth/logout" ?> class="nav-item nav-link">Log Out</a>

                </div>
            </div>
    </nav>

    <!-- <a href=<?= BASE_DIR . $_SESSION['logged_user']['type'] ?>>Dashboard</a> -->

    <div class='container'>
        <h2>Search for a Session</h2>

        <?php
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
               
                
                <td><form action=" . BASE_DIR . "Session/view method='POST'>
                    <input type='text' name='select_session' value=" . $row['Session_id'] . " readonly style='display:none'>
                    <button class='btn btn-outline-light btn-sm' name='select'>Select</button>
                    </form></td>
            </tr>";
        }
        echo "</tbody>
        </table>
    </div>";

        ?>


    </div>
</body>

</html>