<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href="public/css/login.css">
    <title>Dashboard</title>
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
           
                <a href="Auth/logout" class="nav-item nav-link">Log Out</a>
            </div>
        </div>
    </div>
</nav>

<h1>Welcome</h1>

<a href="../customer/coach/search.php">add coach</a>
<a href="../customer/my_profile/update.php">edit profile</a>
<a href="../customer/coach/my_coaches.php">Registered Coaches</a>
<a href="../customer/session/search.php">Add Sessions</a>
<a href="../customer/session/my_sessions.php">My Sessions</a>
<a href="../customer/fitness_tips/search.php">Get Finess Tips</a>


</body>

</html>