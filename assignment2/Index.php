
<?php 
	session_start();
	$_SESSION['all_orders']=[];

?>
<!DOCTYPE html>
<html>
	
	<!--Include Header Files-->
	<?php require_once __DIR__ . "/ends/header_welcome.php"; ?>
	<?php require_once __DIR__ . "/functions/time_hello.php"; ?>

	<!--Not Logged in to an account-->
	<?php if(!isset($_SESSION["loggedin"])): ?>

		<!--Display Card-->
		<div class="container center">
	      <div class="card z-depth-2">

	      	<!--Display Card Buttons-->
	        <div class="card-action z-depth-0">
	            <a href="login/login.php" class="btn-large brand">Log In</a>
	            <a href="login/cregister.php" class="btn-large brand">Register</a>
	        </div>

	      	<!--Display Card Image-->
	        <div class="card-image">
	          <img src="img/Fuel.jpg">
	        </div>

	        
	      </div>
	  	</div>

	<!--NOT YET: Logged in to an account
	<?php else: ?>
		<br>
		<div>
			<?php if($_SESSION["type"] == "employee"): ?>
				<?php require_once __DIR__ . "/user_emp/view.php"; ?>

			<?php elseif($_SESSION["type"] == "customer"): ?>
				<?php require_once __DIR__ . "/user_cust/view.php"; ?>

			<?php else: ?>
				<?php require_once __DIR__ . "/user_man/view.php"; ?>
			<?php endif ?>	
		</div>
  	<?php endif ?>
	-->

  	<!--Include Footer File-->
	<?php require_once __DIR__ . "/ends/footer_welcome.php"; ?>
</html>