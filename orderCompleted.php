<!DOCTYPE html>
<html>
<body>
<div id="wrapper">
    <?php
    include 'connection.php';
    include 'header.php';
    ?>
    <div id="content">
 */ <?php
        function listProducts($conn)
        {

            if(isset($_SESSION['userCommand']) && count($_SESSION['userCommand'])>0){
                $productsNumber=count($_SESSION['userCommand']);
                ?>
                <table>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                </tr>
                <?php
            }
            else
                $productsNumber=0;
            $i=0;

            while ($productsNumber > 0) {
                $productID = $_SESSION['userCommand'][$i];
                $sql = "SELECT ID, Image, Name,  Description, Price  FROM products WHERE ID='$productID'";
                foreach ($conn->query($sql) as $row) {

                    ?>

                    <tr>
                        <td><img class="productImage" src="<?php print strip_tags($row['Image']); ?>"</td>
                        <td> <?php print strip_tags($row['Name']) ?> </td>
                        <td> <?php print strip_tags($row['Description']) ?> </td>
                        <td> <?php print strip_tags($row['Price']) ?> </td>
                    </tr>
                    <?php
                }
                $i++;
                $productsNumber--;
            }
            if($productsNumber<1){?>
                </table>
            <?php }
        }



















        session_unset();
    ?>
        <p>In short time you will receive an email about your order.Thank you for chosing us!</p>
        <a href="http://localhost:90/project-bogdan/index.php">Return to main page.</a>
    </div>

    <?php    include 'footer.php'; ?>
</div>
</body>
</html>
