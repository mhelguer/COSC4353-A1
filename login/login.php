<?php

// Redirect if already logged in
if(isset($_SESSION["loggedin"]) ){
    header("location: ../Index.php");
    exit;
}

// Add Login class
require_once __DIR__ . "/../config/classes.php"; 

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $log = new Login($_POST["User"], $_POST["Pass"]);
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
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white z-depth-2" id="login_form">

            <!--Header Text-->
            <nav class="brand">
                <h4 class="center"><b>Login</b></h4>
            </nav>
            <p class="center">Please fill in your credentials to login.</p>

            <!--Error Text-->
            <?php if(!empty($log->login_err)): ?>
                <span style="color: red;"><?php echo $log->login_err;  ?></span>
            <?php endif ?>

            <!--Form Text-->
            <div class="input-field left-align">
                <span class="red-text"><?php echo $log->user_err; ?></span><!--Error Text-->
                <input type="text" name="User" value="<?php echo $_POST["User"]; ?>" placeholder="Username" id="input_text" data-length="45" maxlength="45">
            </div>    

            <div class="input-field left-align">
                <span class="red-text"><?php echo $log->pass_err; ?></span><!--Error Text-->
                <input type="password" name="Pass" value="<?php echo $_POST["Pass"]; ?>" placeholder="Password" id="input_text" data-length="45" maxlength="45">
            </div>

            <div class="container">
                <input type="submit" class="btn brand" value="Log in">
            </div>

            <p>Don't have an account? <a href="cregister.php">Sign up now</a> </p>
        </form>


    </div>
    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>