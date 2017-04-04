<div id="wrapper">
    <?php
    include 'connection.php';
    include 'header.php';
    ?>
    <div id="content">
        <?php
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
                        <td><img class="productImage" src="images/<?php print strip_tags($row['Image']); ?>"</td>
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

        function insertProductsInEmail($conn){
            $email_order=array();
            $totalPriceProducts=0;
            array_push($email_order,'Hello Mr./Ms. ',strip_tags($_POST['firstName']),' ',strip_tags($_POST['lastName']),',','<br/>');
            array_push($email_order,
                '<table>
            <tr>
                <th>Name</th>
                <th>Price</th>
            </tr>');
        if(isset($_SESSION['userCommand']) && count($_SESSION['userCommand'])>0){
        $productsNumber=count($_SESSION['userCommand']);
            }
            else
                $productsNumber=0;
            $i=0;
            while ($productsNumber > 0) {
                $productID = $_SESSION['userCommand'][$i];
                $sql = "SELECT ID, Name,  Price  FROM products WHERE ID='$productID'";
                foreach ($conn->query($sql) as $row) {

                    array_push($email_order,'<tr>');
                    array_push($email_order,'<td>');  array_push($email_order, htmlentities($row['Name'])); array_push($email_order,'</td>');
                    array_push($email_order,'<td>'); array_push($email_order, htmlentities($row['Price'])); array_push($email_order,'</td>');
                    array_push($email_order,'</tr>');
                    $totalPriceProducts+= htmlentities($row['Price']);

                }
                $i++;
                $productsNumber--;
            }
            array_push($email_order,'</table>');
            array_push($email_order,'<style> table{
             margin:0 auto;
            border-collapse: collapse;
            text-align: center;
            font-family: Charcoal,sans-serif;
            font-size: 1em;
           }
        table a{
            text-decoration: none;
           }
        table, th, td {
            border: 1px solid black;
          }
        </style>');
            array_push($email_order,'<br/>', 'Total price: <b>',$totalPriceProducts, '</b>');
            $email_order=implode($email_order);
            return $email_order;

    }

        function sendEmail($conn)
        {

            $email = $_REQUEST['email'];
            $message = '';

            require("PHPMailer/PHPMailerAutoload.php");
            $mail = new PHPMailer();

            $mail->IsSMTP();
            //$mail->SMTPDebug = 1;
            $mail->Host = "smtp.gmail.com";

            $mail->SMTPAuth = true;
            $mail->Port = 465;
            $mail->SMTPSecure = 'ssl';
            $mail->Username = "twsallo2016@gmail.com";
            $mail->Password = "proiecttw2016";

            $mail->From = $email;

            $mail->AddAddress(strip_tags($_POST['email']));

            $mail->IsHTML(true);

            $mail->Subject = "Your order:";
            $mail->Body = insertProductsInEmail($conn);
            $mail->AltBody = $message;

            if (!$mail->Send()) {
                echo "<p>Message could not be sent.";
                echo "Mailer Error: " . $mail->ErrorInfo;
                exit;
            }

        echo "<p>Message has been sent.You will receive in short time an email about your order.Thank you for choosing us!</p>";

        }

        listProducts($conn);
        insertProductsInEmail($conn);
        sendEmail($conn);
        session_unset();
    ?>
        <a href="http://localhost:90/project-bogdan/index.php">Return to main page.</a>

    <?php    include 'footer.php'; ?>
</div>
