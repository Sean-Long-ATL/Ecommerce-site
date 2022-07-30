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
    //print_r($_POST); echo "<br/>";
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
            $sql= "SELECT * FROM " . $table . " WHERE user_name = '".$user_name ."'";
            echo $sql. " <br/>";
            $result = mysqli_query($conn,$sql);
            $pwd = "";
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                     $user_number =  $row['user_number'] ;     
                     $pwd =  $row['password'] ;
             //        print_r($row);
                     $user_type = $row['user_type'];       
             //        echo "User type ::<br/>";
                }
            }
            else {
                echo "Select failed";
                die("System Error - conn2:select failed");
            }
            //print_r($row);
            if ($pwd == $password) {
               //echo "Login successful |$pwd|   :$user_type:<br/>";
               if ($user_type === 'Seller') {
                   setcookie("user_number",$user_number, time()+240*60*60);
                   header('Location: getproperties.php');
                   console.log($user_type);
                   exit;
             //       die($user_type);
               }
               else  {
                   setCookie("user_type", $user_type, time+2);
	           header('Location: login.html');
                   exit;
               }
            }
            else {
	       echo "Login unsuccessful <br/>";
               setcookie('error', 'error', time()+1);
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
