<?php

// Redirect if already logged in
if(isset($_SESSION["loggedin"]) ){
    header("location: ../Index.php");
    exit;
}

// Add Register class
require_once __DIR__ . "/../config/classes.php"; 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $reg = new Register($_POST["User"], $_POST["Pass"]);
}

//--------------------------------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html>

    <!--Include Files-->
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

    <div class="container center">

        <!--Input Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">

            <!--Header Text-->
            <nav class="brand">
                <h4 class="center"><b>Client Account</b></h4>
            </nav>
            <p class="center">Please fill this form out to create an account.</p>

            <!--Error Text-->
            <?php if(!empty($reg->register_err) ): ?>
                <span style="color: red;"><?php echo $reg->register_err; ?></span>
            <?php endif ?>
        
            <!--Form Text-->
            <div class="input-field left-align">
                <span class="red-text"><?php echo $reg->user_err; ?></span>
                <input type="text" name="User" value="<?php echo $_POST["User"]; ?>" placeholder="Username" id="input_text" data-length="45" maxlength="45">
            </div>

            <div class="input-field left-align">
                <span class="red-text"><?php echo $reg->pass_err; ?></span>
                <input type="password" name="Pass" value="<?php echo $_POST["Pass"]; ?>" placeholder="Password" id="input_text" data-length="45" maxlength="45"> 
            </div>
            
            <div class="container">
                <label style="color: grey; font-size: 20px;"><?php echo $reg->success;  ?></label><br>
                <input type="submit" class="btn brand" value="Create Account">
            </div>
            
            <p>Already have an account? <a href="login.php">Log in now</a> </p>
      </form>
    </div>


    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>