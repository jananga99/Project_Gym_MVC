<?php
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);
$arr = $_SESSION['data'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require 'public/HTML/boostraplinks.html';
    ?>
    <link rel="stylesheet" href="public/CSS/signup.css">

    <title>Admin update profile</title>
</head>

<body>

    <a href=<?=BASE_DIR.'Admin/'?>>Dashboard</a>

    <div class="simple-login-container">
        <h2>My Details</h2>
        <div>
            <form action=<?=BASE_DIR.'Admin/profile/edit'?> method="POST">
                <div class="row">
                    <div class="mb-3 form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name='fname' value=<?php echo $arr["FirstName"] ?>>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name='lname' value=<?php echo $arr["LastName"] ?>>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <label>Age (years)</label>
                        <input type="text" class="form-control" name='age' value=<?php echo $arr["Age"] ?>>
                    </div>
                </div>


                            
            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" class="form-control" name='city' placeholder="City">
                </div>
            </div> 


                <div class="row">
                    <div class="mb-3 form-group">
                        <label>Gender</label>
                        <input type="text" class="form-control" name='gender' value=<?php echo $arr["Gender"] ?>>
                    </div>
                </div>


                <div class="row">
                    <div class="mb-3 form-group">
                        <label>Tel No</label>
                        <input type="text" class="form-control" name='tel' value=<?php echo $arr["Telephone"] ?>>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <label>Email</label>
                        <input type="text" class="form-control" name='email' value=<?php echo $arr["Email"] ?> readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-block btn-login" value='Save changes' name='saveChanges'>
                    </div>

                </div>

            </form>
        </div>
    </div>




    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>
</body>

</html>