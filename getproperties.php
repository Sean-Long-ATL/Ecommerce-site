<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset = "UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Seller Dashboard</title>
        <link rel="stylesheet" href="card.css">
        <!--<link rel="stylesheet" href="connect.css">!-->
	<link rel="javascript" href="properties.js">

    <?php
    if (!isset($_COOKIE['user_number'])) {
        console.log("getProperties:Cookie property id is not set");
        die("Session read failure");
//	header('Location: sellerDashboard.html');
//        exit();
    }

//    print_r($_COOKIE);
//    echo "<br/>";
//    $owner = 1;   
    $owner = $_COOKIE['user_number'].intval();
//    $user_number = 1;  // Should be set by cookie or POST data

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
//    echo json_encode($rows);

//	header('Location: sellerDashboard.html');
//        exit();
?>
    


<script type="text/javascript">
var prop_array = <?php echo json_encode($rows); ?>;
function drawPicture(){


            for (var i = 0; i < prop_array.length; i++){

                let card = document.createElement("div");
                card.className ="card" + i;
                document.body.appendChild(card);

                let image = document.createElement("img");
                image.src = prop_array[i].picture;
                image.id = "img" + i;
                card.appendChild(image); 

                let container = document.createElement("div");
                card.className ="container" + i;
                card.appendChild(container);

                
                let editForm = document.createElement("form");
                editForm.method = "POST";
                editForm.action = "edit_property.php";
                container.appendChild(editForm);
            
                let input = document.createElement("input");
                input.type="hidden";
                input.id="id";
                input.name="id";
                input.value = prop_array[i].id;  
                editForm.appendChild(input);

                //<input type="hidden" id="custId" name="custId" value="3487">

                let editButton = document.createElement("button");
                editButton.type = "submit";
                editButton.id = "id"
                editButton.value = prop_array[i].id;
                editButton.innerHTML="edit";
                editForm.appendChild(editButton);

                let deleteForm = document.createElement("form");
                deleteForm.method = "POST";
                deleteForm.action = "delete_property.php"
                container.appendChild(deleteForm);
                deleteForm.appendChild(input);
                
                let deleteButton = document.createElement("button");
                deleteButton.type = "submit";
                deleteButton.value = prop_array[i].id;
                deleteButton.id = "id"

                deleteButton.innerHTML="delete";
                deleteForm.appendChild(deleteButton);

                window.onload = function () {
                var listElement = document.getElementsByTagName('img');
                for (i=0;i<listElement.length;i++) {
                    listElement[i].addEventListener('click',(function (i) {
                    return function () {
                        drawCard(i);
                        };
                        }(i)));
                    }
                }
            }

        }
        
       
        function drawCard(i){   
            deleteCard();
            //list of properties: id, owner, name, st_address, city, state, zip, build_date, sq_footage, num_bedrooms, num_baths, price, picture
            let propCard = document.createElement("div");
            propCard.id ="propCard";
            document.body.appendChild(propCard); //this needs to change later for formatting 
            
            let table = document.createElement("table");
            propCard.appendChild(table);

            var obj = prop_array[i];
            for (var key in obj){
                if( key != "id" && key != "owner" && key != "picture"){
                    let row =  document.createElement("tr");
                    table.appendChild(row);

                    let cell = document.createElement("td");
                    cell.innerHTML = key;
                    row.appendChild(cell);

                    let cell2 = document.createElement("td");
                    cell2.innerHTML = obj[key];
                    row.appendChild(cell2);
                    }
                }
        }   
        function deleteCard(){
            if (document.contains(document.getElementById("propCard"))) {
            document.getElementById("propCard").remove();
            }
        }
/*
let arr = prop_array;

  if (arr.length < 1) {
     document.write("no properties owned by you");
  }
  for (var i = 0; i < arr.length; i++){
    document.write("<br><br>array index: " + i);
    var obj = arr[i];
    for (var key in obj){
        var value = obj[key];
        document.write("<br> - " + key + ": " + value);
    }
}
*/

    </script>
</head>
<body >
    <script>
     
    drawPicture(); 
    </script>
</body>
</html>
