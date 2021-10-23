<?php
ob_start();
session_start();
if (!(empty($_SESSION['sess_user']))) {
    header('Location: ./home.php');
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
                <a class="navbar-brand bd-highlight active" href="#">Hostel Maintenance System</a>
                <!--<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01"
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

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/person_white.svg" alt="User" style="height: 22px;"></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./pc.php"><span><img src="./images/change.svg" alt="Brand"></span> Password Change</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./logout.php"><span><img src="./images/logout.svg" alt="Brand"></span> Logout</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>-->
            </div>
        </nav>
        
        <!-- Jumbotron -->
        <header class="jumbotron">
            <div class="container">
                <div class="row row-header">
                    <div class="col-12 col-sm-12">
                        <h1>Welcome to Hostel Maintenance System</h1>
                        <p>Please login to view stats and reports</p>
                    </div>
                </div>
            </div>
        </header>
        <br>
        <br>
        
        <div class="container-fluid">
            <div class="row align-items-center justify-content-md-center p-3">
                <!--College logo-->
                <div class="col-md-3">
                <img class="logo" src="./images/RVRJC.jpg" alt="Logo"></img>
                </div>

                <!--Login form-->
                <form class="col-md-4" action="" method="POST" autocomplete="on">

                <?php
                if(isset($_POST["submit"])){
                if(!empty($_POST['user']) && !empty($_POST['pass'])){
                    $user=$_POST['user'];
                    $pass=$_POST['pass'];
                    $con=mysqli_connect('localhost','root','Dattu@219','users') or die(mysqli_connect_error());
                    mysqli_select_db($con,'users') or die("cannot select DB");
                    $query=mysqli_query($con,"SELECT * FROM login WHERE username='".$user."' AND password='".$pass."'");
                    $numrows=mysqli_num_rows($query);
                    if($numrows!=0){
                        while($row=mysqli_fetch_assoc($query)){
                            $dbusername=$row['username'];
                            $dbpassword=$row['password'];
                        }
                        if($user == $dbusername && $pass == $dbpassword){
                            $_SESSION['sess_user']=$user;
                            /* Redirect browser */
                            header("Location: ./home.php");
                        }
                    }
                    else{
                        echo "<p class='error'>*Invalid username or password!</p>";
                    }
                }
                else{
                    echo "<p class='error'>*All fields are mandatory!</p>";
                }
                }  
                ?>
                
                <div class="row m-4 p-1 align-items-center">
                    <img class="person col-md-2" src="./images/person.svg" alt="User"></img>
                    <input class="col-md-10" type="text" name="user" placeholder="Username">
                </div>
                <div class="row m-4 p-1 align-items-center">
                    <img class="lock col-md-2" src="./images/http.svg" alt="Lock"></img>
                    <input class="col-md-10" type="password" name="pass" placeholder="Password">
                </div>
                <div class="row m-4 p-1 justify-content-md-center">
                    <button type="submit" value="Login" name="submit" class="btn btn-outline-dark col-md-auto">
                    <img src="./images/login.svg" alt="Login"></img>&nbsp;Login
                    </button>
                </div>
                </form>
            </div>
        </div>
        <br>
        <br>

        <!-- footer -->
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