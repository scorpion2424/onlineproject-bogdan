<?php
include 'connection.php';
include 'header.php';
//session_unset();

?>
<div id="wrapper">
    <div id="content">

<?php
/*
@listProducts
This function will display all the products from the database.
@products is the table where all the products's informations are kept.
Every product has in the database 5 rows:
    -ID(which is unique for every product)
    -Image
    -Name
    -Description
    -Price
 */
function listProducts($conn) {

    $sql = 'SELECT ID, Image, Name,  Description, Price  FROM products';
    foreach ($conn->query($sql) as $row) {
        ?>

        <tr>

            <td>
                <img class ="productImage" src="images/<?= htmlentities($row['Image']); ?>"/>
            </td>

            <td>
                <?= htmlentities($row['Name']) ?>
            </td>

            <td>
                <?= htmlentities($row['Description']) ?>
            </td>

            <td>
                <?= htmlentities($row['Price']) ?>
            </td>

           <td>
               <a href="http://localhost:90/project-bogdan/orderList.php?product=<?= htmlentities($row['ID']);?> ">
                   Add to cart
               </a>
           </td>

        </tr>
        <?php
    }
}
?>

        <table>
            <tr>
                <th>
                    Image
                </th>

                <th>
                    Name
                </th>

                <th>
                    Description
                </th>

                <th>
                    Price
                </th>

                <th>
                    Buy
                </th>

            </tr>
            <?php listProducts($conn); ?>
        </table>
    </div>
    <?php
    include 'footer.php';
    ?>
</div>