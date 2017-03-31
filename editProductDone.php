<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';
function addImage(){
    if(isset($_FILES['image'])){
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
            echo "Success";
        }else{
            print_r($errors);
        }
    }
}

try {
    addImage();

//echo $_GET['product'],$_POST['productName'],$_POST['description'],$_POST['price'];
    if(isset($_FILES['image'])) {
        $productImage = $_FILES['image']['name'];
        $stmt = $conn->prepare("UPDATE `products` SET `Image` = :productImage, `name` = :productName , `description`=:productDescription ,
                          `price`=:productPrice WHERE `ID` = :productID ");
        $stmt->bindParam(':productImage', $productImage);
    }
    elseif(!isset($_FILES['image'])){

        $stmt = $conn->prepare("UPDATE `products` SET  `name` = :productName , `description`=:productDescription ,
                          `price`=:productPrice WHERE `ID` = :productID ");
    }

        $stmt->bindParam(':productID', strip_tags($_GET['product']));
        $stmt->bindParam(':productName', strip_tags($_POST["productName"]));
        $stmt->bindParam(':productDescription', strip_tags($_POST["description"]));
        $stmt->bindParam(':productPrice', strip_tags($_POST["price"]));



    $stmt->execute();
  // echo "Product updated";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
//header('Location: http://localhost:90/project-bogdan/adminPage.php');
//exit();
?>