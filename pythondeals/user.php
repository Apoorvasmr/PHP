<?php
$insert = false;
if(isset($_POST['name'])){
    // Set connection variables

    $filename = $_FILES["uploadfile"]["name"];
	$tempname = $_FILES["uploadfile"]["tmp_name"];
	$folder = "./images/" . $filename;

    // Create a database connection
    $con = mysqli_connect("localhost", "root1", "root1","items");
    
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
          
          if (move_uploaded_file($tempname, $folder)) {
            echo "<h3> Image uploaded successfully!</h3>";
        } else {
            echo "<h3> Failed to upload image!</h3>";
        }
}
?>


                


<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>User Page</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="style.css">
 </head>
 <body>
  <div class="container">
        <div class="first">
            <h1>User Side</h1>
            <div class="input-group">
                <span class="input-group-addon">Search</span>
                <input type="text" name="search_text" id="search_text" placeholder="Search" class="form-control" />
            </div>
        </div>
 </div> 
   <div id="result">
   </div>
 </body>
</html>


<script>
$(document).ready(function(){

 load_data();

 function load_data(query)
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{query:query},
   success:function(data)
   {
    $('#result').html(data);
   }
  });
 }
 $('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});
</script>