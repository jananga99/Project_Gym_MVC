<!DOCTYPE html>

<?php
$reports = $_SESSION['reports'];
?>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/report.css" ?>>

    <title>Reports</title>
</head>

<body>
  
    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],

        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>

<table>
<thead>
    <tr>
        <th>Reason</th>
        <th>Email</th>
    </tr>
</thead>
<tbody>
    <?php foreach($reports as $report): ?>

        <?php if($report['Deleted'] == 1){
            continue;
        }
            ?>

        <tr>
            <td><?php echo $report['Reason'] ?> </td>
            <td><?php echo $report['Email'] ?> </td>

            
                <td>
                <a href=<?= BASE_DIR . "Admin/ignore_report/".$report['Email']?>>
                <button>Ignore</button>
                </a>
                </td>
            

            <td>
            <a href=<?= BASE_DIR . "Admin/ban_coach/".$report['Email']?>>
            <button>Ban</button> </a></td>
        </tr>
        
        <?php endforeach?>
</tbody>
</table>

</body>

</html>