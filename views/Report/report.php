<!DOCTYPE html>
<html>
    <head>
        <title>Reporting Coach</title>
    </head>

<body>
<div class="report-submission">
    <form action="<?=BASE_DIR . "Report/submit_report"?>" method="POST"> 
        If you want to report this person please provide us reason and submit.
        <input type="text"  size ="30" name="reason"><br>
        <input type="hidden" name="email" value="<?php echo $_SESSION['report_email'] ?>">
        <input type="submit" value="Submit Report">
    <form>

</div>

</body>
</html>