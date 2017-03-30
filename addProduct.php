<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';
?>

<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Edit</th>
    </tr>
    <form id="editDetails" method="post" action="http://localhost:90/project-bogdan/addProductDone.php">
        <tr>
            <td>  <img class ="productImage" src="<?php print htmlentities("smartphone.jpg"); ?>"  </td>
            <td><input type="text" name="productName" placeholder="name..."><br></td>
            <td><input type="text" name="description" placeholder="description..."><br></td>
            <td><input type="text" name="price" placeholder="description..."><br></td>
            <td> <button  type="submit">Submit changes</button></td>

    </form>
    </tr>
</table>
