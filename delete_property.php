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

         if (!(isset($_POST['id'])
          && isset($_POST['owner']))) {

             print_r($_POST);
             die("post failed <br>");
         }
    }
    $id = $_POST['id'];
    $owner = $_POST['owner'];


    echo "Prior to connect <br/>";
    $conn= mysqli_connect( $host, $user, $passw, $dbname);

    if ($conn->connect_error) {
       echo "Count not connect to server<br/>";
           die ("Connection failed: " . $conn->connect_error);
    }
    else {
       echo "Connection established<br/>";
    }

        // Check contents of db
    $sql= "DELETE from $table  WHERE $id = id ";
//    echo $sql . "<br/>";
    echo "Prior to delete <br/>";
    echo "$sql <br/>";
    $result = mysqli_query($conn,$sql);

    if ($result) {
        echo "Delete worked<br/>";
 
    }
    else {
        echo "Delete failed<br/>";
    }
 
    $conn->close();
    
    header('Location: getproperties.php');
    exit();
   
?>
    <p> Go to this <a href="listproperties.php"> page,</a> to make sure the changes were done.</p>
</body>
</html>
