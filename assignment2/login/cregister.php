<?php
/* NOT YET:
// Initialize the session
session_start();

// Redirect if already logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: ../Index.php");
    exit;
}

// Include db_connect file and other files
require __DIR__ . "/../config/db_connect.php";
require __DIR__ . "/../functions/already_user.php";
*/
$User_err = $Pass_err = $Company_err = $Rname_err = $Remail_err = "";

//ADDED:
$User = "";
$Pass = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    //ADDED: original placeholder for username
    if(!empty(trim($_POST["User"]))){        
        $User = $_POST["User"];
    }

    // Check if Username is invalid
    if(empty(trim($_POST["User"]) ) || !preg_match("/^\w{2,45}$/", trim($_POST["User"]) ) ){
        $User_err = "Please enter a valid Username.";
    } 
    /*NOT YET: elseif(alreadyUser(trim($_POST["User"]), "customer") ){
        $User_err = "Username already exists.";
    }*/
    else{        
        $User = trim($_POST["User"]);
    } 


    //ADDED: original placeholder for password
    if(!empty(trim($_POST["Pass"]))){        
        $Pass = $_POST["Pass"];
    }

    // Check if Password is invalid
    if(empty(trim($_POST["Pass"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["Pass"]) ) ){
        $Pass_err = "Please enter a valid Password.";
    } 
    else{
        $Pass = trim($_POST["Pass"]);
    }

    if(empty($User_err) && empty($Pass_err)){
        header('Location:../index.php');
    }

    /*NOT YET: unneeded on initial registration
     // Check if Bday is invalid
    if(empty(trim($_POST["Company"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["Company"]) ) ){
        $Company_err = "Please enter a valid Company Name.";
    } 
    else{
        $Company = trim($_POST["Company"]);
    }

     // Check if Username is invalid
    if(empty(trim($_POST["Rname"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["Rname"]) ) ){
        $Rname_err = "Please enter a valid Representative Name.";
    } 
    else{
        $Rname = trim($_POST["Rname"]);
    }
    // Check if Email is invalid
    if( empty(trim($_POST["Remail"]) ) || 
        !filter_var(trim($_POST["Remail"]), FILTER_VALIDATE_EMAIL) )
    {
        $Remail_err = "Please enter a valid Email.";
    } 
    else{
        $Remail = trim($_POST["Remail"]);
    }

    $err_total = $User_err . $Pass_err . $Company_err . $Rname_err . $Remail_err;

    // Validate
    if(empty($err_total) ){

        $sql = "INSERT INTO customer (C_username, C_password, Customer_name, Repname, RepEmail)
                VALUES ( ?, ?, ?, ?, ?)";

        if($stmt = mysqli_prepare($link, $sql) ){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssss", $User, $Pass, $Company, $Rname, $Remail);

        // Attempt to execute the prepared statement
        if(!mysqli_stmt_execute($stmt)){
          $submit_err = "Account Creation failed.";
        }else{
            $_SESSION["type"] = "customer";
            require_once __DIR__ . "/../functions/auto_login.php";
        }
      } 
      else{
        $submit_err = "Oops! Something went wrong. Please try again later.";
      }        
    }*/
}

// Close statement
//NOT YET: mysqli_stmt_close($stmt);
// Close connection
//NOT YET: mysqli_close($link);
//--------------------------------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html>

    <!--Include Files-->
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

    <section class="container center">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">
          <!--Header Text-->
            <nav class="brand">
                <h4 class="center"><b>Customer Account</b></h4>
            </nav>
            <p class="center">Please fill this form out to create the account.</p>

            
            <?php if(!empty($submit_err) || !empty($query_err) ): ?>
                <span style="color: red;"><?php echo $submit_err;  ?></span>
                <span style="color: red;"><?php echo $query_err;  ?></span>
            <?php endif ?>
        





            <div class="input-field left-align">
                <label>Username</label>
                <span class="red-text"><?php echo $User_err; ?></span>
                <input id="input_text" type="text" name="User" value="<?php echo $User; ?>" placeholder="<?php echo $User; ?>" data-length="45" maxlength="45">
            </div>

            <div class="input-field left-align">
                <label>Password</label>
                <span class="red-text"> <?php echo $Pass_err; ?></span>
                <input id="input_text" type="password" name="Pass" value="<?php echo $Pass; ?>" placeholder="<?php echo $Pass; ?>"data-length="45" maxlength="45"> 
            </div>

            <!-- NOT YET:
            <div class="input-field left-align">
                <label>Company Name</label>
                <span class="red-text"></span>
                <input id="input_text" type="text" name="Company" value="" placeholder="" data-length="45" maxlength="45">
            </div>

             <div class="input-field left-align">
                <label>Representative Name</label>
                <span class="red-text"></span>
                <input id="input_text" type="text" name="Rname" value="" placeholder="" data-length="45" maxlength="45">
            </div>

            <div class="input-field left-align">
                <label>Representative Email</label>
                <span class="red-text"></span>
                <input id="input_text" type="text" name="Remail" value="" placeholder="" data-length="45" maxlength="45">
            </div>
            -->
            
            <div class="container">
                <label style="color: grey;"><!--NOT YET: <?php echo $success;  ?> --></label><br>
                <input type="submit" class="btn brand waves-effect" value="Create Account">
                <!--NOT YET: a class="btn brand left-align" href="register.php">Employee?</a-->       
            </div>
      </form>
    </section>


    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>