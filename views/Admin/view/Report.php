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
        </tr>
        <?php endforeach?>
</tbody>
</table>

</body>

</html>

