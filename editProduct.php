<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';
function listProducts($conn) {
$productID=$_GET['product'];
$sql = "SELECT ID, Image, Name,  Description, Price  FROM products WHERE ID='$productID'";
foreach ($conn->query($sql) as $row) {
?>
<form id="editDetails" method="post" action="http://localhost:90/project-bogdan/editProductDone.php?product=<?php echo htmlentities($row['ID']) ?>">
<tr>
    <td>  <img class ="productImage" src="<?php print htmlentities($row['Image']); ?>"  </td>
    <td><input type="text" name="productName" value="<?php echo htmlentities($row['Name'])?>"><br></td>
    <td><input type="text" name="description" value="<?php echo htmlentities($row['Description'])?>"><br></td>
    <td><input type="text" name="price" value="<?php echo htmlentities($row['Price'])?>"><br></td>
    <td> <button  type="submit">Submit changes</button></td>

</form>
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
    <th>Edit</th>
</tr>
    <?php
listProducts($conn);
    ?>
    </table>
