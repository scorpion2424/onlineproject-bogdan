

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
    <td> <button>Add to cart</button></td>
</tr>
<?php
    }
}
?>
