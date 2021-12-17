<?php
 
$sessionId = $_SESSION['data']['select_session'];
$arr = $_SESSION['data'];
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
    <a href=<?=BASE_DIR."Session/view/all"?>>My Sessions</a>
<div class="simple-login-container">
    <h2>Session Details</h2>
    <div>
        <form action=<?=BASE_DIR."Session/edit"?> method="POST">
            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Session Id</label>
                    <input type="text" class="form-control"  name='session_id' value=<?php echo $arr["Session_id"] ?> readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Session Name</label>
                    <input type="text" class="form-control" name='session_name' value=<?php echo $arr["Session_Name"] ?> >
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Date</label>
                    <input type="date" class="form-control" name='date' value=<?php echo $arr["Date"] ?> >
                </div>
            </div> 

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Start Time</label>
                    <input type="time" class="form-control" name='startTime' value=<?php echo $arr["Start_Time"] ?> >
                </div>
            </div> 

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>End Time</label>
                    <input type="time" class="form-control" name='endTime' value=<?php echo $arr["End_Time"] ?> >
                </div>
            </div> 


            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Number of participants</label>
                    <input type="text" class="form-control" name='num_participants' value=<?php echo $arr["Num_Participants"] ?>>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 form-group">
                    <label>Details</label>
                    <input type="text" class="form-control" name='details' value=<?php echo $arr["Details"] ?>>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="submit" class="btn btn-block btn-login" value='Edit Session' name='edit_session_btn' >
                </div>
            </div>             
           

        </form>

        <div class="row" >
            <div class="col-md-12 form-group">
            <form action=<?=BASE_DIR."Session/delete"?> method="POST">
                <input type="text" class="form-control"  name='delete_session' value=<?php echo $arr["Session_id"] ?> readonly style="display:none">
                <input type="submit" class="btn btn-block btn-login" value='Delete Session' name='delete_session_btn' >
            </form>
            </div>
        </div>

       
            
               
            
              
        
    </div>
</div>




    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>
</body>

</html>