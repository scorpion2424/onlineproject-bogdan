<!DOCTYPE html>
<html>
<?php
include 'connection.php';
include 'header.php';
$_SESSION['product'] = 'phone';
?>
<head>
    <title>Online Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<div id="content">
<body>
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
<div id="shopFromUs"><span>Shop from us!</span></div>
<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th>Buy</th>
</tr>
<?php listProducts($conn); ?>
</table>
</div>
<script>
    $(document).ready(function(){
        $("#adminLoginButton").click(function(){
            $("#loginData").show();
            $("#adminLoginButton").hide();
        });
    });
   function checkscript() {
        var  username = document.forms["loginData"]["user"].value;
        var  password = document.forms["loginData"]["pass"].value;
        if (username!=="admin" && password!=="admin") {
            $("#loginError").show();
            return false;
        }

        return true;
    }
</script>
</body>
<?php
include 'footer.php';

?>
</html>