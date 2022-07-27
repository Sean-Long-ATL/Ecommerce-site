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
         if (isset($_POST['id'])) {
             $id = $_POST['id'];
             echo "post passed $id <br>";
         }
         else {
             echo "post failed <br>";
             print_r($_POST);
             echo " <br>";
         }
    }
    $id = $_POST['id'];
    $owner =  $_POST['owner'];
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
    $picture = $_POST['picture'];


    $conn= mysqli_connect( $host, $user, $passw, $dbname);

    if ($conn->connect_error) {
       echo "Count not connect to server<br/>";
           die ("Connection failed: " . $conn->connect_error);
    }
    else {
       echo "Connection established<br/>";
    }

        // Check contents of db
    $sql= "UPDATE $table SET owner='$owner', name='$name', st_address='$st_address', city='$city', state='$state', zip='$zip', build_date='$build_date',";
    $sql= $sql . " sq_footage='$sq_footage', num_bedrooms='$num_bedrooms', num_baths='$num_baths', price='$price', picture='$picture' WHERE $id = id ";
//    echo $sql . "<br/>";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        echo "Update worked<br/>";
 
    }
    else {
        echo "Update failed<br/>";
    }
 
    $conn->close();
?>
    <p> Go to this <a href="listproperties.php"> page,</a> to make sure the changes were done.</p>
</body>
</html>
