
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
            <h1>Admin Side</h1>
            
            <button class="menu_icon js-menu-icon">+ Add Product</button>
            <div class="menu">
                <form action="user.php" method="post" enctype="multipart/form-data">
                <table>    
                    <tr>
                        <td>Insert Image</td>
                        <td><div class="form-group">
				            <input class="form-control" type="file" name="uploadfile" value="" />
			            </div></td>
                    </tr>
                    <tr>
                        <td>Product Name</td>
                        <td><input type="text" name="name" id="name" placeholder="Enter product name"></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td><input type="int" name="price" id="price"" placeholder="Enter product price"></td>
                    </tr>
                    <tr>
                        <td>Unit</td>
                        <td>
                        <label for="unit" type="text"  ></label>

                            <select name="unit" id="unit">
                            <option value="Kilogram">Kilogram</option>
                            <option value="Kilometer">Kilometer</option>
                            <option value="Liter">Liter</option>
                            <option value="Meter">Meter</option>
                            <option value="Gram">Gram</option>
                            <option value="Centimeter">Centimeter</option>
                            </select>
                        </td>    
                    </tr>
                    <tr>
                        <td></td>
                        <td><div class="form-group">
                                        <button class="btn btn-primary" type="submit" name="upload">UPLOAD</button>
                                    </div>
                                 </td>
                    </tr>
                    
                </table>
            </form>
            </div>
          
        </div>
       
        
            <div class="card">
                <?php
                    $con = mysqli_connect('localhost','root1','root1','items');
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
    <script
    src="https://code.jquery.com/jquery-3.6.0.js"
    integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"
  ></script>
    <script src="index.js"></script>
    
</body>
</html>
