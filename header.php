<!DOCTYPE html>
<html>
<body>
<head>
    <title>Online Shop</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="theme.css">
</head>
<?php
if((isset($_SESSION['user'])) && ($_SESSION['user']==='admin')){
    ?>
    <div id="loginWrapper">
        <button id="adminLoginButton" onclick="window.location.href='http://localhost:90/project-bogdan/adminPage.php'">Admin's page</button>
        <button  onclick="window.location.href='http://localhost:90/project-bogdan/logout.php'">Logout</button>
    </div>
    <div class="freeSpace"></div>
<?php
        }
        else {
            ?>
            <div id="loginWrapper">
                <button id="adminLoginButton">Admin's login</button>
                <form id="loginData" method="post" action="http://localhost:90/project-bogdan/adminPage.php"">
                    Username: <input type="username" name="user" placeholder="your username..."><br>
                    Password: <input type="password" name="pass" placeholder="your password..."><br>
                    <button id="submitButton" type="submit">Login</button>
                </form>
                <div id="loginError">
                    <p>Your data is invalid.Please try again.</p>
                </div>
            </div>
            <div class="freeSpace"></div>
            <script>
                $(document).ready(function () {
                    $("#adminLoginButton").click(function () {
                        $("#loginData").show();
                        $("#adminLoginButton").hide();
                    });
                });
            </script>
            <?php
        } ?>
<div id="shopFromUs"><a href="http://localhost:90/project-bogdan/index.php"><span>Shop from us!</span></a></div>
        <div id="cart"><a href="http://localhost:90/project-bogdan/orderList.php">Check your cart:
                <br/><img src="cart.png"/></a>
        </div>