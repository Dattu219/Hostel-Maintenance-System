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
                </div>
            </div>
        </nav>
        
        <!-- Jumbotron -->
        <header class="jumbotron">
            <div class="container">
                <div class="row row-header">
                    <h1>Site Credits</h1>
                </div>
            </div>
        </header>
        
        <!--Details-->
        <div class="container">
        <div class="row p-4">
            <p id='p'>
            <b>Website In-charge:</b><br>
            <a href="http://cse.rvrjcce.ac.in/faculty/bvpr.php" style="color: black !important">Dr. B. Vara Prasad Rao, Department of CSE</a><br>
            <br><b>Website Design:</b><br>
            M. Datta Sai (Y18CS094)<br>
            M. Ramesh (Y18CS097)<br>
            M. Pavan Sai (Y18CS093)<br>
            </p>
        </div>
        </div>
        <br>
        <br>

        <!--footer-->
        <div class="footer">
            <p>
                &copy; All Rights reserved to <a href="http://www.rvrjcce.ac.in/">RVR &amp; JC College of Engineering</a>,
                Chowdavaram, Guntur - 522019.&nbsp;
                <a href="#">Site Credits</a>
            </p>
        </div>
        
        <!-- Required JS files -->
        <script src="./node_modules/@popperjs/core/dist/umd/popper.min.js"></script>
        <script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    </body>
</html>