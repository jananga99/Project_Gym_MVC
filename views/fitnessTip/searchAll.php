<?php
if(isset($_POST['submit'])){
    $_SESSION['data']['sort_arr'] = array();
    $_SESSION['data']['sort_arr']['for_which_gender']=$_POST["gender"];
    header("Location:".BASE_DIR."FitnessTip/search");
    die();
}
$tip_arr =  isset($_SESSION['data']) ? $_SESSION['data'] : array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Fitness Tips</title>
</head>
<body>

    <a href=<?=BASE_DIR."Customer"?>>Dashboard</a>

    <h2>Get Tipness fits</h2>

    <div>

        <form action="" method="POST">
            <label for="Gender">Gender</label>
            <select name="gender">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select><br>
            <input type="submit" value="Get Tips" name="submit">
        </form>
    </div>

    <?php
        if(sizeof($tip_arr)){
            echo "<div>
            <table border='2'>
                <thead>
                    <tr>
                        <th>Tip</th>
                    </tr>
                </thead>
                <tbody>";
            foreach($tip_arr as $row){
                echo "<tr>
                    <td>".$row['Tip']."</td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        } 

    
    ?>

    

</body>

</html>