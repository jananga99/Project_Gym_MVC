<!DOCTYPE html>

<?php
$reports = $_SESSION['reports'];
?>

<html>
    <head>
        <title>Reports</title>
    </head>

<body>

<table>
<thead>
    <tr>
        <th>Reason</th>
        <th>Email</th>
    </tr>
</thead>
<tbody>
    <?php foreach($reports as $report): ?>
        
        <tr>
            <td><?php echo $report['Reason'] ?> </td>
            <td><?php echo $report['Email'] ?> </td>

            
                <td>
                <a href=<?= BASE_DIR . "Admin/ignore_report/".$report['Email']?>>
                <button>Ignore</button>
                </a>
                </td>
            

            <td><button>Ban</button>
        </tr>
        
        <?php endforeach?>
</tbody>
</table>

</body>

</html>

