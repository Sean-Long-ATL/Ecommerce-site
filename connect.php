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
    $table = 'users';
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
        if (isset($_POST['first_name']) 
             && isset($_POST['user_name']) 
             && isset($_POST['first_name']) 
             && isset($_POST['last_name']) 
             && isset($_POST['email'])
             && isset($_POST['phone'])
             && isset($_POST['password'])
             && isset($_POST['cpassword'])) {

                echo "Post passed <br/>"; //debug
                $user_name = $_POST['user_name'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];
                $user_type = $_POST["user_type"];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $password = MD5($_POST['password']);
                $cpassword = MD5($_POST['cpassword']);
//                echo "<br/>fname ".$first_name;
//                echo "<br/>lname ".$last_name;
//                echo "<br/>user_type ".$user_type;
//                echo "<br/>email ".$email;
//                echo "<br/>phone ".$phone;
//                echo "<br/>password  :".$password;
//                echo "<br/>cpassword :".$cpassword."<br/>";
 
                
//               Update 
//            if ($_POST['update'] == 'yes') {

               // Do find to ensure Key record is present
//               $sql= "SELECT name FROM ". $table ." WHERE name = '$name'";
//               $query = mysqli_query($conn,$sql);
               // Do update if present
//               if ($row = mysqli_fetch_array($query)) {
                   //print_r($query);
//                   echo "<br/>";
//                   $sql= "UPDATE " . $table . " SET email='$email', phone='$phone', password='$password' WHERE name='$name'";
//               }
//               else {
//                   echo "No records updated, ".$name." not found<br/>";
//                   $sql= "";
//               }
 

                $operation = 'UPDATE';
//            }
//               Insert
//            else {
               $sql= "INSERT INTO " . $table . " (user_name, first_name, last_name, password, user_type, email, phone_number) VALUES ('$user_name', '$first_name', '$last_name','$password', '$user_type', '$email', '$phone')";
               $operation = 'INSERT';
//            }

            if (strlen($sql)> 1) {
               $query = mysqli_query($conn,$sql);
            }
            else {
               $query = False;
            }

            if ($query) {
                echo $operation . ' successful <br/>';
            }
            else {
                echo 'Error Occurred with ' .$operation .' <br/> ';
                echo 'Possible Dulicate user_name  <br/> ';
                echo $sql. '<br/>';
            }
        }

        if ($query) {
            // Check contents of db
            $sql= "SELECT user_number, user_name, first_name, last_name, password , user_type, email, phone_number FROM " . $table ;
            $result = mysqli_query($conn,$sql);
            echo "This table for debugging <br/>";
            if ($result->num_rows > 0) {
                echo "<table><thead>";
                echo "<tr> <th>Primary Key</th> <th>Username</th> <th>First Name</th> <th>Last Name</th> <th>  password </th> <th> Cust Type </th> <th> Email </th> <th> Phone</th> </tr>";
                echo "</thead><tbody>";
                while ($row = mysqli_fetch_array($result)) {
                   echo "<tr>";
                      echo "<td> " . $row['user_number'] . "</td>";     
                      echo "<td> " . $row['user_name'] . "</td>";     
                      echo "<td> " . $row['first_name'] . "</td>";     
                      echo "<td> " . $row['last_name'] . "</td>";     
                      echo "<td> " . $row['password'] . "</td>";     
                      echo "<td> " . $row['user_type'] . "</td>";
                      echo "<td> " . $row['email'] . "</td>";     
                      echo "<td> " . $row['phone_number'] . "</td>";     
                   echo "</tr>";
                }
                echo "</tbody></table>";
            }
            else {
                echo "Select failed";
            }
        }

        $conn->close();
    }
    else {
        echo 'FAILED: Reguest_method equal to POST and $_POST[submit] is  set';
        echo '<br/>';
        //print_r($_POST);
    }
?>
</body>
</html>
