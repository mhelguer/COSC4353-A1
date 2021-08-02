<?php
// Initialize the session
session_start();

//--------------------------------------------------------------------------------------------------
// Add RegisterTwo class
require_once __DIR__ . "/../config/classes.php"; 

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["acc_type"] == 0 ){
    $reg2 = new RegisterTwo($_POST["Name"], $_POST["Add1"], $_POST["Add2"], $_POST["City"], $_POST["State"], $_POST["Zip"] );
    $switch = "disabled";
}

if($_SESSION["acc_type"] == 1 && !empty($_POST["Gallons"]) && !empty($_POST["Date"]) ){
    $switch = "";
}else{
    $switch = "disabled";
}

$form = new FuelForm($_POST["Gallons"], $_POST["Date"], 1 );

if($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION["acc_type"] == 1){


    if(isset($_POST["Place_Order"]) ){
        $form = new FuelForm($_POST["Gallons"], $_POST["Date"], 2 );
    }
    unset($_POST["Calculate"]);
    unset($_POST["Place_Order"]);
    
}

//--------------------------------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html> 
    <!--Include Files-->
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>
    
    <?php if($_SESSION["acc_type"] == 0): ?>

        <div class="container center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">
              <!--Header Text-->
                <nav class="brand">
                    <h4 class="center"><b>Customer Account</b></h4>
                </nav>
                <p class="center">Please fill this form out to finish creating the account.</p>

                
                <?php if(!empty($reg2->register_err)  ): ?>
                    <span style="color: red;"><?php echo $reg2->register_err;  ?></span>
                <?php endif ?>
            
                <div class="input-field left-align">
                    <span class="red-text"><?php echo $reg2->name_err; ?></span>
                    <input type="text" name="Name" value="<?php echo $_POST["Name"]; ?>" placeholder="Name" id="input_text" data-length="50" maxlength="50">
                </div>

                <div class="input-field left-align">
                    <span class="red-text"> <?php echo $reg2->add1_err; ?></span>
                    <input type="text" name="Add1" value="<?php echo $_POST["Add1"]; ?>" placeholder="Address 1" id="input_text" data-length="100" maxlength="100"> 
                </div>

                <div class="input-field left-align">
                    <span class="red-text"> <?php echo $reg2->add2_err; ?></span>
                    <input type="text" name="Add2" value="<?php echo $_POST["Add2"]; ?>" placeholder="Address 2 (optional)" id="input_text" data-length="100" maxlength="100"> 
                </div>
                
                <div class="input-field left-align">
                    <span class="red-text"> <?php echo $reg2->city_err; ?></span>
                    <input type="text" name="City" value="<?php echo $_POST["City"]; ?>" placeholder="City" id="input_text" data-length="100" maxlength="100"> 
                </div>

                <div class="input-field left-align">
                    <span class="red-text"> <?php echo $reg2->state_err; ?></span>
                    <input type="text" name="State" list="statename" value="<?php echo $_POST["State"]; ?>" placeholder="State">
                    <datalist id="statename">
                        <option value="AL">Alabama</option>
                        <option value="AK">Alaska</option>
                        <option value="AZ">Arizona</option>
                        <option value="AR">Arkansas</option>
                        <option value="CA">California</option>
                        <option value="CO">Colorado</option>
                        <option value="CT">Connecticut</option>
                        <option value="DE">Delaware</option>
                        <option value="DC">District of Columbia</option>
                        <option value="FL">Florida</option>
                        <option value="GA">Georgia</option>
                        <option value="HI">Hawaii</option>
                        <option value="ID">Idaho</option>
                        <option value="IL">Illinois</option>
                        <option value="IN">Indiana</option>
                        <option value="IA">Iowa</option>
                        <option value="KS">Kansas</option>
                        <option value="KY">Kentucky</option>
                        <option value="LA">Louisiana</option>
                        <option value="ME">Maine</option>
                        <option value="MD">Maryland</option>
                        <option value="MA">Massachusetts</option>
                        <option value="MI">Michigan</option>
                        <option value="MN">Minnesota</option>
                        <option value="MS">Mississippi</option>
                        <option value="MO">Missouri</option>
                        <option value="MT">Montana</option>
                        <option value="NE">Nebraska</option>
                        <option value="NV">Nevada</option>
                        <option value="NH">New Hampshire</option>
                        <option value="NJ">New Jersey</option>
                        <option value="NM">New Mexico</option>
                        <option value="NY">New York</option>
                        <option value="NC">North Carolina</option>
                        <option value="ND">North Dakota</option>
                        <option value="OH">Ohio</option>
                        <option value="OK">Oklahoma</option>
                        <option value="OR">Oregon</option>
                        <option value="PA">Pennsylvania</option>
                        <option value="RI">Rhode Island</option>
                        <option value="SC">South Carolina</option>
                        <option value="SD">South Dakota</option>
                        <option value="TN">Tennessee</option>
                        <option value="TX">Texas</option>
                        <option value="UT">Utah</option>
                        <option value="VT">Vermont</option>
                        <option value="VA">Virginia</option>
                        <option value="WA">Washington</option>
                        <option value="WV">West Virginia</option>
                        <option value="WI">Wisconsin</option>
                        <option value="WY">Wyoming</option>
                    </datalist>               
                </div>
                
                 <div class="input-field left-align">
                    <span class="red-text"> <?php echo $reg2->zip_err; ?></span>
                    <input id="input_text" type="text" name="Zip" value="<?php echo $_POST["Zip"]; ?>" placeholder="Zipcode" data-length="10" maxlength="10"> 
                </div>

                            
                <div class="container">
                    <input name="Reg2" type="submit" class="btn brand" value="Complete Account">     
                </div>


            </form>
        </div>

    <?php else: ?>
    <div class="container center">

    <!-- Input Fuel Form -->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">

        <!--Header Text-->
        <nav class="brand">
            <h4 class="center"><b>Place an Order</b></h4>
        </nav>
        <p class="center">Please fill in the order details.</p>

        <!--Success Text-->
        <?php if(!empty($form->success) ): ?>
            <span style="color: green;"><?php echo $form->success;  ?></span>
        <?php endif ?>

        <!--Fail Text-->
        <?php if(!empty($form->submission_err) ): ?>
            <span style="color: red;"><?php echo $form->submission_err;  ?></span>
        <?php endif ?>

        <!-- Input Field: Gallons Requested-->
        <div class="input-field left-align">
            <span class="red-text"><?php echo $gallons_err; ?></span>
            <input type="number" step="any"  min="1" name="Gallons" value="<?php echo $_POST["Gallons"]; ?>" placeholder="Gallons Requested" id="input_text" data-length="10" maxlength="10">
        </div>

        <!--Readonly Field: Delivery Address-->
        <div class="input-field left-align">
            <span class="red-text"><?php echo $address_err; ?></span>
            <input type="text" name="Add1" value="<?php echo $_SESSION["address1"]; ?>" placeholder="Address 1" readonly>
            <input type="text" name="Add2" value="<?php echo $_SESSION["address2"]; ?>" placeholder="Address 2" readonly>
        </div>

        <!--Input Field: Delivery Date-->
        <div class="input-field left-align">
            <label>Delivery Date (yyyy-mm-dd)</label>
            <span class="red-text"><?php echo $date_err; ?></span>
            <input id="input_text" type="text" name="Date" class="datepicker2" value="<?php echo $_POST["Date"]; ?>">
        </div>

        <!--Readonly Field: Suggested Price/Gallon-->
        <div class="input-field left-align">
            <label>Suggested Price/Gallon</label>
            <input type="number" step="any"  min="1" value="<?php echo $form->costpergal; ?>" readonly>
        </div> 

        <!--Readonly Field: Total Price-->
        <div class="input-field left-align">
            <label>Total Price</label>
            <input type="number" step="any"  min="1" value="<?php echo $form->total; ?>" readonly>
        </div>

        <!--Calculate Button -->
        <div class="container center">
            <input type="submit" class="btn brand" name="Calculate" value="Calculate">
        </div>

        <br>

        <!--Place Order -->
        <div class="container center">
            <input type="submit" class="btn brand <?php echo $switch; ?>" name="Place_Order"  value="Place Order">
        </div>

    </form>
    </div>

    <?php endif ?>


    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>