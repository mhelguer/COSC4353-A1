<?php
// Initialize the session
session_start();


/* NOT YET
// Redirect if not customer
if(!isset($_SESSION["loggedin"]) || !$_SESSION["type"] == "customer"){
    header("location: ../Index.php");
    exit;
}
//--------------------------------------------------------------------------------------------------
//Read request (Default)
require __DIR__ . "/../config/db_connect.php";

$sql2 = "SELECT * FROM Customer_View_Proj WHERE customer_ID =  ? ";

if($stmt2 = mysqli_prepare($link, $sql2)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt2, "s", $param_id);

    // Set parameters
    $param_id = $_SESSION["id"];


    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt2)){

        // Store result
        $result = mysqli_stmt_get_result($stmt2);

        if(mysqli_num_rows($result) >= 1){
            $rows = mysqli_fetch_all($result,  MYSQLI_ASSOC);
        }
        else{
            echo "Oops. Error occurred with query.";
        }
    }
    else{
        echo "Oops. Error occurred with query.";
    }

}
// Free result
mysqli_free_result($result);
// Close statement
mysqli_stmt_close($stmt2);
// Close connection
mysqli_close($link);*/


$full_name_err=$address_1_err=$address_2_err=$city_err=$state_err=$zipcode_err="";
// init input vars as empty strings to be in forms
$full_name=$address_1=$address_2=$city=$state=$zipcode="";


// if data was inputted
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    
    // Check if Full Name is invalid
    if(empty(trim($_POST["full_name"]) ) || !preg_match("/^.{1,50}$/", trim($_POST["full_name"]) ) ){
            $full_name_err = "Please enter a valid full name.";
    } 
    else{
            $full_name = trim($_POST["full_name"]);
    }

    // Check if Address 1 is invalid
    if(empty(trim($_POST["address_1"]) ) || !preg_match("/^.{1,100}$/", trim($_POST["address_1"]) ) ){
        $address_1_err = "Please enter a valid Address.";
    } 
    else{
        $address_1 = trim($_POST["address_1"]);
        $_SESSION["address_1"] = $address_1;
    }

    // Check if Address 2 is invalid (optional)
    if(!empty(trim($_POST["address_2"]) ) && !preg_match("/^.{1,100}$/", trim($_POST["address_2"]) ) ){
        $address_2_err = "Please enter a valid Address.";
    } 
    else{
        $address_2 = trim($_POST["address_2"]);
    }

    // Check if City is invalid
    if(empty(trim($_POST["city"]) ) || !preg_match("/^.{1,100}$/", trim($_POST["city"]) ) ){
        $city_err = "Please enter a valid City.";
    } 
    else{
        $city = trim($_POST["city"]);
    }

    // Check if State chosen
    if(empty(trim($_POST["state"]))){
        $state_err = "Please select a State.";
    }
    else{
        $state = trim($_POST["state"]);
    }

    // Check if Zipcode is invalid
    if(empty(trim($_POST["zipcode"]) ) || !preg_match("/^\b\d{5}(?:-\d{4})?\b$/", trim($_POST["zipcode"]) ) ){
        $zipcode_err = "Please enter a valid Zipcode.";
    } 
    else{
        $zipcode = trim($_POST["zipcode"]);
    }

    $err_total = $full_name_err . $address_1_err . $address_2_err . $city_err . $zipcode_err;
       
}

//--------------------------------------------------------------------------------------------------
?>


 <!DOCTYPE html>
 <html> 
    <!--Include Files-->
    <?php require_once __DIR__ . "/../ends/header_welcome.php"; ?>
    <?php require_once __DIR__ . "/../functions/time_hello.php"; ?>

    <?php if($full_name==""||$address_1==""||$city==""||$zipcode==""){ ?>

        <section class="container center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="white">
              <!--Header Text-->
                <nav class="brand">
                    <h4 class="center"><b>Customer Account</b></h4>
                </nav>
                <p class="center">Please fill this form out to finish creating the account.</p>

                
                <?php if(!empty($submit_err) || !empty($query_err) ): ?>
                    <span style="color: red;"><?php echo $submit_err;  ?></span>
                    <span style="color: red;"><?php echo $query_err;  ?></span>
                <?php endif ?>
            





                <div class="input-field left-align">
                    <label>Full Name</label>
                    <span class="red-text"><?php echo $full_name_err; ?></span>
                    <input id="input_text" type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="<?php echo $full_name; ?>" data-length="50" maxlength="50">
                </div>

                <div class="input-field left-align">
                    <label>Address 1</label>
                    <span class="red-text"> <?php echo $address_1_err; ?></span>
                    <input id="input_text" type="text" name="address_1" value="<?php echo $address_1; ?>" placeholder="<?php echo $address_1; ?>"data-length="100" maxlength="100"> 
                </div>

                <div class="input-field left-align">
                    <label>Address 2</label>
                    <span class="red-text"> <?php echo $address_2_err; ?></span>
                    <input id="input_text" type="text" name="address_2" value="<?php echo $address_2; ?>" placeholder="<?php echo $address_2; ?>"data-length="100" maxlength="100"> 
                </div>
                
                <div class="input-field left-align">
                    <label>City</label>
                    <span class="red-text"> <?php echo $city_err; ?></span>
                    <input id="input_text" type="text" name="city" value="<?php echo $city; ?>" placeholder="<?php echo $city; ?>"data-length="100" maxlength="100"> 
                </div>

                <div class="input-field left-align">
                    <label>State</label>
                    <span class="red-text"> <?php echo $state_err; ?></span>
                    <input type="text" name="state" list="statename"value="<?php echo $state; ?>" placeholder="<?php echo $state; ?>">
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
                    <label>Zipcode</label>
                    <span class="red-text"> <?php echo $zipcode_err; ?></span>
                    <input id="input_text" type="text" name="zipcode" value="<?php echo $zipcode; ?>" placeholder="<?php echo $zipcode; ?>"data-length="10" maxlength="10"> 
                </div>

                            
                <div class="container">
                    <label style="color: grey;"><!--NOT YET <?php echo $success;  ?> --></label><br>
                    <input type="submit" class="btn brand waves-effect" value="Create Account">
                    <!--a class="btn brand left-align" href="register.php">Employee?</a-->       
                </div>


          </form>
        </section>
    <?php }else{ ?>

    <nav class="brand">
                <h4 class="center"><b>Customer Account</b></h4>
            </nav>

    <div class="container">
        <div class="row">
            <?php $customer = array('full_name'=>$full_name, 'address_1'=>$address_1, 'address_2'=>$address_2, 'city'=>$city, 'state'=>$state, 'zipcode'=>$zipcode) ?>

                <div class="col s6 md3">
                    <div class="card z-depth-0">
                        <div class="card-content center">
                            <h6><?php echo htmlspecialchars($customer['full_name']); ?></h6>
                        </div>
                            <ul>
                                <li><?php echo 'Address 1: '; print_r($customer['address_1']);  ?></li>
                                <li><?php echo 'Address 2: '; print_r($customer['address_2']);  ?></li>
                                <li><?php echo 'City: '; print_r($customer['city']);  ?></li>
                                <li><?php echo 'State: '; print_r($customer['state']);  ?></li>
                                <li><?php echo 'Zipcode: '; print_r($customer['zipcode']);  ?></li>

                                                   
                            </ul>                           
                        </div>
                        
                </div>
                

        
                   
        </div>
    </div>
    
            
    
        <div class="card-content center">
           
            <!--Display Card Buttons-->
            <div class="card-action z-depth-0">
                <a href="add.php" class="btn-large brand">Place an Order</a>                
            </div>
    
        </div>
<?php } ?>
<?php require_once __DIR__ . "/../ends/footer_welcome.php"; ?>
<!-- NOT YET:
<div class="row">

	<h4 class="center brand-text"><b>My Projects</b></h4>
	<hr>

    <?php foreach($rows as $row): ?>

        <div class="card grey lighten-4 col s4 offset-s1">

            <nav class="brand">
                <span class="card-title brand-logo center"><h4><u><?php echo $row["Pname"]; ?></u></h4></span>
            </nav>

            <form action="../user_cust/edit_project.php" method="post" class="right" style="padding:0px; margin: 0px;">
                <input type="hidden" name="project_id" value="<?php echo $row["P_id"]; ?>">
                <input type="submit" name="edit_submit" class="btn-small green right" value="Edit">
            </form>

            <div class="card-content">
                
                <table class="highlight">
                    <tbody >
                      <tr>
                        <th>Project Status: </th>
                        <td><?php echo $row["Pstatus"] ?></td>
                      </tr>
                      <tr>
                          <th>Current Cost: </th>
                          <td><?php echo '$'. number_format($row["Total_cost"]) ?></td>
                      </tr>
                      <tr>
                          <th>Project Budget: </th>
                          <td><?php echo '$'. number_format($row["ProjectBudget"]) ?></td>
                      </tr>
                      <tr>
                          <th>Project Deadline: </th>
                          <td><?php echo $row["Deadline_date"] ?></td>
                      </tr>
                    </tbody>
                </table>

                <ul >
                    <li>
                        <p style="text-align: left;"><b>Manager:</b> <?php echo $row["Fname"] ?> <?php echo $row["Lname"] ?></p>
                        <p style="text-align: left;"><b>Email:</b> <?php echo $row["Email"] ?></p>

                        <?php if( preg_match( '/^(\d{3})(\d{3})(\d{4})$/', $row["Phone"] ,  $matches ) ){
                                $num = $matches[1] . '-' .$matches[2] . '-' . $matches[3];
                            }
                            elseif($row["Phone"] == null){
                                $num = null;
                            }
                        ?>

                        <p style="text-align: left;"><b>Phone:</b> <?php echo $num ?></p>
                    </li>
                </ul>

            </div>
        </div>


    <?php endforeach ?>
</div> -->