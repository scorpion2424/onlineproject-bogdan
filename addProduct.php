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
            <?php
            $inputIsCorrect = false;
            if (isset($_POST['submit'])) { //check if form was submitted
                if (strlen(trim(strip_tags($_POST['productName']))) > 0 &&
                    strlen(trim(strip_tags($_POST['description']))) > 0 &&
                    is_numeric($_POST['price'])
                ) {
                    $inputIsCorrect = true;
                }
            }
            ?>
            <form class="editDetails" method="post" action="http://localhost:90/project-bogdan/addProductDone.php"
                  enctype="multipart/form-data">

                <tr>

                    <td><input type="file" name="image" id="fileToUpload"></td>
                    <td><input type="text" name="productName" placeholder="name..."><br></td>
                    <td><input type="text" name="description" placeholder="description..."><br></td>
                    <td><input type="text" name="price" placeholder="price..."><br></td>
                    <td>
                        <button type="submit" name="submit">Submit changes</button>
                    </td>

            </form>
            </tr>
        </table>
        <?php if (isset($_POST['submit'])) {
        if ($inputIsCorrect == false) {
            ?>
            <div class="insertErrorMessage">
                <span>Your product was NOT inserted into the database. </span><br/>
                <span>The following problems have occurred:</span><br/>
                <?php if (strlen(trim(strip_tags($_POST['productName']))) === 0) {
                    echo 'Product name is invalid.<br/>';
                } ?>
                <?php if (strlen(trim(strip_tags($_POST['description']))) === 0) {
                    echo 'Description is invalid.<br/>';
                } ?>
                <?php if (!is_numeric($_POST['price'])) {
                    echo 'Price is invalid.<br/>';
                } ?>
            </div>
        <?php }
    }
    }

    function editProduct($conn)
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
            <?php
             $inputIsCorrect=false;
            if(isset($_POST['submit'])) { //check if form was submitted
                if (strlen(trim(strip_tags($_POST['productName']))) > 0 &&
                    strlen(trim(strip_tags($_POST['description']))) > 0 &&
                    is_numeric($_POST['price'])) {
                    $inputIsCorrect = true;
                }
            }
                $productID = strip_tags($_GET['product']);
                $sql = "SELECT ID, Image, Name,  Description, Price  FROM products WHERE ID='$productID'";
                foreach ($conn->query($sql) as $row) {
                    ?>
                    <form id="editDetails" method="post"
                          action="<?php if($inputIsCorrect===true){echo "http://localhost:90/project-bogdan/addProductDone.php?product=$productID";} ?> " enctype="multipart/form-data">
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
        <?php if(isset($_POST['submit']))
        {
            if($inputIsCorrect===false) {
                ?>
                <div class="insertErrorMessage">
                    <span>Your product was NOT inserted into the database. </span><br/>
                    <span>The following problems have occurred:</span><br/>
                    <?php if(strlen(trim(strip_tags($_POST['productName']))) === 0) {echo 'Product name is invalid.<br/>';}?>
                    <?php if(strlen(trim(strip_tags($_POST['description']))) === 0) {echo 'Description is invalid.<br/>';}?>
                    <?php if(!is_numeric($_POST['price'])) {echo 'Price is invalid.<br/>';}?>
                </div>
            <?php }
        }
    }


    if(isset($_GET['product'])) {
        editProduct($conn);
    }
    elseif(!isset($_GET['product'])){
        addProduct($conn);
    }
include 'footer.php';
?>
