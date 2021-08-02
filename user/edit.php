<?php

// Initialize the session
session_start();

// Redirect if not logged in
if(!isset($_SESSION["loggedin"]) ){
    header("location: ../Index.php");
    exit;
}
// Add Edit class
require_once __DIR__ . "/../config/classes.php"; 

$details = new Edit();
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Save"]) ){

    $details->EditAccount($_POST["Pass"], $_POST["Name"], $_POST["Add1"], $_POST["Add2"], $_POST["City"], $_POST["State"], $_POST["Zip"] );
    $details->ShowAccount();
    unset($_POST["Save"]);
}

?>

<!DOCTYPE html>
<html> 
    <!--Include Files-->
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

    <?php if($_SESSION["acc_type"] == 1): ?>

        <div class="container center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">

              <!--Header Text-->
                <nav class="brand">
                    <h4 class="center"><b>Edit Account</b></h4>
                </nav>
                <p class="center">Edit any details shown below.</p>


                <?php if(!empty($details->success)  ): ?>
                    <span style="color: green;"><?php echo $details->success;  ?></span>
                <?php endif ?>

                <?php if(!empty($details->register_err)  ): ?>
                    <span style="color: red;"><?php echo $details->register_err;  ?></span>
                <?php endif ?>

                <div class="input-field left-align">
                    <label>Password</label>
                    <span class="red-text"><?php echo $details->pass_err; ?></span>
                    <input type="password" name="Pass" value="" placeholder="Password" id="input_text" data-length="45" maxlength="45"> 
                </div>

                <div class="input-field left-align">
                    <label>Full Name</label>
                    <span class="red-text"><?php echo $details->name_err; ?></span>
                    <input type="text" name="Name" value="<?php echo $details->row["fullname"]; ?>" placeholder="Name" id="input_text" data-length="50" maxlength="50">
                </div>

                <div class="input-field left-align">
                    <label>Address 1</label>
                    <span class="red-text"> <?php echo $details->add1_err; ?></span>
                    <input type="text" name="Add1" value="<?php echo $details->row["address1"]; ?>" placeholder="Address 1" id="input_text" data-length="100" maxlength="100"> 
                </div>

                <div class="input-field left-align">
                    <label>Address 2</label>
                    <span class="red-text"> <?php echo $details->add2_err; ?></span>
                    <input type="text" name="Add2" value="<?php echo $details->row["address2"]; ?>" placeholder="Address 2 (optional)" id="input_text" data-length="100" maxlength="100"> 
                </div>
                
                <div class="input-field left-align">
                    <label>City</label>
                    <span class="red-text"> <?php echo $details->city_err; ?></span>
                    <input type="text" name="City" value="<?php echo $details->row["city"]; ?>" placeholder="City" id="input_text" data-length="100" maxlength="100"> 
                </div>
                
                <div class="input-field left-align">
                    <label>State</label>
                    <span class="red-text"> <?php echo $details->state_err; ?></span>
                    <input type="text" name="State" list="statename" value="<?php echo $details->row["state"]; ?>" placeholder="State">
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
                    <label>Zipcode / Postal Code</label>
                    <span class="red-text"> <?php echo $details->zip_err; ?></span>
                    <input id="input_text" type="text" name="Zip" value="<?php echo $details->row["zipcode"]; ?>" placeholder="Zipcode" data-length="10" maxlength="10"> 
                </div>

                            
                <div class="container">
                    <input name="Save" type="submit" class="btn brand" value="Save Changes">     
                </div>


            </form>
        </div>

    <?php endif ?>


    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>