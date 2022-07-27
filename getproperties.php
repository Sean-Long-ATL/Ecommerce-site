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
    $user_id = 1;  // Should be set by cookie or POST data

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
echo "start";
//    else {
//       echo "Connection established<br/>";
//    }

        // Check contents of db
    //$sql= "SELECT * FROM  $table WHERE ";
    $tu = $u_table;
    $td = $d_table;    

    $sql = "SELECT * from $d_table WHERE owner = $user_id ";

//    $sql= "SELECT ".$td.".id, ".$td.".owner, ".$td.".name, ".$td.".st_address, ".$td.".city, ".$td.".state, ";
//    $sql= $sql .$td.".zip, ".$td.".build_date, ".$td.".sq_footage, ".$td.".num_bedrooms, ".$td.".price, ".$td.".picture ";
//    $sql = "$sql FROM  $td  JOIN  $tu WHERE ".$td.".owner = $user_id";
//    $sql = "$sql FROM  $td  JOIN  $tu WHERE ".$td.".owner = ".$tu.".user_number and ".$tu.".user_name = $user_id";


    echo $sql . "<br/>";
    $result = mysqli_query($conn,$sql);
    //echo "This table for debugging <br/>";
    
    $rows = array();
    $ndx = 0;
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $rows[] = $row;  
            $ndx++;
        }
    }
//    else {
//        echo "Select return 0 rows";
//    }


    // Debugging output

    echo "<table><tr>";
    foreach ($rows[0] as $key => $value) {
       if (!is_numeric($key)) {
           echo "<th>| $key </th>";
       }
    }
    echo "</tr>";
    
    for ($n=0; $n< $ndx; $n++) {
       echo "<tr>";
       foreach ($rows[$n] as $key => $value) {
          if (!is_numeric($key)) {
             echo "<td> $value </td>";
          }
       }
       echo "</tr>";
    }  
    echo "</table>";
    $conn->close();
    echo "<script>";
    echo "</script>";
?>
    
<script type="text/javascript">
   var prop_array = "<?php echo $rows; ?>";
</script>

</body>
</html>
