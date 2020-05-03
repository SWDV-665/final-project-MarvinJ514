<!DOCTYPE html>
<html lang="en">
    <?php 

        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $today = $year . '-' . $month . '-' . $day;
    ?>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>What2DoSTL</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="../Pages/Themes/style.css">
        <link rel="stylesheet" href="../Pages/Themes/loginPrompt.css">
        <script type="text/javascript" src="../Pages/JS/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="../Pages/JS/mustache.js"></script>
        <script type="text/javascript" src="../Pages/JS/HomeData.js"></script>
        <script type="text/javascript" src="../Pages/JS/QueryParse.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
    </head>

    <body>
        <div class="navbar navbar-inverse navbar-static-top" role="navigation" aria-label="Primary">
            <div class="container">
                <div class="navbar-header">
                    <div class="navbar-brand">What2DoSTL</div>
                    <nav>
                        <ul>
                            <li><a href="../homeChooseLogin.html" style="width:auto;">Login</a>
                            <li><a href="../Pages/Guest/Guest.html">Guest</a>	
                        </ul>  
                    </nav>
                </div>
            </div>
        </div>
        <section id="pageContent" aria-label="Media Streaming Types" class="results">
            <?php
                session_start();
                // Connection Info
                $DATABASE_HOST = 'localhost';
                $DATABASE_USER = 'what2dostl_create';
                $DATABASE_PASS = '1q2w#E$R1q2w#E$R';
                $DATABASE_NAME = 'phplogin';
                $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
                if ( mysqli_connect_errno() ) {
                    // If there is an error with the connection, stop the script and display the error.
                    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
                }

                $aPref = $_POST['formPreferences'];
                $formDate = $_POST['date'];
                $formBudget = $_POST['budget'];
                $N = count($aPref);
                if($N == 0 && $formDate == "" && $formBudget == "") {
                    //echo("You didn't select any preferences.");
                    if ($stmt = $con->prepare("SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date>'$today' ORDER BY Event_Date ASC")) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection" target="_blank">';
                                echo '<h1><a href="'.$eventLink.'">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>No Results Found that meet our selected Preferences</h1>';
                        }
                                       
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N == 0 && $formDate != "" && $formBudget == ""){
                    if ($stmt = $con->prepare("SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >='$formDate' ORDER BY Event_Date ASC")) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo $formDate;
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N == 0 && $formDate != "" && $formBudget != ""){
                    if ($stmt = $con->prepare("SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >='$formDate' ORDER BY Event_Date ASC")) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo $formDate, $formBudget;
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N != 0 && $formDate == "" && $formBudget == ""){
                    $whereSQL="";
                    for($i=0; $i < $N; $i++) {
                        
                        if($N - $i == 1){
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%'";
                        }
                        else{
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%' OR ";
                        }
                    }
                    $sql = "SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >= '$today' AND ($whereSQL) ORDER BY Event_Date ASC";
                    //echo $sql;
                    if ($stmt = $con->prepare($sql)) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N != 0 && $formDate != "" && $formBudget == ""){
                    $whereSQL="";
                    for($i=0; $i < $N; $i++) {
                        
                        if($N - $i == 1){
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%'";
                        }
                        else{
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%' OR ";
                        }
                    }
                    $sql = "SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >= '$formDate' AND ($whereSQL) ORDER BY Event_Date ASC";
                    //echo $sql;
                    if ($stmt = $con->prepare($sql)) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N != 0 && $formDate != "" && $formBudget != ""){
                    $whereSQL="";
                    for($i=0; $i < $N; $i++) {
                        
                        if($N - $i == 1){
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%'";
                        }
                        else{
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%' OR ";
                        }
                    }
                    $sql = "SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >= '$formDate' AND ($whereSQL) ORDER BY Event_Date ASC";
                    //echo $sql;
                    if ($stmt = $con->prepare($sql)) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N != 0 && $formDate == "" && $formBudget != ""){
                    $whereSQL="";
                    for($i=0; $i < $N; $i++) {
                        
                        if($N - $i == 1){
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%'";
                        }
                        else{
                            $whereSQL .= "Type LIKE '%".$aPref[$i]."%' OR ";
                        }
                    }
                    $sql = "SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >= '$today' AND ($whereSQL) ORDER BY Event_Date ASC";
                    //echo $sql;
                    if ($stmt = $con->prepare($sql)) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo 'Could not prepare statement!';
                    }
                }
                elseif($N == 0 && $formDate == "" && $formBudget != ""){
                    $sql = "SELECT Event_Name,Event_Link,Location,Short_Description,Type,Event_Date FROM eventstable WHERE Event_Date >= '$today' ORDER BY Event_Date ASC";
                    //echo $sql;
                    if ($stmt = $con->prepare($sql)) {
                        $stmt->execute();
                        $stmt->store_result();
                        $stmt->bind_result($event, $eventLink,$Location,$Description,$Type,$Date);
                        if($stmt->num_rows >0){
                            while($stmt->fetch()) {
                                echo '<div class="resultSection">';
                                echo '<h1><a href="'.$eventLink.'" target="_blank">'.$event.'</a></h1>';
                                echo '<h2>'.$Location.' | '.$Date.'</h2>';
                                echo '<h3>'.$Type.'</h3>';
                                echo '<p>'.$Description.'</p><br>';
                                echo '</div><br>';
                            }
                        }else{
                            echo '<h1>Sorry, No Results Found that meet your selected Preferences</h1>';
                        }               
                    }else {
                        // Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
                        echo 'Could not prepare statement!';
                    }
                }
                //else {
                //    echo("You selected $N preference(s): ");
                //    for($i=0; $i < $N; $i++) {
                //        echo($aPref[$i] . " ");
                //    }
                //}
            ?>
        </section>
        <nav class="pagebuttons2">
            <ul>
                <li><a href="../Pages/Guest/Guest.html">New Query</a></li>	
            </ul>  
        </nav><br><br><br><br>
        <footer>
            <p>&copy; 2020, Edited by Marvin Johnson </p>
        </footer>
    </body>

</html>