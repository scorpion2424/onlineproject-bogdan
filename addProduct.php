<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';

    if(isset($_FILES['image']) && $_FILES['image']['size']>0) {
        addImage();
    }

    if (isset($_GET['product'])) {
        editProduct($conn);
    } elseif (!isset($_GET['product'])) {
        addProduct();
    }

    if(checkErrors() == false){
        displayErrors();
    }

    if(checkErrors() == true) {
        insertIntoDatabase($conn);
     }

/*
 * @checkErrors
 * If all the fields are filled with valid data, the function return true
 * Otherwise the function return false
 */

function checkErrors() {
       //  if (isset($_POST['submit'])) { //check if form was submitted
             if (
                 isset($_POST["productName"]) &&
                 strlen(trim(strip_tags($_POST["productName"]))) > 0 &&
                 isset($_POST["description"]) &&
                 strlen(trim(strip_tags($_POST["description"]))) > 0 &&
                 isset($_POST["price"]) &&
                 is_numeric($_POST["price"])
             ) {
                 return true;
             }
         //}
     return false;
}

/*
 * @addProduct
 * When you press the button "Add a product", from the admin's page, this function is called.
 * There are 4 fields:image,name,description and price which you must complete all to insert a new product into the database.
 */

function addProduct()
 {
     ?>
     <table>
         <tr>
             <th>
                 Image
             </th>

             <th>
                 Name
             </th>

             <th>
                 Description
             </th>

             <th>
                 Price
             </th>

             <th>
                 Edit
             </th>
         </tr>
         <?php
         //http://localhost:90/project-bogdan/addProductDone.php
         ?>
         <form class="editDetails" method="post" action=""
               enctype="multipart/form-data">

             <tr>

                 <td>
                     <input type="file" name="image" id="fileToUpload">
                 </td>

                 <td>
                     <input type="text" name="productName" value="<?php
                            if (isset($_POST['productName'])) {
                                echo htmlentities($_POST['productName']);
                            }
                             ?>"
                     />
                     </br>
                 </td>

                 <td>
                     <input type="text" name="description" value="<?php
                         if (isset($_POST['description'])) {
                             echo htmlentities($_POST['description']);
                         }
                         ?>"
                     />
                     <br>
                 </td>

                 <td>
                     <input type="text" name="price" value="<?php
                         if (isset($_POST['price'])) {
                             echo htmlentities($_POST['price']);
                         }
                         ?>"
                     />
                     </br>
                 </td>

                 <td>
                     <button type="submit" name="submit">Submit changes</button>
                 </td>

             </tr>
         </form>

     </table>
<?php
 }

/*
 @editProduct
When you press the button "Edit", from the admin's page, this function is called.
You can modify the existing data from a product: the image,the name, the description and the price.
 */

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

                         <td>
                            <div class="productImageWrapper">
                                <span class="addNewImage">
                                    Add a new image:
                                    <br />
                                    <input type="file" name="image" id="fileToUpload" />
                                </span>
                                <img class="productImage" src="images/<?= htmlentities($row['Image']); ?>"/>
                            </div>
                         </td>

                         <td>
                             <input type="text" name="productName" value="<?php
                                 if (isset($_POST['productName'])) {
                                     echo htmlentities($_POST['productName']);
                                 } else {
                                     echo htmlentities($row['Name']);
                                     } ?>"
                             />
                             <br />
                         </td>
                         <td>
                             <input type="text" name="description" value="<?php
                                    if(isset($_POST['description'])){
                                        echo htmlentities($_POST['description']);
                             } else {
                                        echo htmlentities($row['Description']);
                             } ?>"
                             />
                             </br>
                         </td>
                         <td>
                             <input type="text" name="price" value="<?php
                                    if(isset($_POST['price'])) {
                                        echo htmlentities($_POST['price']);
                                    } else {
                                        echo htmlentities($row['Price']);
                                    }?>"
                             />
                             </br>
                         </td>
                         <td>
                             <button type="submit">Submit changes</button>
                         </td>
                     </tr>
                 </form>

                 <?php
             } ?>
     </table>
 <?php }

/*
 @addImage
When you upload a new photo, this function is called.
You must upload a photo with one of this extensions: JPEG or PNG, and the photo's size must be less than 2 MB.
Otherwise, this function will return an error.
 */

 function addImage()
 {

     $errors= array();
     $file_name = $_FILES['image']['name'];
     $file_size =$_FILES['image']['size'];
     $file_tmp =$_FILES['image']['tmp_name'];
     $file_type=$_FILES['image']['type'];
     $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));

     $expensions= array("jpeg","jpg","png");

     if(in_array($file_ext, $expensions) === false) {
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
     }

     if ($file_size > 2097152) {
         $errors[]='File size must be less than 2 MB';
     }

     if (empty($errors) == true) {
         move_uploaded_file($file_tmp,"images/".$file_name);
         // echo "Success";
     } else {
         print_r($errors);
     }
 }

 /*
  @insertIntoDatabase
 If you complete all the field correctly, this function will be called and the product will be inserted or updated into
 the database.
 @param $_GET['product'] is the ID of the product.
 @stmt is a query which will insert into the database a new product with the following fields:
    -Image
    -Name
    -Description
    -Price
  */

 function insertIntoDatabase($conn) {
     if(!isset($_GET['product'])) {
         try {
             $stmt = $conn->prepare(
                        "INSERT INTO `products`(
                        Image,
                        Name,
                        Description,
                        Price
                        ) 
                      VALUES (
                        :productImage,
                        :productName,
                        :productDescription,
                        :productPrice
                      )
                  ");

             $productImage = $_FILES['image']['name'];
             $stmt->bindParam(':productImage', strip_tags($productImage));
             $stmt->bindParam(':productName', strip_tags($_POST["productName"]));
             $stmt->bindParam(':productDescription', strip_tags($_POST["description"]));
             $stmt->bindParam(':productPrice', strip_tags($_POST["price"]));

             $stmt->execute();
             // echo "Product updated";
             header('Location: http://localhost:90/project-bogdan/adminPage.php');
             exit();
         } catch (PDOException $e) {
             echo "Error: " . $e->getMessage();
         }
     }

     elseif(isset($_GET['product'])){
         try {
             if (isset($_FILES['image']) &&  $_FILES['image']['size'] > 0) {
                 $productImage = $_FILES['image']['name'];
                 $stmt = $conn->prepare(
                     "UPDATE `products`
                             SET
                            `Image` = :productImage,
                            `name` = :productName ,
                            `description`=:productDescription ,
                            `price`=:productPrice
                             WHERE `ID` = :productID "
                 );
                 $stmt->bindParam(':productImage', $productImage);
             } elseif (!isset($_FILES['image']) || $_FILES['image']['size'] < 1) {

                 $stmt = $conn->prepare(
                     "UPDATE `products` SET  
                       `name` = :productName , 
                       `description`=:productDescription ,
                       `price`=:productPrice
                        WHERE `ID` = :productID "
                 );
             }

             $stmt->bindParam(':productID', strip_tags($_GET['product']));
             $stmt->bindParam(':productName', strip_tags($_POST['productName']));
             $stmt->bindParam(':productDescription', strip_tags($_POST['description']));
             $stmt->bindParam(':productPrice', strip_tags($_POST['price']));



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

 /*
  * @displayErrors
  If you insert invalid data in the fields(example:you entered letters instead of numbers in the field for price),
 the user will see an error, wich will say what data is invalid.
  */

 function displayErrors(){
     ?>
     <div class="insertErrorMessage">
<!--         </br><span>Your request was NOT processed.</span></br>
              <span>The following problems were incurred:</span></br>
-->          <p>
                 <?php if(isset($_POST["productName"])) {
                     if(strlen(trim(strip_tags($_POST["productName"]))) === 0)
                     {
                         echo 'The name is invalid.';
                     }
                 }?>
            </p>
             <p>
                 <?php if(isset($_POST["description"])){
                     if(strlen(trim(strip_tags($_POST["description"]))) === 0)
                     {
                         echo 'The description is invalid.';
                     }
                 }?>
             </p>
             <p>
                 <?php if (isset($_POST["price"])) {
                           if(!is_numeric($_POST["price"])) {
                             echo 'The price is invalid.';
                           }
                        }?>
             </p>
     </div>
     <?php
 }
 include 'footer.php';
?>
