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

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <span><img src="./images/stats_white.svg" alt="Stats"></span> Stats 
                            </a>
                            <ul class="dropdown-menu dropdown-menu-light dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item" href="./daily.php">Daily Details</a></li>
                                <li><a class="dropdown-item" href="./monthly.php">Monthly Details</a></li>
                                <li><a class="dropdown-item" href="#">Yearly Details</a></li>
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
                    <div class="col-12 col-sm-12">
                        <h1>Yearly Details</h1>
                        <p>You can view year-wise purchase/usage/wastage details and barchart representing yearly details</p>
                    </div>
                </div>
            </div>
        </header>
        
        <!-- Tabs -->
        <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Stats</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button"
                    role="tab" aria-controls="profile" aria-selected="false">Barchart</button>
            </li>
        </ul>
        <br>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <!-- Yearly stats table -->
                <table border=1 id="main">
                    <?php
                    require "./vendor/autoload.php";
                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                    $spreadsheet = $reader->load("./database/items.xlsx");
                    $sheet = $spreadsheet->getSheetByName('Sheet2');
                    $row=$sheet->getHighestRow();
                    $purchases=array();
                    $sales=array();
                    $wastage=array();
                    $financial_year=array();
                    $label=array('Total Purchase','Total Sales','Total Wastage');
                    for($i=1;$i<=1;$i++){
                      echo "<tr>";
                      echo "<th>". $sheet->getCell(chr(65).$i)->getValue() ."</th>";
                      echo "<th>Total Purchase (Rs)</th>";
                      echo "<th>Total Sales (Rs)</th>";
                      echo "<th>Total Wastage (Rs)</th>";
                      echo "</tr>";
                    }
                    $year=date('Y');
                    $i=$row-2;
                    for(;$i>=2;$i=$i-3){
                      $y=$sheet->getCell(chr(65).$i)->getValue();
                      $y_array=explode('-',$y);
                      if(!(strcmp($y_array[0],$year))){
                        break;
                      }
                    }
                    for(;$i>=2;$i-=6){
                      echo "<tr>";
                      echo "<td>". $sheet->getCell(chr(65).$i)->getValue() ."</td>";
                      array_push($financial_year,$sheet->getCell(chr(65).$i)->getValue());
                      for($k=0;$k<3;$k++,$i++){
                      $value=0;
                      for($j=67;$j<=78;$j++){
                        $value+=(int)$sheet->getCell(chr($j).$i)->getValue();
                      }
                      echo "<td>$value</td>";
                      if($k==0){
                          array_push($purchases,$value);
                      }
                      else if($k==1){
                          array_push($sales,$value);
                      }
                      else{
                          array_push($wastage,$value);
                      }
                      }
                      echo "</tr>";
                    }
                    ?>
                </table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Barchart -->
                <div class="chart-container1">
                    <canvas id="myChart"></canvas>
                </div>

                <script type="text/javascript" src="./node_modules/chart.js/dist/chart.min.js"></script>
                <script>
                    const labels = <?php echo json_encode(array_reverse(array_slice($financial_year,0,10))); ?>;
                    const data = {
                    labels: labels,
                    datasets: [{
                        label: <?php echo json_encode($label[0]); ?>,
                        data: <?php echo json_encode(array_reverse(array_slice($purchases,0,10))); ?>,
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)'
                        ],
                        borderColor: [
                        'rgb(255, 99, 132)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: <?php echo json_encode($label[1]); ?>,
                        data: <?php echo json_encode(array_reverse(array_slice($sales,0,10))); ?>,
                        backgroundColor: [
                        'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                        'rgb(75, 192, 192)'
                        ],
                        borderWidth: 1
                    },
                    {
                        label: <?php echo json_encode($label[2]); ?>,
                        data: <?php echo json_encode(array_reverse(array_slice($wastage,0,10))); ?>,
                        backgroundColor: [
                        'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                        'rgb(54, 162, 235)'
                        ],
                        borderWidth: 1
                    }]
                    };

                    const config = {
                    type: 'bar',
                    data: data,
                    options: {
                        scales: {
                        y: {
                            beginAtZero: true
                        }
                        },
                        responsive: true,
                        plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: "Barchart representing year-wise purcahse/usage/wastage details"
                        }
                        },
                    },
                    };

                    var myBarChart = new Chart(
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