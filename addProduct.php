<?php
include 'connection.php';
include 'checkLogin.php';
include 'header.php';

function addProduct($conn)
{
    ?>
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Edit</th>
        </tr>
        <form id="editDetails" method="post" action="http://localhost:90/project-bogdan/addProductDone.php" enctype="multipart/form-data">
            <tr>

                <td><input type="file" name="image" id="fileToUpload"></td>
                <td><input type="text" name="productName" placeholder="name..."><br></td>
                <td><input type="text" name="description" placeholder="description..."><br></td>
                <td><input type="text" name="price" placeholder="price..."><br></td>
                <td> <button  type="submit" name="submit">Submit changes</button></td>

        </form>
        </tr>
    </table>
    <?php
}
    function editProduct($conn)
    {   ?>
<table>
    <tr>
        <th>Image</th>
        <th>Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Edit</th>
    </tr>
    <?php
        $productID = $_GET['product'];
        $sql = "SELECT ID, Image, Name,  Description, Price  FROM products WHERE ID='$productID'";
        foreach ($conn->query($sql) as $row) {
            ?>
            <form id="editDetails" method="post"
                  action="http://localhost:90/project-bogdan/addProductDone.php?product=<?php echo htmlentities($row['ID']) ?> " enctype="multipart/form-data">
                <tr>
                    <td><div class="productImageWrapper"><span class="addNewImage">Add a new image:<br><input type="file" name="image" id="fileToUpload"></span><img class="productImage" src="images/<?php print htmlentities($row['Image']); ?>"</div></td>
                    <td><input type="text" name="productName" value="<?php echo htmlentities($row['Name']) ?>"><br></td>
                    <td><input type="text" name="description"
                               value="<?php echo htmlentities($row['Description']) ?>"><br></td>
                    <td><input type="text" name="price" value="<?php echo htmlentities($row['Price']) ?>"><br></td>
                    <td>
                        <button type="submit">Submit changes</button>
                    </td>

            </form>
            </tr>
            <?php
        }
        ?>
</table>
        <?php
    }

?>
    <?php
    if(isset($_GET['product'])) {
        editProduct($conn);
    }
    elseif(!isset($_GET['product'])){
        addProduct($conn);
    }

    ?>

