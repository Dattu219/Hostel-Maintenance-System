<!--Redirecting session-->
<?php
session_start(); 
if (empty($_SESSION['sess_user'])) {
    header('Location: ./index.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Required CSS files -->
        <link rel="stylesheet" type="text/css" href="./node_modules/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/style.css">

        <title>Hostel Maintenance System</title>
    </head>

    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-dark navbar-expand-sm fixed-top">
            <div class="container-fluid justify-content-between">
                <a class="navbar-brand bd-highlight" href="#">Hostel Maintenance System</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
                    aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link" aria-current="page" href="./home.php"><span><img src="./images/home_white.svg" alt="Home" style="height: 22px;"></span></a></li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/stats_white.svg" alt="Stats"></span> Stats 
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./daily.php">Daily Details</a></li>
                                <li><a class="dropdown-item" href="./monthly.php">Monthly Details</a></li>
                                <li><a class="dropdown-item" href="./yearly.php">Yearly Details</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/edit_white.svg" alt="Stats"></span> Edit 
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./cp.php">Consolidated Purchase</a></li>
                                <li><a class="dropdown-item" href="./cii.php">Consolidated Item Issue</a></li>
                                <li><a class="dropdown-item" href="./ciw.php">Consolidated Item Wastage</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./ai.php">Add Item</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/inventory_white.svg" alt="Reports"></span> Reports 
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./ip.php">Item Purchase</a></li>
                                <li><a class="dropdown-item" href="./ii.php">Item Issue</a></li>
                                <li><a class="dropdown-item" href="./iw.php">Item Wastage</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./i.php">Itemwise</a></li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/person_white.svg" alt="User" style="height: 22px;"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="#"><span><img src="./images/change.svg" alt="Brand"></span> Password Change</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./logout.php"><span><img src="./images/logout.svg" alt="Brand"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        
        <!-- Jumbotron -->
        <header class="jumbotron">
            <div class="container">
                <div class="row row-header">
                    <h1>Password Change</h1>
                </div>
            </div>
        </header>
        
        <div class="container-fluid">
            <div class="row align-items-center justify-content-md-center p-3">
        <!--Password change form-->
                <form method="POST" action="">

                    <?php
                    if(isset($_POST["submit"])){
                        if(!empty($_POST['pass1']) && !empty($_POST['pass2']) && !empty($_POST['pass3'])){
                            $user=$_SESSION['sess_user'];
                            $pass1=$_POST['pass1'];
                            $pass2=$_POST['pass2'];
                            $pass3=$_POST['pass3'];
                            $con=mysqli_connect('localhost','root','Dattu@219','users') or die(mysqli_connect_error());
                            mysqli_select_db($con,'users') or die("cannot select DB");
                            $query=mysqli_query($con,"SELECT * FROM login WHERE username='".$user."' AND password='".$pass1."'");
                            $numrows=mysqli_num_rows($query);
                            if($numrows!=0){
                                while($row=mysqli_fetch_assoc($query)){
                                    $dbusername=$row['username'];
                                    $dbpassword=$row['password'];
                                }
                                if($user == $dbusername && $pass1 == $dbpassword){
                                    if($pass2 == $pass3){
                                        $query=mysqli_query($con,"UPDATE login SET password='$pass2' WHERE username='$user'");

                                        /* Redirect browser */
                                        header("Location: ./index.php");
                                    }
                                    else{
                                        echo "<p class='error'>*Feilds new password and confirm password must be same!</p>";
                                    }
                                }
                            }
                            else{
                                echo "<p class='error'>*Invalid current password!</p>";
                            }
                        }
                        else{
                            echo "<p class='error'>*All fields are mandatory!</p>";
                        }
                    }  
                    ?>

                    <div class="row m-4 p-2 items-align-center justify-content-center">
                        <img class="col-md-1" src="./Images/http.svg" alt="Lock"></img>
                        <input class="col-md-4" type="password" name="pass1" placeholder="Current Password">
                    </div>
                    <div class="row m-4 p-2 items-align-center justify-content-center">
                        <img class="col-md-1" src="./Images/http.svg" alt="Lock"></img>
                        <input class="col-md-4" type="password" name="pass2" placeholder="New Password">
                    </div>
                    <div class="row m-4 p-2 items-align-center justify-content-center">
                        <img class="col-md-1" src="./Images/http.svg" alt="Lock"></img>
                        <input class="col-md-4" type="password" name="pass3" placeholder="Confirm Password">
                    </div>
                    <div class="row p-2 justify-content-center">
                        <button type="submit" name="submit" class="btn col-md-1 btn-outline-dark m-4 p-1"><img class="col-md-3" src="./Images/change.svg" alt="Lock"></img>&nbsp;Change</button>
                    </div>

                </form>
            </div>
        </div>
        <br>
        <br>

        <!--footer-->
        <div class="footer">
            <p>
                &copy; All Rights reserved to <a href="http://www.rvrjcce.ac.in/">RVR &amp; JC College of Engineering</a>,
                Chowdavaram, Guntur - 522019.&nbsp;
                <a href="./sc.php">Site Credits</a>
            </p>
        </div>
        
        <!-- Required JS files -->
        <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>