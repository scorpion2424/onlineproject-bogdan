<?php
include 'connection.php';

if (( isset($_POST['user'])) && ($_POST['user'])=='admin' && ( isset($_POST['pass'])) && ($_POST['pass'])=='admin')
{
    $_SESSION['user']=$_POST['user'];

}
include 'checkLogin.php';

include 'header.php';
?>
<?php
function listProducts($conn) {

$sql = 'SELECT ID,Image, Name,  Description, Price  FROM products';
foreach ($conn->query($sql) as $row) {
            ?>
            <tr>
                <td>  <img class ="productImage" src="images/<?php print htmlentities($row['Image']); ?>"  </td>
                <td> <?php print htmlentities($row['Name']) ?>        </td>
                <td> <?php print htmlentities($row['Description']) ?> </td>
                <td> <?php print htmlentities($row['Price']) ?>       </td>
                <td> <a href="http://localhost:90/project-bogdan/addProduct.php?product=<?php echo htmlentities($row['ID']);?> ">Edit</a>      </td>
                <td> <a href="http://localhost:90/project-bogdan/deleteProduct.php?product=<?php echo htmlentities($row['ID']);?> ">Delete</a> </td>
                <td> <a href="http://localhost:90/project-bogdan/orderList.php?product=<?php echo htmlentities($row['ID']);?> ">Add to cart</a></td>
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