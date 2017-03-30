<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';

try {
    $stmt = $conn->prepare("UPDATE `products` SET `name` = :productName , `description`=:productDescription ,
                          `price`=:productPrice WHERE `ID` = :productID ");
//echo $_GET['product'],$_POST['productName'],$_POST['description'],$_POST['price'];
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
header('Location: http://localhost:90/project-bogdan/adminPage.php');
?>