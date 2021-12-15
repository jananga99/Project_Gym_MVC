<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require 'public/html/boostraplinks.html';
    ?>
    <link rel="stylesheet" href="public/css/dash.css">
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

 
<nav class="navbar navbar-expand-md navbar-dark" style="background-color:#053657;">
    <div class="container-fluid">
        <a href="#" class="navbar-brand">VirtualGYM</a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto">
                <a href="#" class="nav-item nav-link ">Dashboard</a>
                <a href=<?php echo BASE_DIR."Customer/profile"?> class="nav-item nav-link">Profile</a>
                <a href="#" class="nav-item nav-link">Messages</a>
                <a href="#" class="nav-item nav-link disabled" tabindex="-1">Reports</a>
           
                <a href="Auth/logout" class="nav-item nav-link">Log Out</a>

            </div>
        </div>
    </nav>

    <div class="container">


        <h1 class="mb-4">Welcome</h1>

<a href=<?=BASE_DIR."Customer/coach/search"?>>add coach</a>
<a href=<?=BASE_DIR."Customer/coach/registered"?>>Registered Coaches</a>
<a href=<?=BASE_DIR."Session/search"?>>Add Sessions</a>
<a href=<?=BASE_DIR."Session/registered"?>>My Sessions</a>
<a href=<?=BASE_DIR."FitnessTip/search"?>>Get Finess Tips</a>


        <a class="btn btn-outline-light btn-lg mb-3 1" href="../customer/coach/search.php">add coach</a>
        <a class="btn btn-outline-light btn-lg mb-3" href="../customer/my_profile/update.php">edit profile</a>
        <a class="btn btn-outline-light btn-lg mb-3" href="../customer/coach/my_coaches.php">Registered Coaches</a>
        <a class="btn btn-outline-light btn-lg mb-3" href="../customer/session/search.php">Add Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href="../customer/session/my_sessions.php">My Sessions</a>
        <a class="btn btn-outline-light btn-lg mb-3" href="../customer/fitness_tips/search.php">Get Finess Tips</a>
        <a class="btn btn-outline-light btn-lg mb-3" href=#>Get Workout plan</a>

    </div>


</html>