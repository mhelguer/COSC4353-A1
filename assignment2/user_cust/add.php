<?php
// Initialize the session
session_start();

/* NOT YET:
// Initialize the session
session_start();
 NOT YET:
// Redirect if not customer
if(!isset($_SESSION["loggedin"]) || !$_SESSION["type"] == "customer"){
    header("location: ../Index.php");
    exit;
}
//--------------------------------------------------------------------------------------------------
//Add request
// Include db_connect file
require __DIR__ . "/../config/db_connect.php";
 */


// Define variables and initialize with empty values
$gallons = $suggested =  $delivery = $total = "";
$gallons_err = $submit_err = $delivery_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    


    // Check if gallons is invalid
    if(empty(trim($_POST["gallons"]) ) || !preg_match('#^\d+(?:\.\d{1,2})?$#', trim($_POST["gallons"]) ) ){
        $gallons_err = "Please enter a valid request.";
    } 
    else{
        $gallons = trim($_POST["gallons"]);   
        $_SESSION['gallons']=$gallons; 

        // set the suggested price/gallon and the total price
        $suggested=2;
        $_SESSION['suggested']=$suggested; 
        $total= $suggested*$gallons;        
        $_SESSION['total']=$total;
        
    }
    

    // Check if delivery date is invalid
    if((empty(trim($_POST["delivery"]) ) || !preg_match("/^\d{4}\-\d{2}\-\d{2}$/", trim($_POST["delivery"])) )){
        echo $_POST["delivery"];
        $delivery_err = "Please enter a valid Delivery Date.";
    } 
    else{
      $delivery = trim($_POST['delivery']);
      $_SESSION['delivery']=$delivery;  

    }


    

    
    // If all input is valid, put input inside session variable
    if(empty($gallons_err) && empty($delivery_err)){
      //header('Location: edit.php');
      $_SESSION['latest_order']= ['gallons'=>$gallons, 'address'=>$_SESSION['address_1'], 'delivery'=>$delivery, 'suggested'=>$suggested, 'total'=>$total];

      // add latest order to all orders
      $_SESSION['all_orders'][]=$_SESSION['latest_order'];

    }
    /* NOT YET:
    // Validate
    if(empty($gallons_err) && empty($budget_err) && empty($dead_err) ){

      // Prepare an insert statement
      $sql3 = "INSERT INTO project (pname, ProjectBudget, Deadline_date, Customer_ID) VALUES (?,?,?,?)";

      if($stmt3 = mysqli_prepare($link, $sql3) ){

        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt3, "sssi", $gallons, $budget, $_POST["dead"], $_SESSION["id"]);
        
        // Attempt to execute the prepared statement
        if(!mysqli_stmt_execute($stmt3)){
          $submit_err = "Submission failed.";
        }else{

          // Redirect user to welcome page
          header("location: ../Index.php");
        }
      } 
      else{
        $submit_err = "Oops! Something went wrong. Please try again later.";
      }        
    }
    // Close statement
    //NOT YET:mysqli_stmt_close($stmt3);*/
}
    
// Close connection
//NOT YET: mysqli_close($link);
//--------------------------------------------------------------------------------------------------
?>

<!DOCTYPE html>
<html>
  <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
  <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

  <?php if(!empty($submit_err) || !empty($gallons_err) ): ?>
    <label style="color: red;"><?php echo $submit_err;  ?> </label>
    <br>
  <?php endif ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">
    <!--Header Text-->

      <nav class="brand">
        <h4 class="center"><b>Place an Order</b></h4>
      </nav>
      
      <p class="center">Please fill in the order details.</p>

      <!-- Input Field: Gallons Requested-->
      <div class="container center">
        <div class="input-field left-align">
          <label>Gallons Requested</label>
          <span class="red-text"><?php echo $gallons_err; ?></span>
          <input id="input_text" type="number" step="any"  min="1" name="gallons" value="<?php echo $gallons; ?>" placeholder="<?php echo $gallons; ?>" data-length="50" maxlength="50">
        </div>
    </div>

    <!--Readonly Field: Delivery Address-->
    <div class="container center">
        <div class="input-field left-align">
        <label>Delivery Address</label>
        <span></span>
        <input type="text" value="<?php print_r($_SESSION['address_1']); ?>" readonly>
      </div>
    </div>

      


      <!--Input Field: Delivery Date-->
      <div class="container center">
        <div class="input-field left-align">
            <label>Delivery Date (yyyy-mm-dd)</label>
            <span class="red-text"><?php echo $delivery_err; ?></span>
            <input id="input_text" type="text" name="delivery" class="datepicker2" value="<?php echo $delivery; ?>" placeholder="<?php echo $delivery; ?>">
        </div>
      </div>


      <!--Readonly Field: Suggested Price/Gallon-->
      <div class="container center">
        <div class="input-field left-align">
          <label>Suggested Price/Gallon</label>
          
          <input type="number" name="suggested" value="<?php echo $suggested; ?>" readonly>
        </div> 
      </div>


      <!--Readonly Field: Total Price-->
      <div class="container center">
          <div class="input-field left-align">
          <label>Total Price</label>
          <input type="number" id="total" value="<?php echo  $total; ?>" readonly>
        </div>
      </div>

      <!--Submit Button-->
      <div class="container center">
        <input type="submit" class="btn btn-primary brand waves-effect" value="Submit">
      </div>
      <br></br>
      
      <!--See all Orders-->
      <div class="card-action z-depth-0 center">
          <a href="edit.php" class="btn-large brand">See Order History</a>
          
      </div>
  </form>

  <?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
</html>