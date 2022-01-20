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


    <div class="container">
        <table class='table table-hover' style='color:white'>
            <thead>
                <tr>
                    <th>Reason</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reports as $report) : ?>

                    <tr>
                        <td><?php echo $report['Reason'] ?> </td>
                        <td><?php echo $report['Email'] ?> </td>


                        <td>
                            <a href=<?= BASE_DIR . "Admin/ignore_report/" . $report['Email'] ?>>
                                <button class="btn btn-primary">Ignore</button>
                            </a>
                        </td>


                        <td><button class="btn btn-danger">Ban</button></td>
                    </tr>

                <?php endforeach ?>
            </tbody>
        </table>

    </div>


    <?php
    require_once 'public/html/footer.html';
    ?>
</body>

</html>