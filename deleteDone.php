<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';

try {
    $stmt = $conn->prepare("DELETE  FROM `products`  WHERE `ID` = :productID ");
//echo $_GET['product'],$_POST['productName'],$_POST['description'],$_POST['price'];
    $stmt->bindParam(':productID', strip_tags($_GET['product']));
    $stmt->execute();
    // echo "Product updated";
}
catch(PDOException $e)
{
    echo "Error: " . $e->getMessage();
}
 header('Location: http://localhost:90/project-bogdan/adminPage.php');
?>