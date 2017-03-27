<!DOCTYPE html>
<?php
include 'connection.php';
echo '<br/>';
function listProducts($conn) {
    $sql = 'SELECT Name, Price, Description FROM products';
    foreach ($conn->query($sql) as $row) {
        print $row['Name'] . "\t";
        print $row['Price'] . "\t";
        print $row['Description'] . "\n";
    }
}
listProducts($conn);
?>
<html>
<head>
    <title>Online Shop</title>
</head>
<body>
</body>

</html>