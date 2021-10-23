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
                                <li><a class="dropdown-item" href="#">Monthly Details</a></li>
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
                    <div class="col-12 col-sm-12">
                        <h1>Monthly Details</h1>
                        <p>You can view month-wise purchase/usage/wastage details and barchart representing monthly details</p>
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
                <!-- Menu -->
                <nav class="navbar navbar-dark navbar-expand-lg d-flex justify-content-between" id="menu">
                    <div class="container">
                        <ul class="row align-items-center navbar-nav" style="padding-left: 2%">
                        <li class="col-12 col-sm-3 nav-item p-1">
                            <label class="l">Select Year:</label>
                        </li>

                        <form class="col-12 col-sm-9 d-flex" method="POST" action="">
                            <input class="col-sm-6 form-control me-2" type="number" min='2018' max='2060' step='1' value=<?php echo json_encode(date('Y')); ?> aria-label="Year" name="year">
                            <button class="col-sm-3 btn flex-grow-1" type="submit" name="submit">Check Year</button>
                            <?php
                            $purchases=array();
                            $sales=array();
                            $wastage=array();
                            $label=array();
                            if(isset($_POST["submit"])){
                                if(empty($_POST['year'])){
                                    echo "<p class='error'>*Year must be selected!</p>";
                                }
                                else{
                                    $year=$_POST['year'];
                                    /* Data Selection */
                                    require "./vendor/autoload.php";
                                    $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                                    $spreadsheet = $reader->load("./Database/items.xlsx");
                                    $sheet = $spreadsheet->getSheetByName('Sheet2');
                                    $row=$sheet->getHighestRow();
                                    $i=$row-2;
                                    for(;$i>=2;$i=$i-3){
                                        $y=$sheet->getCell(chr(65).$i)->getValue();
                                        $y_array=explode('-',$y);
                                        if(!(strcmp($y_array[0],$year))){
                                            break;
                                        }
                                    }
                                    for($j=67;$j<=78;$j++){
                                        $temp=0;
                                        array_push($purchases,$temp+(int)$sheet->getCell(chr($j).$i)->getValue());
                                    }
                                    $i++;
                                    for($j=67;$j<=78;$j++){
                                        $temp=0;
                                        array_push($sales,$temp+(int)$sheet->getCell(chr($j).$i)->getValue());
                                    }
                                    $i++;
                                    for($j=67;$j<=78;$j++){
                                        $temp=0;
                                        array_push($wastage,$temp+(int)$sheet->getCell(chr($j).$i)->getValue());
                                    }
                                    $label=array('Total Purchases','Total Sales','Total Wastage');
                                    $year=(string)$year.'-'.(string)($year+1);
                                    $_SESSION['year']=$year;
                                    
                                }
                            }
                            ?>
                        </form>
                        </ul>
                    
                        <ul class="navbar-nav" style="padding-right: 2%">
                        <li class="nav-item p-1">
                            <label class="l">
                            <?php
                            $year=$_SESSION['year'];
                            echo "Financial Year Selected: $year";
                            ?>
                            </label>
                        </li>
                        </ul>
                    </div>
                </nav>
                <!-- Monthly stats table  -->
                <table border=1 id="main"><?php
                require "./vendor/autoload.php";
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
                $spreadsheet = $reader->load("./Database/items.xlsx");
                $sheet = $spreadsheet->getSheetByName('Sheet2');
                $row=$sheet->getHighestRow();

                if(isset($_POST["submit"])){
                    if(!(empty($_POST['year']))){
                        for($i=1;$i<=1;$i++){
                            echo "<tr>";
                            echo "<th colspan=2>". $sheet->getCell(chr(65).$i)->getValue() ."</th>";
                            for($j=67;$j<=78;$j++){
                                echo "<th>". $sheet->getCell(chr($j).$i)->getValue() ."</th>";
                            }
                            echo "</tr>";
                        }
                        $year=$_POST['year'];
                        $i=$row-2;
                        for(;$i>=2;$i=$i-3){
                            $y=$sheet->getCell(chr(65).$i)->getValue();
                            $y_array=explode('-',$y);
                            if(!(strcmp($y_array[0],$year))){
                                break;
                            }
                        }
                        echo "<tr>";
                        echo "<td rowspan=3>". $sheet->getCell(chr(65).$i)->getValue() ."</td>";
                        for($j=66;$j<=78;$j++){
                            echo "<td>". $sheet->getCell(chr($j).$i)->getValue() ."</td>";
                        }
                        echo "</tr>";
                        $i++;
                        for($k=0;$k<2;$k++,$i++){
                            echo "<tr>";
                            for($j=66;$j<=78;$j++){
                            echo "<td>". $sheet->getCell(chr($j).$i)->getValue() ."</td>";
                            }
                            echo "</tr>";
                        }
                    }
                }
                
                ?></table>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <!-- Barchart -->
                <div class="chart-container1">
                    <canvas id="myChart"></canvas>
                </div>

                <script type="text/javascript" src="./node_modules/chart.js/dist/chart.min.js"></script>
                <script>
                    const labels = ['April','May','June','July','August','September','October','November','December','January','February','March'];
                    const data = {
                    labels: labels,
                    datasets: [{
                        label: <?php echo json_encode($label[0]); ?>,
                        data: <?php echo json_encode($purchases); ?>,
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
                        data: <?php echo json_encode($sales); ?>,
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
                        data: <?php echo json_encode($wastage); ?>,
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
                            text: "Barchart representing selected financial year's month-wise purcahse/usage/wastage details"
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