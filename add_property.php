<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration form</title>
        <link rel="stylesheet" href="connect.css">
</head>
<body >

<?php
    $host = 'localhost';
    $user = 'gmurray2';
    $passw = 'gmurray2';
    $dbname = 'gmurray2';
    $table = 'properties';
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $conn= mysqli_connect( $host, $user, $passw, $dbname);
        if ($conn->connect_error) {
           echo "Count not connect to server<br/> ";
               die ("Connection failed: " . $conn->connect_error);
        }
//        else {
//           echo "Connection established<br/>";
//        }

        //print_r($_POST); //debug
        //echo "<br/>";    // debug
        if (    isset($_POST['owner']) 
             && isset($_POST['name']) 
             && isset($_POST['st_address']) 
             && isset($_POST['city']) 
             && isset($_POST['state']) 
             && isset($_POST['zip']) 
             && isset($_POST['build_date']) 
             && isset($_POST['sq_footage']) 
             && isset($_POST['num_bedrooms']) 
             && isset($_POST['num_baths'])
             && isset($_POST['price'])) {


            //echo "Post passed <br/>"; //debug
            $owner = $_POST['owner'];
            $name = $_POST['name'];
            $st_address = $_POST['st_address'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zip = $_POST['zip'];
            $build_date = $_POST['build_date'];
            $sq_footage = $_POST['sq_footage'];
            $num_bedrooms = $_POST['num_bedrooms'];
            $num_baths = $_POST['num_baths'];
            $price = $_POST['price'];
 
            //echo "Posted data extraction passed <br/>"; //debug
            $operation = 'INSERT';
            if (strlen($_POST['picture']) > 3) {
               $picture = $_POST['picture'];
            }
            else {
               $picture = NULL;
            }
            $sql= "INSERT INTO $table (owner, name, st_address, city, state, zip, build_date, sq_footage, num_bedrooms, num_baths, price, picture)";
            $sql = $sql . " VALUES ($owner, '$name', '$st_address', '$city', '$state', $zip, '$build_date', ";
            $sql = $sql . "$sq_footage, $num_bedrooms, $num_baths, $price, '$picture') ";

            $operation = 'INSERT';

         
            if (strlen($sql)> 1) {
               $query = mysqli_query($conn,$sql);
            }
            else {
               $query = False;
            }

            if (!$query) {
                echo 'Error Occurred with ' .$operation .' <br/> ';
                echo $sql. '<br/>';
            }
        }
        else {
           if (   
                isset($_POST['build_date']) 
             && isset($_POST['sq_footage']) 
             && isset($_POST['num_bedrooms']) ) {
               echo "<br/>Set: build_date, sq_foot, num_bedrooms<br/>";
             }
             else {
               echo "<br/>One of these not Set: build_date, sq_foot, num_bedrooms<br/>";

             }
             
             if ( 
                isset($_POST['num_baths'])
             && isset($_POST['price'])) {
               echo "<br/>Set: #baths, price<br/>";
             }
             else {
               echo "<br/>One not Set: #baths, price<br/>";
             }
	     die("Died");
	}

        if ($query) {
            echo "To ensure data got into table go to <a href='listproperties.php'>here</a> <br/>";
        }

	$conn->close();
        header('Location: getproperties.php');
        exit();	
    }
    else {
        echo 'FAILED: Reguest_method equal to POST and $_POST[submit] is  set';
        echo '<br/>';
        //print_r($_POST);
    }
?>
</body>
</html>
