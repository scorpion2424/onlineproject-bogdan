<!DOCTYPE html>
<html>
<?php
include 'connection.php';
echo '<br/>';
$_SESSION['product'] = 'phone';
?>
<head>
    <title>Online Shop</title>
<link rel="stylesheet" type="text/css" href="theme.css">
</head>
<div id="wrapper">
<body>
<div id="login">
<button id="adminLoginButton">Login</button>
    <div id="loginData">
    <form  action="/adminPage.php" method="post">
        Username: <input type="username" name="user"><br>
        Password: <input type="password" name="pass"><br>
        <input type="submit" value="Submit">
    </form>
    </div>
</div>
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
<table>
<tr>
    <th>Image</th>
    <th>Name</th>
    <th>Description</th>
    <th>Price</th>
    <th></th>
</tr>
<?php listProducts($conn); ?>
</table>
</div>
<!--<script>
$("adminLoginButton").click(function(){
$("#loginData").fadeIn();
</script>
});-->
</body>

</html>