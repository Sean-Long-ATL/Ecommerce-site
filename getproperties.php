<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registration form</title>
        <link rel="stylesheet" href="connect.css">
	<link rel="javascript" href="properties.js">
</head>
<body >
<?php
    if (!isset($_COOKIE['user_number'])) {
        console.log("getProperties:Cookie property id is not set");
        die("Session read failure");
//	header('Location: sellerDashboard.html');
//        exit();
    }

//    print_r($_COOKIE);  // Debug
//    echo "<br/>";       // Debug

    $owner = $_COOKIE['user_number'].intval();

    $host = 'localhost';
    $user = 'gmurray2';
    $passw = 'gmurray2';
    $dbname = 'gmurray2';
    $u_table = 'users';
    $d_table = 'properties';
    $conn= mysqli_connect( $host, $user, $passw, $dbname);
    if ($conn->connect_error) {
       echo "Count not connect to server<br/>";
           die ("Connection failed: " . $conn->connect_error);
    }

        // Check contents of db
    //$sql= "SELECT * FROM  $table WHERE ";
    $tu = $u_table;
    $td = $d_table;    

    $sql = "SELECT * from $d_table WHERE owner = $owner ";


//    echo $sql . "<br/>";
    $result = mysqli_query($conn,$sql);
    //echo "This table for debugging <br/>";
    
    $rows = array();
    $ndx = 0;
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;  
            $ndx++;
        }
    }


    // Debugging output

//    echo "<table><tr>";
//    foreach ($rows[0] as $key => $value) {
//       if (!is_numeric($key)) {
//           echo "<th>| $key </th>";
//       }
//    }
//    echo "</tr>";
    
//    for ($n=0; $n< $ndx; $n++) {
//       echo "<tr>";
//       foreach ($rows[$n] as $key => $value) {
//          if (!is_numeric($key)) {
//             echo "<td> $value </td>";
//          }
//       }
//       echo "</tr>";
//    }  
//    echo "</table>";

    $conn->close();

?>
    
<script type="text/javascript">
var prop_array = <?php echo json_encode($rows); ?>;

let arr = prop_array;

  for (var i = 0; i < arr.length; i++){
    document.write("<br><br>array index: " + i);
    var obj = arr[i];
    for (var key in obj){
        var value = obj[key];
        document.write("<br> - " + key + ": " + value);
    }
}

</script>

</body>
</html>