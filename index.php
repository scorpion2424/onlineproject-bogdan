<!DOCTYPE html>
<html>
<?php
include 'connection.php';
echo '<br/>';
$_SESSION['product'] = 'phone';
?>
<head>
    <title>Online Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<div id="wrapper">
<body>

<div id="login">
<button id="adminLoginButton">Login</button>
    <input type="text" name="name" id="txt_name" size="30" maxlength="70">

    <div id="loginData">
    <form  method="post">
        Username: <input type="username" name="user"><br>
        Password: <input type="password" name="pass"><br>
    </form>
        <button id="submitButton">Login </button>
    </div>
</div>
<div id="test">
    <p>ff</p>
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
    <th>Buy</th>
</tr>
<?php listProducts($conn); ?>
</table>
</div>
<script>
    $(document).ready(function(){
        $("#adminLoginButton").click(function(){
            $("#loginData").show();
        });
    });

    $(document).ready(function(){
        $("#submitButton").click(function(){
            name = oForm.elements["name"].value;
            $('#test').html('Hello World!');
        });
    });
</script>
</body>

</html>