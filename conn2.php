<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login form</title>
        <link rel="stylesheet" href="connect.css">
</head>
<body >

<?php
    $host = 'localhost';
    $user = 'gmurray2';
    $passw = 'gmurray2';
    $dbname = 'gmurray2';
    $table = 'users';
    print_r($_POST); echo "<br/>";
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
        $conn= mysqli_connect( $host, $user, $passw, $dbname);
        if ($conn->connect_error) {
           echo "Count not connect to server \n";
               die ("Connection failed: " . $conn->connect_error);
        }
        else {
           echo "Connection established\n";
        }

//        print_r($_POST); //debug
//        echo "<br/>";    // debug
        if (isset($_POST['user_name']) 
             && isset($_POST['password'])) {

            echo "Post passed <br/>"; //debug
            $user_name = $_POST['user_name'];
            $user_type = "Buyer";
            $password = MD5($_POST['password']);


            // Check contents of db
            $sql= "SELECT user_number, password FROM " . $table . " WHERE user_name = '".$user_name ."'";
            echo $sql. " <br/>";
            $result = mysqli_query($conn,$sql);
            $pwd = "";
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                     $user_number =  $row['user_number'] ;     
                     $pwd =  $row['password'] ;
                }
            }
            else {
                echo "Select failed";
            }

            if ($pwd == $password) {
               echo "Login successful <br/>";
               setcookie("user_number",$user_number, time()+240*60*60);
               header('Location: getproperties.php');
               exit();
            }
            else {
	       echo "Login unsuccessful <br/>";
               setcookie('error', 'error', time()+15);
               header('Location: login.html');
               exit();

            }

            $conn->close();
        }
        else {
            echo 'FAILED: Reguest_method equal to POST and $_POST[submit] is  set';
            echo '<br/>';
            //print_r($_POST);  // Debug
        }
    }
?>
</body>
</html>
