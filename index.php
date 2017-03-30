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
        <td>  <img class ="productImage" src="<?php print htmlentities($row['Image']); ?>"  </td>
        <td> <?php print htmlentities($row['Name']) ?> </td>
        <td> <?php print htmlentities($row['Description']) ?> </td>
        <td> <?php print htmlentities($row['Price']) ?> </td>
       <td> <a href="http://localhost:90/project-bogdan/orderList.php?product=<?php echo htmlentities($row['ID']);?> ">Add to cart</a></td>
        </tr>
        <?php
    }
}
?>

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