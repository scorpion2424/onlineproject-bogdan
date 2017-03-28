<?php
include 'connection.php';
if (( ! isset($_POST['user']))&&  ( ! isset($_POST['pass'])))
{
    header('Location: http://localhost:90/project-bogdan/index.php');
}
elseif (( $_POST['user']!="admin")  &&  ($_POST['pass']!="admin"))
{
    header('Location: http://localhost:90/project-bogdan/index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Online Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<?php
function listProducts($conn) {

$sql = 'SELECT Image, Name,  Description, Price  FROM products';
foreach ($conn->query($sql) as $row) {
?>
<tr>
    <td>  <img class ="productImage" src="<?php print strip_tags($row['Image']); ?>"  </td>
    <td> <?php print strip_tags($row['Name']) ?> </td>
    <td> <?php print strip_tags($row['Description']) ?> </td>
    <td> <?php print strip_tags($row['Price']) ?> </td>
    <td> <button>Edit</button></td>
    <td> <button>Delete</button></td>
    <td> <button>Add to cart</button></td>
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
    <th>Delete</th>
    <th>Buy</th>

</tr>
<?php listProducts($conn); ?>
</table>
</html>