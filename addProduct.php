<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';

    checkErrors();

    if(isset($_FILES['image']) && $_FILES['image']['size']>0) {
        addImage();
    }

    if(isset($_GET['product'])) {
        editProduct($conn);
    }

    elseif(!isset($_GET['product'])){
        addProduct($conn);
    }

    if(checkErrors() == false){
        displayErrors();
    }

    if(checkErrors() == true) {
        insertIntoDatabase($conn);
     }

 function checkErrors(){
       //  if (isset($_POST['submit'])) { //check if form was submitted
             if (isset($_POST["productName"]) && strlen(trim(strip_tags($_POST["productName"]))) > 0 && isset($_POST["description"]) &&
                 strlen(trim(strip_tags($_POST["description"]))) > 0 && isset($_POST["price"]) && is_numeric($_POST["price"])) {
                 return true;
             }
         //}
     return false;
     }
 function addProduct($conn)
 {
     ?>
     <table>
         <tr>
             <th>Image</th>
             <th>Name</th>
             <th>Description</th>
             <th>Price</th>
             <th>Edit</th>
         </tr>
         <?php
         //http://localhost:90/project-bogdan/addProductDone.php
         ?>
         <form class="editDetails" method="post" action=""
               enctype="multipart/form-data">

             <tr>

                 <td><input type="file" name="image" id="fileToUpload"></td>
                 <td><input type="text" name="productName" placeholder="name..."><br></td>
                 <td><input type="text" name="description" placeholder="description..."><br></td>
                 <td><input type="text" name="price" placeholder="price..."><br></td>
                 <td>
                     <button type="submit" name="submit">Submit changes</button>
                 </td>

         </form>
         </tr>
     </table>
<?php
 }
 function editProduct($conn)
 {
     ?>
     <table>
         <tr>
             <th>Image</th>
             <th>Name</th>
             <th>Description</th>
             <th>Price</th>
             <th>Edit</th>
         </tr>
         <?php

             $productID = strip_tags($_GET['product']);
             $sql = "SELECT ID, Image, Name,  Description, Price  FROM products WHERE ID='$productID'";
             foreach ($conn->query($sql) as $row) {
                 ?>
                 <form id="editDetails" method="post" action="" enctype="multipart/form-data">
                     <tr>
                         <td><div class="productImageWrapper"><span class="addNewImage">Add a new image:<br><input type="file" name="image" id="fileToUpload"></span><img class="productImage" src="images/<?php print htmlentities($row['Image']); ?>"</div></td>
                         <td><input type="text" name="productName" value="<?php echo htmlentities($row['Name']) ?>"><br></td>
                         <td><input type="text" name="description"
                                    value="<?php echo htmlentities($row['Description']) ?>"><br></td>
                         <td><input type="text" name="price" value="<?php echo htmlentities($row['Price']) ?>"><br></td>
                         <td>
                             <button type="submit">Submit changes</button>
                         </td>

                 </form>
                 </tr>
                 <?php
             } ?>
     </table>
 <?php }
 function addImage(){

     $errors= array();
     $file_name = $_FILES['image']['name'];
     $file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];
     $file_type=$_FILES['image']['type'];
     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

     $expensions= array("jpeg","jpg","png");

     if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }

     if($file_size > 2097152){
         $errors[]='File size must be less than 2 MB';
     }

     if(empty($errors)==true){
         move_uploaded_file($file_tmp,"images/".$file_name);
         // echo "Success";
     }else{
         print_r($errors);
     }
 }
 function insertIntoDatabase($conn){
     if(!isset($_GET['product'])) {
         try {
             $stmt = $conn->prepare("INSERT INTO `products`(Image,Name,Description,Price)  VALUES (:productImage, :productName, :productDescription, :productPrice) ");

             $productImage = $_FILES['image']['name'];
             $stmt->bindParam(':productImage', strip_tags($productImage));
             $stmt->bindParam(':productName', strip_tags($_POST["productName"]));
             $stmt->bindParam(':productDescription', strip_tags($_POST["description"]));
             $stmt->bindParam(':productPrice', strip_tags($_POST["price"]));

             $stmt->execute();
             // echo "Product updated";
         } catch (PDOException $e) {
             echo "Error: " . $e->getMessage();
         }
     }

     elseif(isset($_GET['product'])){
         try {
             if(isset($_FILES['image']) &&  $_FILES['image']['size']>0) {
                 $productImage = $_FILES['image']['name'];
                 $stmt = $conn->prepare("UPDATE `products` SET `Image` = :productImage, `name` = :productName , `description`=:productDescription ,
                       `price`=:productPrice WHERE `ID` = :productID ");
                 $stmt->bindParam(':productImage', $productImage);
             }
             elseif(!isset($_FILES['image']) || $_FILES['image']['size']<1){

                 $stmt = $conn->prepare("UPDATE `products` SET  `name` = :productName , `description`=:productDescription ,
                       `price`=:productPrice WHERE `ID` = :productID ");
             }

             $stmt->bindParam(':productID', strip_tags($_GET['product']));
             $stmt->bindParam(':productName', strip_tags($_POST["productName"]));
             $stmt->bindParam(':productDescription', strip_tags($_POST["description"]));
             $stmt->bindParam(':productPrice', strip_tags($_POST["price"]));



             $stmt->execute();
             // echo "Product updated";
             header('Location: http://localhost:90/project-bogdan/adminPage.php');
             exit();
         }
         catch(PDOException $e)
         {
            echo "Error: " . $e->getMessage();
         }
     }

 }
 function displayErrors(){
     ?>
     <div class="insertErrorMessage">
<!--         </br><span>Your request was NOT processed.</span></br>
          <span>The following problems were incurred:</span></br>
-->          <p><?php if(isset($_POST["productName"])){
                 if(strlen(trim(strip_tags($_POST["productName"]))) === 0)
                 {
                     echo 'The name is invalid.';
                 }
             }?></p>
         <p><?php if(isset($_POST["description"])){
                 if(strlen(trim(strip_tags($_POST["description"]))) === 0)
                 {
                     echo 'The description is invalid.';
                 }
             }?></p>
         <p><?php if(isset($_POST["price"])){
                 if(!is_numeric($_POST["price"]))
                 {
                     echo 'The price is invalid.';
                 }
             }?></p>
     </div>
     <?php
 }
 include 'footer.php';
?>
