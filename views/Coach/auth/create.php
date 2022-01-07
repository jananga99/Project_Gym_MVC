<?php
$msg = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
unset($_SESSION['msg']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require_once 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/css/login.css" ?>>

    <title>Sign Up</title>
</head>

<body>

    <?php
    $menu_arr = array(

        "Home" => BASE_DIR . ""
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>



    <div class="simple-login-container">
        <h2>SIGNUP COACH</h2>
        <div>
            <form action=<?php echo BASE_DIR . "Coach/create" ?> method="POST">

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='fname' placeholder="First Name">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='lname' placeholder="Last Name">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='age' placeholder="Age(years)">
                    </div>
                </div>



                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='city' placeholder="City">
                    </div>
                </div>


                <div class="row">
                    <div class="mb-3  form-group">

                        <select class="form-select" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>

                    </div>
                </div>


                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='tel' placeholder="Tel No">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="text" class="form-control" name='email' placeholder="Email">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="password" class="form-control" name='password' placeholder="Password">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 form-group">
                        <input type="password" class="form-control" name='cpassword' placeholder="Confirm Password">
                    </div>
                </div>

                <div class="row">
                    <div class="d-grid gap-2">
                        <input type="submit" class="btn btn-block btn-login" name='submit' placeholder="Enter your Password">
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="d-flex justify-content-center" style="color:crimson">
        <p><?= $msg ?></p>
    </div>


    <?php
    require_once 'public/html/footer.html';
    ?>

</body>

</html>