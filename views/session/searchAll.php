<?php
$session_arr = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Session</title>
</head>
<body>

<a href=<?=BASE_DIR.$_SESSION['user']['type']?>>Dashboard</a>

    <h2>Search for a Session</h2>

    <?php 
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
                <td>".$row['Details']."</td>
                
                <td><form action=".BASE_DIR."Session/view method='POST'>
                    <input type='text' name='select_session' value=".$row['Session_id']." readonly style='display:none'>
                    <button name='select'>Select</button>
                    </form></td>
            </tr>";
        }
        echo "</tbody>
        </table>
    </div>";
    
    ?>

    

</body>

</html>