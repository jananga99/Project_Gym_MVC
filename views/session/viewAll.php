<?php
$session_arr = isset($_SESSION['data']) ? $_SESSION['data'] : 0;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
    require("public/HTML/boostraplinks.html");
    ?>
    <link rel="stylesheet" href=<?= BASE_DIR . "public/CSS/sessions.css" ?>>
    <title>Search Session</title>
</head>

<body>

    <?php
    $menu_arr = array(
        "Dashboard" => BASE_DIR . $_SESSION['logged_user']['type'],
        "Notifications" => BASE_DIR . "Notification",
        "Messages" => BASE_DIR . "Message",
        "Log Out" => BASE_DIR . "Auth/logout"
    );
    $navbar =  new Navbar($menu_arr);
    echo $navbar->get();
    ?>


    <div class='container'>
        <h2>All Sessions</h2>




        <div class="d-flex flex-column bd-highlight mb-3">
            <form action=<?=BASE_DIR . "Session/viewAll"?> method="POST">
                <button class="btn btn-outline-light btn-md" name="view_all">View All</button>
            </form>

            <form action=<?=BASE_DIR . "Session/viewAll"?> method="post">
                <div class="d-flex justify-content-center flex-row bd-highlight mb-3">
                    
                    <!-- Order by options div !-->
                    <div class="d-flex flex-column m-3 bd-highlight mb-3">
                        <label for="order_by_date">Order by Date</label>       
                        <select name="order_by_date">
                            <option value="ascending">Ascending</option>
                            <option value="decending">Decending</option>
                        </select>
                    </div>
                    <!-- end of order by options -->

                    <div class="d-flex flex-column  m-3 bd-highlight mb-3">
                        <!-- Sort by options -->
                        <div>
                            
                            <!-- Only from registered coaches check box -->
                            <?php
                                if($_SESSION['logged_user']['type']==="Customer"){
                                    echo "
                                    <input type='checkbox' name='only_registered_coaches' >
                                    <label>Only From Registered Coaches</label><br>                                    
                                    ";
                                }
                            ?>
                            <!-- --> 
                            


                            <!-- By Registered/Unregistered selct list -->
                            <?php
                                if($_SESSION['logged_user']['type']==="Customer"){
                                    echo "
                                        <label >By Registered/Unregistered</label>
                                        <select name='by_registered' >
                                            <option value='all'>All Sessions</option>
                                            <option value='registered'>Registered Sessions</option>
                                            <option value='unregistered'>Unregistered Sessions</option>
                                        </select><br> 
                                    ";
                                }
                            ?>
                            <!-- -->                                               
   
                            <!-- By Time selct list -->
                            <label >By Time</label>
                            <select name="by_time" >
                                <option value="upcoming" checked>Upcoming Sessions</option>
                                <option value="previous">Previous Sessions</option>
                                <option value="all">All Sessions</option>
                            </select>    
                            <!-- -->                                                                          

                        </div>
                        <!-- end of sort by options -->
                    </div>
                </div>

                <button type="submit" class="btn btn-primary" name="by" id="by">Search</button>

            </form>
        </div>


















        <?php
        if ($session_arr) {
            echo "<div>
            <table class='table table-bordered table-hover' style='color:white'>
                <thead>
                    <tr>
                        <th>Session Id</th>
                        <th>Session Name</th>
                        <th>Coach</th>
                        <th>pariticipants</th>
                        <th>Date</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Price($)</th>
                        <th>select</th>
                        
                    </tr>
                </thead>
                <tbody>";
            foreach ($session_arr as $row) {
                echo "<tr>
                    <td>" . $row['Session_id'] . "</td>
                    <td>" . $row['Session_Name'] . "</td>
                    <td>" . $row['Coach_Email'] . "</td>
                    <td>" . $row['Num_Participants'] . "</td>
                    <td>" . $row['Date'] . "</td>
                    <td>" . $row['Start_Time'] . "</td>
                    <td>" . $row['End_Time'] . "</td>
                    <td>" . $row['Price'] . "</td>
                   
                    
                    <td><form action=" . BASE_DIR . "Session/view/" . $row['Session_id'] . " method='POST'>
                        <button class='btn btn-outline-light btn-sm' name='select'>Select</button>
                        </form></td>
                </tr>";
            }
            echo "</tbody>
            </table>
        </div>";
        } else {
            echo "<p>No available sessions yet</p>";
        }


        ?>


    </div>

    <?php
    require 'public/html/footer.html';
    ?>

</body>

</html>