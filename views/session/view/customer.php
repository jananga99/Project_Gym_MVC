<?php
 
$sessionId = $_SESSION['data']['select_session'];
$arr = $_SESSION['data'];
$styleReg = "display:none";
$styleAddSession = "";
if( $_SESSION['data']['isRegistered']){
    $styleAddSession = "display:none";
    $styleReg = "";
}
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- for nav bar -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- for login -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="../../../build/CSS/signup.css">

    <title>Session View</title>
</head>

<body>

    <?php
   // require_once("../../../build/HTML/navbar.php");
    ?>
    <a href=<?=BASE_DIR."Session/search"?>>Back to search</a><br>
    <a href=<?=BASE_DIR."Session/registered"?>>Registered Sessions</a>
<div class="simple-login-container">
    <h2>Session Details</h2>
    <div>

        <div class="row">
            <div class="col-md-12 form-group">
                <label>Session Id</label>
                <input type="text" class="form-control"  name='session_id' value=<?php echo $arr["Session_id"] ?> readonly>
            </div>
        </div>
      
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Session Name</label>
                <input type="text" class="form-control" name='session_name' value=<?php echo $arr["Session_Name"] ?> readonly>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Coach</label>
                <input type="text" class="form-control"  name='coach_email' value=<?php echo $arr["Coach_Email"] ?> readonly>
            </div>
        </div>
         
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Date and Time</label>
                <input type="text" class="form-control" name='date_and_time' value=<?php echo $arr["Date_and_Time"] ?> readonly>
            </div>
        </div> 
        
        <div class="row">
        <div class="col-md-12 form-group">
            <label>Duration</label>
                <input type="text" class="form-control" name='duration' value=<?php echo $arr["Duration"] ?> readonly>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12 form-group">
                <label>Number of participants</label>
                <input type="text" class="form-control" name='num_participants' value=<?php echo $arr["Num_Participants"] ?> readonly>
            </div>
        </div>

        <div class="row" style=<?php echo $styleAddSession; ?>>
            <div class="col-md-12 form-group">
            <form action=<?=BASE_DIR."Session/register"?> method="POST">
                <input type="text" class="form-control"  name='select_session' value=<?php echo $arr["Session_id"] ?> readonly style="display:none">
                <input type="submit" class="btn btn-block btn-login" value='Add Session' name='add_session' >
            </form>
            </div>
        </div>
        <div class="row" style=<?php echo $styleReg; ?>>
                <button class="btn btn-block btn-login" value='Already registered.'  >Already Registered</button>
        </div>
        
    </div>
</div>




    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>
</body>

</html>