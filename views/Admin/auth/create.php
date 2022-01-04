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
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/signup.css" ?>>
    <title>Sign Up</title>
</head>

<body>

    <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#053657;">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">VirtualGYM</a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="#" class="nav-item nav-link ">Dashboard</a>
                    <a href="#" class="nav-item nav-link">Profile</a>
                    <a href="#" class="nav-item nav-link">Messages</a>
                    <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a>

                    >
                </div>
            </div>
        </div>
    </nav>

    <div class="simple-login-container">
        <h2>SIGNUP ADMIN</h2>
        <div>
            <form action=<?php echo BASE_DIR . "Admin/create" ?> method="POST">

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
                    <div class="mb-3  form-group">
                        <input type="text" class="form-control" name='age' placeholder="Age(years)">
                    </div>
                </div>



                <div class="row">
                    <div class="mb-3  form-group">
                        <input type="text" class="form-control" name='city' placeholder="City">
                    </div>
                </div>


                <div class="row">
                    <div class="mb-3  form-group">
                        <label for="gender">Gender</label>
                        <select name="gender" >
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="Other">Other</option>
                        </select> 
                        
                    </div>
                </div>


                <div class="row">
                    <div class="mb-3  form-group">
                        <input type="text" class="form-control" name='tel' placeholder="Tel No">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3  form-group">
                        <input type="text" class="form-control" name='email' placeholder="Email">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3  form-group">
                        <input type="password" class="form-control" name='password' placeholder="Password">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3  form-group">
                        <input type="password" class="form-control" name='cpassword' placeholder="Confirm Password">
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3  form-group">
                        <input type="password" class="form-control" name='code' placeholder="Admin Code">
                    </div>
                </div>

                <div class="row">
                    <div class="d-grid gap-2 form-group">
                        <input type="submit" class="btn btn-block btn-login" value='Sign Up' name='submit'>
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