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
                                <li><a class="dropdown-item" href="#">Consolidated Purchase</a></li>
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
                        <h1>Consolidated Purchase</h1>
                        <p>You can entry/edit consolidated purchase of items</p>
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
                <label class="l">Select Date:</label>
            </li>

            <form class="col-12 col-sm-9 d-flex" method="POST" action="">
                <input class="col-sm-6 form-control me-2" type="date" aria-label="Date" name="date">
                <button class="col-sm-3 btn flex-grow-1" type="submit" name="submit">Check Date</button>
                <?php
                if(isset($_POST["submit"])){
                if(empty($_POST['date'])){
                    echo "<p class='error'>*Date must be selected!</p>";
                }
                else{
                    $_SESSION['date']=$_POST['date'];
                }
                }
                ?>
            </form>
            </ul>
        
            <ul class="navbar-nav" style="padding-right: 2%">
            <li class="nav-item p-1">
                <label class="l">
                <?php
                $date=$_SESSION['date'];
                echo "Date Selected: $date";
                ?>
                </label>
            </li>
            </ul>
            
        </div>

        </nav>

        <!-- Consolidated Purchase Table -->
        <table border=1 id="main"><?php
        require "./vendor/autoload.php";
        $spreadsheet=\PhpOffice\PhpSpreadsheet\IOFactory::load('./Database/items.xlsx');
        $writer=new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $sheet=$spreadsheet->getSheetByName('Sheet1');
        $row=$sheet->getHighestRow();
        $item='';
        $sub1='';
        for($i=1;$i<=1;$i++){
        echo "<tr>";
        for($j=65;$j<=67;$j++){
            echo "<th>". $sheet->getCell(chr($j).$i)->getValue() ."</th>";
        }
        echo "<th>Purchase Quantity</th>";
        echo "<th>Purchase Cost (Rs)</th>";
        echo "<th>Remarks</th>";
        echo "</tr>";
        }
        $flag=0;
        for($i=2;$i<=$row;$i++){
        echo "<tr><form method='POST'>";
        for($j=65;$j<=67;$j++){
            echo "<td>". $sheet->getCell(chr($j).$i)->getValue() ."</td>";
        }
        $sub='submit'.$i;
        echo "<td><input type='number' name='qnt' min='1' step='1' value='0'></input></td>";
        echo "<td><input type='number' name='cost' min='1' step='0.01' value='0'></input></td>";
        echo "<td><input type='submit' name=$sub value='Save'></input></td>";
        echo "</form></tr>";
        if(isset($_POST[$sub])){
            if($_SESSION['date']!=''){
            if(!empty($_POST['qnt']) && !empty($_POST['cost'])){
                $item=$sheet->getCell('B'.$i)->getValue();
                $sub1=$sub;
            }
            else{
                echo "<p class='error'>*All feilds are mandatory!</p>";
                }
            }
            else {
                if(!$flag){
                echo "<p class='error'>*Date must be selected!</p>";
                }
            $flag=1;
            }
        }
        }

        /*Modifying item purchases*/
        if(isset($_POST[$sub1])){
        if($_SESSION['date']!=''){
            if(!empty($_POST['qnt']) && !empty($_POST['cost'])){
            $qnt=$_POST['qnt'];
            $cost=(float)$_POST['cost'];
            for($i=2;$i<=$row;$i++){
                if($item==$sheet->getCell('B'.$i)->getValue()){
                break;
                }
            }
            $qnt1=$sheet->getCell('C'.$i)->getValue();
            $cost1=$sheet->getCell('D'.$i)->getValue();
            $sheet->setCellValue('C'.$i,$qnt+$qnt1);
            $sheet->setCellValue('D'.$i,$cost+$cost1);
            $sheet->setCellValue('E'.$i,$cost/$qnt);
            $qnt1=$sheet->getCell('H'.$i)->getValue();
            $sheet->setCellValue('H'.$i,$qnt+$qnt1);
            $writer->save('./Database/items.xlsx');
            }
        }
        }

        /*Modifying item statistics*/
        if(isset($_POST[$sub1])){
        if($_SESSION['date']!=''){
            if(!empty($_POST['qnt']) && !empty($_POST['cost'])){
            $cost=(float)$_POST['cost'];
            $sheet1=$spreadsheet->getSheetByName('Sheet2');
            $row=$sheet1->getHighestRow();
            $date_array=explode('-',$_SESSION['date']);
            if((int)$date_array[1]<=3){
                $i=2;
                for(;$i<=$row;$i+=3){
                $y=$sheet1->getCell(chr(65).$i)->getValue();
                $y_array=explode('-',$y);
                if((int)$y_array[0]+1==(int)$date_array[0]){
                    break;
                }
                }
                $j=75+(int)$date_array[1];
                $value=$sheet1->getCell(chr($j).$i)->getValue();
                $value+=$cost;
                $sheet1->setCellValue(chr($j).$i,$value);
                $writer->save('./Database/items.xlsx');
            }
            else{
                $i=2;
                for(;$i<=$row;$i+=3){
                $y=$sheet1->getCell(chr(65).$i)->getValue();
                $y_array=explode('-',$y);
                if((int)$y_array[0]==(int)$date_array[0]){
                    break;
                }
                }
                $j=63+(int)$date_array[1];
                $value=$sheet1->getCell(chr($j).$i)->getValue();
                $value+=$cost;
                $sheet1->setCellValue(chr($j).$i,$value);
                $writer->save('./Database/items.xlsx');
            }

            /*Modifying daily statistics*/
            $table='stats'.$date_array[0];
            $con=mysqli_connect('localhost','root','Dattu@219','items') or die(mysqli_connect_error());
            mysqli_select_db($con,'items') or die("cannot select DB");
            mysqli_query($con,"CREATE TABLE IF NOT EXISTS  $table ("."date VARCHAR(10) NOT NULL, "."item VARCHAR(200) NOT NULL, "."purchases FLOAT(20,2), "."sales FLOAT(20,2), "."wastage FLOAT(20,2), "."PRIMARY KEY(date,item))");
            $query=mysqli_query($con,"SELECT * FROM $table WHERE date='".$date."' AND item='".$item."'");
            $numrows=mysqli_num_rows($query);
            if($numrows==0){
                mysqli_query($con,"INSERT INTO $table ("."date,"."item,"."purchases) VALUES ('".$date."','".$item."','".$cost."')");
            }
            else{
                while($row=mysqli_fetch_assoc($query)){
                $purchases=$row['purchases'];
                mysqli_query($con,"UPDATE $table SET purchases='".$purchases+$cost."' WHERE date='".$date."' AND item='".$item."'");
                }
            }
            }
        }
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