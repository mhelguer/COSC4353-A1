<?php


//TODO: display all fields from Fuel Quote (add.php)



// Initialize the session
session_start();

/* NOT YET:
// Redirect if not customer
if(!isset($_SESSION["loggedin"]) || !$_SESSION["type"] == "customer"){
    header("location: ../Index.php");
    exit;
}
//--------------------------------------------------------------------------------------------------

// Include db_connect file
require __DIR__ . "/../config/db_connect.php";
 */
// Define variables and initialize with empty values
$cname = $cusername = $cpassword = "";
$query_err = "";


/* NOT YET:
$sql2 = "SELECT * FROM Customer_View_Self WHERE customer_ID = ?";
if($stmt2 = mysqli_prepare($link, $sql2)){
    // Bind variables to the prepared statement as parameters
   mysqli_stmt_bind_param($stmt2, "s", $_SESSION["id"]);

    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt2)){

        // Store result
        $result = mysqli_stmt_get_result($stmt2);

        if(count($result) == 1){
            $info = mysqli_fetch_assoc($result);
            $cname = $info["Customer_name"];
            $cusername = $info["C_username"];
            $cpassword = $info["C_password"];
            $rname  = $info["Repname"];
            $remail = $info["RepEmail"];
        }
        else{
            $query_err = "Oops. Error occurred with query.";
        }
    }
    else{
        $query_err = "Oops. Error occurred with query.";
    }

}
// Free result
mysqli_free_result($result);
// Close connection
mysqli_close($link);
    
//--------------------------------------------------------------------------------------------------
//Edit request
// Include db_connect file
require __DIR__ . "/../config/db_connect.php";
*/
$cname_err = $cusername_err = $cpassword_err = $rname_err = $remail_err = "";
/* NOT NEEDED
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if name is invalid
    if(empty(trim($_POST["cname"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["cname"]) ) ){
        $cname_err = "Please enter a valid name.";
    } 
    else{
        $cname = trim($_POST["cname"]);
    }

    // Check if username is invalid
    if(empty(trim($_POST["cusername"]) ) || !preg_match("/^\w{2,45}$/", trim($_POST["cusername"]) ) ){
        $cusername_err = "Please enter a valid username.";
    } 
    else{
        $cusername = trim($_POST["cusername"]);
    }
    
    // Check if password is invalid
    if(empty(trim($_POST["cpassword"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["cpassword"]) ) ){
        $cpassword_err = "Please enter a valid password.";
    } 
    else{
        $cpassword = trim($_POST["cpassword"]);
    }

    // Check if rep name is invalid
    if(empty(trim($_POST["rname"]) ) || !preg_match("/^.{2,45}$/", trim($_POST["rname"]) ) ){
        $rname_err = "Please enter a valid Representative name.";
    } 
    else{
        $rname = trim($_POST["rname"]);
    }

    // Check if Email is invalid
    if( empty(trim($_POST["remail"]) ) || 
        !filter_var(trim($_POST["remail"]), FILTER_VALIDATE_EMAIL) )
    {
        $remail_err = "Please enter a valid Email.";
    } 
    else{
        $remail = trim($_POST["remail"]);
    }


    // Validate
    if(empty($cname_err) && empty($cusername_err) && empty($cpassword_err) && empty($rname_err) && empty($remail_err)){

      // Prepare an insert statement
      $sql = "UPDATE Customer_View_Self
      			SET Customer_name = ?, C_username = ?, C_password = ?, Repname = ?, RepEmail = ?
      			WHERE customer_ID = ?";

      if($stmt = mysqli_prepare($link, $sql) ){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssi", $cname, $cusername, $cpassword, $rname, $remail, $_SESSION["id"]);

        // Attempt to execute the prepared statement
        if(!mysqli_stmt_execute($stmt)){
          $submit_err = "Updation failed.";
          $success = "";
        }else{
        	$success = "Changes saved.";
        }
      } 
      else{
        $submit_err = "Oops! Something went wrong. Please try again later.";
      }        
    }
    
}
*/
/* NOT YET:
// Close statement
mysqli_stmt_close($stmt);
// Close connection
mysqli_close($link);
*/
//--------------------------------------------------------------------------------------------------

?>

<!DOCTYPE html>
<html>
	<?php include('../ends/header_welcome.php'); ?>
    <?php include('../functions/time_hello.php'); ?>


    <br><br>
    <div class="container center row">
        <div class="card white z-depth-1 col s6 offset-s3">

            <nav class="brand">
                <h4 class="brand"><b>Your Order History</b></h4>
            </nav>
            
            <div class="card-content">
                <table class="highlight">
                    <tbody>
                        <tr>
                            <td>
								<?php
									foreach($_SESSION['all_orders'] as $item){
										echo "Gallons: ", $item['gallons'], "</br>",
										"Address: ", $item['address'], "</br>", 
										"Delivery Date: ", $item['delivery'], "</br>", 
										"Price per Gallon: ", $item['suggested'], "</br>", 
										"Total Price: $", $item['total'], "</br></br>";
									}
								?>
                            </td>
                        </tr>
                    </tbody>
              </table>
            </div>
        </div>
    </div>
    <br><br>


    



	<?php include('../ends/footer_welcome.php'); ?>
</html>
