<?php
$plan_arr = $_SESSION['plan_arr']; 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <?php
        
        foreach($plan_arr as $plan){
            echo "
            <tr>
                <td>".$plan['Plan_Name']."</td>
                <td>
                    <form action='".BASE_DIR."WorkoutPlan/view/".$plan['Plan_id']."' method='post'>
                        <button>View</button>
                    </form>
                </td>
             </tr>            
            ";
        }
        
        ?>

    </table>
</body>
</html>