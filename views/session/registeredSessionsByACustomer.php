<?php
$session_arr = $_SESSION['data'];
if(sizeof($session_arr)==0) $flag=0;
else    $flag=1;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Sessions</title>
</head>
<body>

    <a href=<?=BASE_DIR."Customer"?>>Dashboard</a>

    <h2>Registered Sessions</h2>

    <?php 
    if($flag){
        echo "<div>
        <table border='2'>
            <thead>
                <tr>
                <th>Session Id</th>
                <th>Session Name</th>
                <th>Coach</th>
                <th>Number of pariticipants</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Price</th>
                <th>Details</th>
                </tr>
            </thead>
            <tbody>";
        foreach($session_arr as $row){
            echo "<tr>
            <td>".$row['Session_id']."</td>
            <td>".$row['Session_Name']."</td>
            <td>".$row['Coach_Email']."</td>
            <td>".$row['Num_Participants']."</td>
            <td>".$row['Date']."</td>
            <td>".$row['Start_Time']."</td>
            <td>".$row['End_Time']."</td>
            <td>".$row['Price']."</td>
            <td>".$row['Details']."</td>
                <td><form action=".BASE_DIR."Session/view/".$row['Session_id']." method='POST'>
                    <button>View</button>
                    </form></td>
            </tr>";
        }
        echo "</tbody>
        </table>
    </div>";
    }else{
        echo "<p>You have not registered to any sessions yet.</p>";
        echo "<a href=".BASE_DIR . "Session/viewAll".">REGISTER NOW</a>";
    }
    ?>

    

</body>
<script src="public/js/search.js"></script>
</html>