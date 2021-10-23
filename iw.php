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

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/inventory_white.svg" alt="Reports"></span> Reports 
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./ip.php">Item Purchase</a></li>
                                <li><a class="dropdown-item" href="./ii.php">Item Issue</a></li>
                                <li><a class="dropdown-item" href="#">Item Wastage</a></li>
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
                    <div class="col-12 col-sm-12">
                        <h1>Item Wastage Report</h1>
                        <p>You can view item wastage report and piechart representing item wastage report</p>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Report</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Piechart</button>
            </li>
        </ul>
        <br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 

                <!-- Item Wastage Report Table -->
                <table border=1 id="main"><?php
                require "./vendor/autoload.php";
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("./Database/items.xlsx");
                $sheet=$spreadsheet->getSheetByName('Sheet1');
                $row=$sheet->getHighestRow();
                echo "<tr><th>Item Name</th><th>Wasted Quantity</th><th>Wastage Cost</th></tr>";
                $labels=array();
                $data=array();
                for($i=2;$i<=$row;$i++){
                    echo "<tr>";
                    array_push($labels,$sheet->getCell('B'.$i)->getValue());
                    array_push($data,$sheet->getCell('G'.$i)->getValue());
                    echo "<td>".$sheet->getCell('B'.$i)->getValue()."</td>";
                    echo "<td>".$sheet->getCell('J'.$i)->getValue()."</td>";
                    echo "<td>".$sheet->getCell('G'.$i)->getValue()."</td>";
                    echo "<tr>";
                }
                ?></table>

            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Piechart -->
                <div class="chart-container">
                    <canvas id="myChart"></canvas>
                </div>
                <script type="text/javascript" src="./node_modules/chart.js/dist/chart.min.js"></script>
                <script>
                const data = {
                    labels: <?php echo json_encode($labels); ?>,
                    datasets: [{
                    label: 'Item Cost Report',
                    data: <?php echo json_encode($data); ?>,
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                    hoverOffset: 4,
                    radius: 200,
                    position: 'top'
                    }],
                    options: {
                    responsive: false,
                    }
                };

                const config = {
                    type: 'pie',
                    data: data,
                    options: {
                        plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: "Piechart representing item wastage"
                        }
                        },
                    },
                };

                var myChart = new Chart(
                    document.getElementById('myChart'),
                    config
                );
                </script>
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