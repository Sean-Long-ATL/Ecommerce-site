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
    $conn= mysqli_connect( $host, $user, $passw, $dbname);
    if ($conn->connect_error) {
       echo "Count not connect to server \n";
           die ("Connection failed: " . $conn->connect_error);
    }
    else {
       echo "Connection established\n";
    }

        // Check contents of db
    $sql= "SELECT user_number, user_name, first_name, last_name, password , user_type, email, phone_number FROM " . $table ;
    $result = mysqli_query($conn,$sql);
    echo "This table for debugging <br/>";
 
    if ($result->num_rows > 0) {
        echo '<div class="tbl">';
        echo "<table><thead>";
	echo "<caption> List of users/Proj 3</caption>";
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
        echo "</div>";
    }
    else {
        echo "Select failed";
    }

    $conn->close();
?>
</body>
</html>
