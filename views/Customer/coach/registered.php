<?php


$arr = $_SESSION['data'];
if(sizeof($arr)==0) $flag=0;
else    $flag=1;
$coach_arr = $_SESSION['data'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Coaches</title>
</head>
<body>

    <a href=<?=BASE_DIR."Customer"?>>Dashboard</a>

    <h2>Registered Coaches</h2>

    <?php 
    if($flag){
        echo "<div>
        <table border='2'>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>";
        foreach($coach_arr as $row){
            echo "<tr>
                <td>".$row['FirstName']." ".$row['LastName']."</td>
                <td>".$row['Gender']."</td>
                <td><form action='' method='POST'>
                    <input type='text' name='select_email' value=".$row['Email']." readonly style='display:none'>
                    <button name='view_coach'>View</button>
                    </form></td>
            </tr>";
        }
        echo "</tbody>
        </table>
    </div>";
    }
    ?>

    

</body>
<script src="public/js/search.js"></script>
</html>