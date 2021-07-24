<?php

// Initialize the session
session_start();

// Redirect if already not logged in
if(!isset($_SESSION["loggedin"]) ){
    header("location: ../Index.php");
    exit;
}
// Add Fuel History class
require_once __DIR__ . "/../config/classes.php"; 

    $hist = new FuelHistory();

?>

<!DOCTYPE html>
<html> 
    <!--Include Files-->
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

    <?php if($_SESSION["acc_type"] == 1): ?>

            <!---- Header------>
            <br>
            <div class="center container brand white-text z-depth-1">
                <p style="display: inline;"><?php echo $_SESSION["username"]. "'s Order History"; ?></p>
            </div>

            <div class="center container white">
            <table class="highlight">
                <th>Gallons Requested</th>
                <th>Delivery Address</th>
                <th>Delivery Date</th>
                <th>Price Per Gallon</th>
                <th>Total Cost</th>
                <?php foreach ($hist->rows as $row): ?>
                <tr>
                    <td><?php echo $row["gallons"]; ?></td>
                    <td><?php echo $row["delivery_address"]; ?></td>
                    <td><?php echo $row["delivery_date"]; ?></td>
                    <td><?php echo '$'. number_format($row["pricepergal"], 2); ?></td>
                    <td><?php echo '$'. number_format($row["total_due"], 2); ?></td>
                </tr>                   
                <?php endforeach ?>
            </table>
            </div>

    <?php endif ?>


    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>