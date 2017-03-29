<!DOCTYPE html>
<html>
<body>
<?php

include 'connection.php';
include 'header.php';
//session_unset();
?>
<div id="wrapper">
    <div id="content">

<?php
function listProducts($conn) {

    $sql = 'SELECT ID, Image, Name,  Description, Price  FROM products';
    foreach ($conn->query($sql) as $row) {
        ?>

        <tr>
        <td>  <img class ="productImage" src="<?php print strip_tags($row['Image']); ?>"  </td>
        <td> <?php print strip_tags($row['Name']) ?> </td>
        <td> <?php print strip_tags($row['Description']) ?> </td>
        <td> <?php print strip_tags($row['Price']) ?> </td>
       <td> <a href="http://localhost:90/project-bogdan/orderList.php?product=<?php echo strip_tags($row['ID']);?> ">Add to cart</a></td>
        </tr>
        <?php
    }
}
?>
<div id="shopFromUs"><span>Shop from us!</span></div>
        <div id="cart"><a href="http://localhost:90/project-bogdan/orderList.php">Check your cart:
                <br/><img src="cart.png"/></a>
        </div>
<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Buy</th>
</tr>
<?php listProducts($conn); ?>
</table>
</div>


</body>
<?php
include 'footer.php';
?>
</div>
</html>