<?php
include 'connection.php';
include 'header.php';
?>
<div id="wrapper">
    <div id="content">
        <div id="userInformationsTitle">Please complete your informations:</div>
        <div id="userDetails">
    <form method="post" action="http://localhost:90/project-bogdan/orderCompleted.php" >
        First Name: <input type="text" name="firstName" placeholder="First Name..."><br>
        Last Name: <input type="text" name="lastName" placeholder="Last Name..."><br>
        Email: <input type="text" name="email" placeholder="name@someone.com"><br>
        <input type="submit" value="Send the order">
    </form>
        </div>
    </div>

<?php    include 'footer.php'; ?>
    </div>