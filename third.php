<?php
$insert = false;
if(isset($_POST['name'])){
    // Set connection variables

    $filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./images/" . $filename;

    // Create a database connection
    $con = mysqli_connect("localhost", "root", "","items");
    
    // Check for connection success
    if(!$con){
        die("connection to this database failed due to" . mysqli_connect_error());
    }
    // echo "Success connecting to the db";

    // Collect post variables
    // $filename = $_POST['filename'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $unit = $_POST['unit'];
    //$sql = "INSERT INTO `items`.`items` (`filename`,`name`, `price`, `unit`) VALUES ('$filename','$name', '$price', '$unit')";
   
      // Check username is exists or not
      $query = "SELECT count(*) as allcount FROM items 
      WHERE filename='".$filename."' && name='".$name."' && 
      price='".$price."' && unit='".$unit."'";
          $result = mysqli_query($con,$query);
          $row = mysqli_fetch_array($result);
          $allcount = $row['allcount'];
  
          // insert new record
          if($allcount == 0){
          $insert_query = "INSERT INTO 
          items(filename,name,price,unit) 
          VALUES('".$filename."','".$name."','".$price."','".$unit."')";
          mysqli_query($con,$insert_query);
          }

    // Execute the query
    
    // if($con->query($sql) == true){
    //     // echo "Successfully inserted";

    //     // Flag for successful insertion
    //     $insert = true;
    // }
    // else{
    //     echo "ERROR: $sql <br> $con->error";
    // }
    // Now let's move the uploaded image into the folder: image
	if (move_uploaded_file($tempname, $folder)) {
		echo "<h3> Image uploaded successfully!</h3>";
	} else {
		echo "<h3> Failed to upload image!</h3>";
	}
    
   


    // Close the database connection
    // $con->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pythondeals</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
   
    <div class="container">
        <div class="first">
            <h1>User Side</h1>
        </div>
       
        
            <div class="card">
                <?php
                 $con = mysqli_connect("localhost", "root", "","items");
                    $query = "SELECT * FROM items";
                    $query_run = mysqli_query($con,$query);
                    $data = mysqli_fetch_assoc($query_run);
                    if(mysqli_num_rows($query_run)>0)
                    {
                        foreach($query_run as $row)
                        {
                            ?>
                            
                                <div class="itemcard">
                                    <div class="column">
                                        <img src="./images/<?php echo $row['filename']; ?>">
                                    </div>
                                    <div class="column">    
                                        <?=$row["name"];?></div>
                                    <div class="column">        
                                        <?=$row["price"];?></div>
                                    <div class="column">    
                                        <?=$row["unit"];?></div>
                                </div>    
            
                            <?php
                                }
                                }    
                                else
                                {
                                    echo "No record found";
                                }    

                            ?>
            </div>         
       
    </div>
   
    
</body>
</html>





   

