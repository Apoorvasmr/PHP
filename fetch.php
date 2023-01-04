<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "items");
$output = '';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM items 
  WHERE filename LIKE '%".$search."%'
  OR name LIKE '%".$search."%' 
  OR price LIKE '%".$search."%' 
  OR unit LIKE '%".$search."%' 
 ";
}
else
{
 $query = "
  SELECT * FROM items
 ";
}
$result = mysqli_query($connect, $query);
if(mysqli_num_rows($result) > 0)
{
 $output .= '
    
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
  <div class="card">
  <div class="itemcard">
  <div class="column">
          <img src="./images/'. $row['filename'].'">
  </div>
  <div class="column">    
      '.$row["name"].'</div>
  <div class="column">        
      '.$row["price"].'</div>
  <div class="column">    
      '.$row["unit"].'</div>
</div>
</div> 
</div>  
  ';
 }
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>