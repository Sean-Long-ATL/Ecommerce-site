<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>update form</title>
        <link rel="stylesheet" href="connect.css">
</head>
<body >

<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
         if (isset($_POST['id'])) {
             $id = $_POST['id'];
             //echo "post passed $id <br>";
         }
         else {
             echo "post failed <br>";
             print_r($_POST);
             echo " <br>";
         }
    }


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
//    else {
//       echo "Connection established<br/>";
//    }

        // Check contents of db
    $sql= "SELECT * FROM  $table WHERE $id = id ";
//    echo $sql . "<br/>";
    $result = mysqli_query($conn,$sql);
    if ($result->num_rows > 0) {

 
        echo "<div class='tbl'>";
        //echo "<table><thead>";
	//echo "<caption> List of Properties/Proj 3</caption>";
        //echo "<tr> <th>Primary Key</th> <th>Owner ID</th> <th>Prop Name</th> <th>St Addr</th> <th>city</th> <th>state</th> <th>zip</th> <th> Built</th><th>Sq Ft</th><th>Beds</th><th>Baths</th><th>Price</th><th>pic name</th> </tr>";
        //echo "</thead><tbody>";
        while ($row = mysqli_fetch_array($result)) {
           $id = $row['id'];
           $owner =  $row['owner'];
           $name = $row['name'];
           $st_address = $row['st_address'];
           $city = $row['city'];
           $state = $row['state'];
           $zip = $row['zip'];
           $build_date = $row['build_date'];
           $sq_footage = $row['sq_footage'];
           $num_bedrooms = $row['num_bedrooms'];
           $num_baths = $row['num_baths'];
           $price = $row['price'];
           $picture = $row['picture'];
              echo "<form action='update_property.php' method='POST'>";
                 echo "<input type='text' name='id' id='id' value='$id' hidden />";
                 echo "<label for='owner'>Your User ID:</label><br/>";
                 echo "<input type='text' name='owner' id='owner' value='$owner'  /> <br/><br/>"; // readonly
                 echo "<label for='name'>Property Name:</label><br/>";
                 echo "<input type='text' name='name' id='name' value='$name' /> <br/><br/>";
                 echo "<label for='st_address'>Street Address:</label><br/>";
                 echo "<input type='text' name='st_address' id='st_address' value='$st_address' /> <br/><br/>"; //readonly
                 echo "<label for='city'>City:</label><br/>";
                 echo "<input type='text' name='city' id='city' value='$city' /> <br/><br/>"; // readonly
                 echo "<label for='state'>State:</label><br/>";
                 echo "<input type='text' name='state' id='state' value='$state' /> <br/><br/>"; // readonly
                 echo "<label for='zip'>Zip:</label><br/>";
                 echo "<input type='text' name='zip' id='zip' value='$zip' /> <br/><br/>"; // readonly
                 echo "<label for='build_date'>Build Date:</label><br/>";
                 echo "<input type='text' name='build_date' id='build_date' value='$build_date' /> <br/><br/>"; // readonly
                 echo "<label for='sq_footage'>Sq Footage:</label><br/>";
                 echo "<input type='text' name='sq_footage' id='sq_footage' value='$sq_footage' /> <br/><br/>";
                 echo "<label for='num_bedrooms'># Bedrooms:</label><br/>";
                 echo "<input type='text' name='num_bedrooms' id='num_bedrooms' value='$num_bedrooms' /> <br/><br/>";
                 echo "<label for='num_baths'>Baths:</label><br/>";
                 echo "<input type='text' name='num_baths' id='num_baths' value='$num_baths' /> <br/><br/>";
                 echo "<label for='price'>Price:</label><br/>";
                 echo "<input type='text' name='price' id='price' value='$price' /> <br/><br/>";
                 echo "<label for='picture'>Picture:  optional</label><br/>";
                 echo "<input type='text' name='picture' id='picture' value='$picture' /> <br/><br/>";
                 echo "<input type='submit' name='submit' id='submit'/>";
              echo "</form>";

        }
    }
    else {
        echo "Select return 0 rows";
    }

    $conn->close();
?>
</body>
</html>
