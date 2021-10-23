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

                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
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
                                <li><a class="dropdown-item" href="#">Add Item</a></li>
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
                        <h1>Add Item</h1>
                        <p>You can add new items</p>
                    </div>
                </div>
            </div>
        </header>
        <br>
        
        <!-- Menu -->
        <nav class="navbar navbar-dark navbar-expand-lg d-flex justify-content-between" id="menu">
      
            <div class="container">
            
            <ul class="row align-items-center navbar-nav" style="padding-left: 2%">
                <li class="col-12 col-sm-3 nav-item p-1">
                <label class="l">Item Name:</label>
                </li>

                <form class="col-12 col-sm-9 d-flex" method="POST" action="">
                <input class="col-sm-6 form-control me-2" type="search" placeholder="Item" aria-label="Search" name="item">
                <button class="col-sm-3 btn flex-grow-1" type="submit" name="submit">Add Item</button>
                <?php
                if(isset($_POST["submit"])){
                    if(!empty($_POST['item'])){
                    require "./vendor/autoload.php";
                    $spreadsheet=\PhpOffice\PhpSpreadsheet\IOFactory::load('./Database/items.xlsx');
                    $writer=new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
                    $sheet=$spreadsheet->getSheetByName('Sheet1');
                    $flag=true;
                    $item=$_POST['item'];
                    $row=$sheet->getHighestRow();
                    for($i=2;$i<=$row;$i++){
                        if($sheet->getCell('B'.$i)->getValue()==$item){
                        $flag=false;
                        break;
                        }
                    }
                    if($flag==false){
                        echo "<p class='error'>*Item already present!</p>";
                    }
                    else{
                        $row=$row+1;
                        $sheet->insertNewRowBefore($row);
                        $sheet->setCellValue('A'.$row,$row-1);
                        $sheet->setCellValue('B'.$row,$item);
                        $sheet->setCellValue('C'.$row,'0');
                        $sheet->setCellValue('D'.$row,'0');
                        $sheet->setCellValue('E'.$row,'0');
                        $sheet->setCellValue('F'.$row,'0');
                        $sheet->setCellValue('G'.$row,'0');
                        $sheet->setCellValue('H'.$row,'0');
                        $sheet->setCellValue('I'.$row,'0');
                        $sheet->setCellValue('J'.$row,'0');
                        $writer->save('./Database/items.xlsx');
                    }
                    }
                    else{
                    echo "<p class='error'>*Item name is mandatory!</p>";
                    }
                }
                ?>
                </form>
            </ul>

            <ul class="navbar-nav" style="padding-right: 2%">
                <li class="nav-item p-1">
                <label class="l">
                    <?php
                    if(isset($_POST["submit"])){
                    if(!empty($_POST['item'])){
                        $date=$_POST['item'];
                        echo "Added Item: $item";
                    }
                    }
                    ?>
                </label>
                </li>
            </ul>

            </nav>

            <!-- Items Table -->
            <table border=1 id="main"><?php
            require "./vendor/autoload.php";
            $reader=new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $spreadsheet=$reader->load("./Database/items.xlsx");
            $sheet=$spreadsheet->getSheetByName('Sheet1');
            $row=$sheet->getHighestRow();
            for($i=1;$i<=1;$i++){
            echo "<tr>";
            for($j=65;$j<=69;$j++){
                echo "<th>". $sheet->getCell(chr($j).$i)->getValue() ."</th>";
            }
            echo "</tr>";
            }
            for($i=2;$i<=$row;$i++){
            echo "<tr>";
            for($j=65;$j<=69;$j++){
                echo "<td>". $sheet->getCell(chr($j).$i)->getValue() ."</td>";
            }
            echo "</tr>";
            }
        ?></table>
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