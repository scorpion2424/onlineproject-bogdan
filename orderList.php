<!DOCTYPE html>
<html>
<body>
<div id="wrapper">
<?php
include 'connection.php';
include 'header.php';
$order=array();
if(isset($_SESSION['userCommand'])) {
    foreach ($_SESSION['userCommand'] as $val) {

        array_push($order, $val);
    }
}
if(isset($_GET['product'])) {
    array_push($order, $_GET['product']);
    $_SESSION['userCommand'] = $order;
}
/*print_r($_SESSION['userCommand']);
foreach($_SESSION['userCommand'] as $val)
{

    echo $val.'<br>';
}*/
function listProducts($conn)
{

    if(isset($_SESSION['userCommand'])){
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
?>

<div id="content">

            <div id="shopFromUs"><span>Your cart</span>
                <span clas="processOrder"><a href="http://localhost:90/project-bogdan/FinalizeOrder.php">Process the order:</a></span>
            </div>

                <?php
            listProducts($conn);
                ?>

</div>
    <div class="freeSpace"></div>

<?php
include 'footer.php';

?>
</div>
</body>
</html>