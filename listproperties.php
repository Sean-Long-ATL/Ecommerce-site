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
    $conn= mysqli_connect( $host, $user, $passw, $dbname);
    if ($conn->connect_error) {
       echo "Count not connect to server<br/>";
           die ("Connection failed: " . $conn->connect_error);
    }
    else {
       echo "Connection established<br/>";
    }

        // Check contents of db
    $sql= "SELECT * FROM  $table ";
//    echo $sql . "<br/>";
    $result = mysqli_query($conn,$sql);
    echo "This table for debugging <br/>";
    if ($result->num_rows > 0) {
        echo "<div class='tbl'>";
        echo "<table><thead>";
	echo "<caption> List of Properties/Proj 3</caption>";
        echo "<tr> <th>Primary Key</th> <th>Owner ID</th> <th>Prop Name</th> <th>St Addr</th> <th>city</th> <th>state</th> <th>zip</th> <th> Built</th><th>Sq Ft</th><th>Beds</th><th>Baths</th><th>Price</th><th>pic name</th> </tr>";
        echo "</thead><tbody>";
        while ($row = mysqli_fetch_array($result)) {
           echo "<tr>";
              echo "<td> " . $row['id'] . "</td>";     
              echo "<td> " . $row['owner'] . "</td>";     
              echo "<td> " . $row['name'] . "</td>";     
              echo "<td> " . $row['st_address'] . "</td>";     
              echo "<td> " . $row['city'] . "</td>";     
              echo "<td> " . $row['state'] . "</td>";
              echo "<td> " . $row['zip'] . "</td>";     
              echo "<td> " . $row['build_date'] . "</td>";     
              echo "<td> " . $row['sq_footage'] . "</td>";     
              echo "<td> " . $row['num_bedrooms'] . "</td>";     
              echo "<td> " . $row['num_baths'] . "</td>";     
              echo "<td> " . $row['price'] . "</td>";     
              echo "<td> " . $row['picture'] . "</td>";     
           echo "</tr>";
        }
        echo "</tbody></table>";
        echo "</div>";
    }
    else {
        echo "Select return 0 rows";
    }

    $conn->close();
?>
</body>
</html>
