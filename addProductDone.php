<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';

try {
    $stmt = $conn->prepare("INSERT INTO `products`(Image,Name,Description,Price)  VALUES (:productImage, :productName, :productDescription, :productPrice) ");

   // echo $_POST['productName'],$_POST['description'],$_POST['price'];
    $productImage='smartphone.jpg';
    $stmt->bindParam(':productImage', strip_tags($productImage));
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