<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';
?>
    <title>Online Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<?php
function listProducts($conn) {

$sql = 'SELECT ID,Image, Name,  Description, Price  FROM products';
foreach ($conn->query($sql) as $row) {
?>
<tr>
    <td>  <img class ="productImage" src="<?php print strip_tags($row['Image']); ?>"  </td>
    <td> <?php print strip_tags($row['Name']) ?> </td>
    <td> <?php print strip_tags($row['Description']) ?> </td>
    <td> <?php print strip_tags($row['Price']) ?> </td>
    <td> <a href="http://localhost:90/project-bogdan/editProduct.php?product=<?php echo strip_tags($row['ID']);?> ">Edit</a></td>
    <td> <a href="http://localhost:90/project-bogdan/deleteDone.php?product=<?php echo htmlentities($row['ID']);?> ">Delete</a></td>
    <td> <a href="http://localhost:90/project-bogdan/orderList.php?product=<?php echo strip_tags($row['ID']);?> ">Add to cart</a></td>
</tr>
<?php
}
}
?>
    <div id="addProductButton"><a href="http://localhost:90/project-bogdan/addProduct.php"><span>Add a product</span></a></div>
    </br>
<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Edit</th>
    <th>Delete</th>
    <th>Buy</th>

</tr>
<?php listProducts($conn); ?>
</table>
<?php
include 'footer.php';

?>