<?php
// Initialize the session
//NOT YET: session_start();

// Redirect if already logged in
if(isset($_SESSION["loggedin"]) ){
    header("location: ../Index.php");
    exit;
}

/*NOT YET: 
// Include db_connect file
require_once __DIR__ . "/../config/db_connect.php";
require_once __DIR__ . "/../functions/check_man.php";
 */
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]) ) || !preg_match("/^\w{2,45}$/", trim($_POST["username"]) ) ){
        $username_err = "Please enter a valid Username.";
    } 
    else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["password"]) ) ){
        $password_err = "Please enter a valid Password.";
    } 
    else{
        $password = trim($_POST["password"]);
    }
    
    if(empty($username_err) && empty($password_err)){
        header('Location:../user_cust/view.php');
    }

    
    /* NOT YET:
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        if(isset($_POST["cust?"]) ){
            $sql = "SELECT C_username, C_password, Customer_name, customer_ID, Repname FROM customer WHERE C_username = ?";
        }
        else{
            $sql = "SELECT Username, Password, Fname, Emp_ID FROM employee WHERE Username = ?";
        }
        
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){  

                    if(isset($_POST["cust?"])){
                        mysqli_stmt_bind_result($stmt, $username, $pw, $name, $id, $r_name);  
                    }
                    else{
                        mysqli_stmt_bind_result($stmt, $username, $pw, $name, $id);  
                    }

                    if(mysqli_stmt_fetch($stmt)){

                        if($pw == $password){

                            // Password is correct, so start a new session
                            session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["username"] = $username;     
                            $_SESSION["id"] = $id;      

                            //Determine type of user           
                            if(isset($_POST["cust?"])){
                                $_SESSION["type"] = "customer"; 
                                $_SESSION["name"] = $r_name . ", representative of " . $name;
                            }
                            else{
                                $_SESSION["type"] = checkMan($link, $id) ? "manager" : "employee";
                                $_SESSION["name"] = $name;
                            } 
                            

                            // Redirect user to welcome page
                            header("location: ../Index.php");
                        }
                        else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                }
                else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } 
            else{
                $login_err = "Oops! Something went wrong. Please try again later.";
            }   
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);*/
    // if both inputs valid, enter profile page
    

}
?>
 
<!DOCTYPE html>
<html>
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

    <div class="container center">

        <!--Input Form -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white z-depth-2" id="login_form">

            <!--Header Text-->
            <h2 class="center brand-text"><b>Login</b></h2>
            <p class="center">Please fill in your credentials to login.</p>

            <div >
               <?php if(!empty($login_err) ): ?>
                    <span style="color: red;" id="error"><?php //echo $login_err;  ?></span>
                <?php endif ?> 
            </div>
            
            
            <div class="input-field left-align">
                <span class="red-text"><?php echo $username_err; ?></span>
                <input type="text" name="username"  value="<?php echo $username; ?>" placeholder="Username" data-length="45" id="input_text" maxlength="45" >
            </div>    

            <div class="input-field left-align">
                <span class="red-text"><?php echo $password_err; ?></span>
                <input type="password" name="password" value="<?php echo $password; ?>" placeholder="Password" data-length="45" id="input_text" maxlength="45">
            </div>

            <!-- NOT YET:
            <label class="row black-text">
                <input type="checkbox" name="cust?" class="col s2 filled-in" style="color:#2196f3;"/>
                <span class="col s10 left-align">Are you a <u>Customer?</u></span>       
                <br><br>
            </label>
            -->

            <div class="container">
                <input type="submit" class="btn brand waves-effect" value="Log in">
            </div>

            <p>Don't have an account? <a href="cregister.php">Sign up now</a> </p>
        </form>


    </div>
    <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>