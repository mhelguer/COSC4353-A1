<?php 
	//Start Session
	session_start();

	// Check time of day (in Texas)
	$time = date('G', time())-5;
	if($time < 0){
		$time = 24 + $time;
	}
?>

<div class="grey lighten-4 center z-depth-1">
	<!-- If not logged in -->
	<?php if(!isset($_SESSION["loggedin"])  ): ?>

		<?php if($time >= 0 && $time < 12): ?>
			<h6 class="black-text"><em>Good Morning</em></h6>

		<?php elseif($time >= 12 && $time < 18): ?>
			<h6 class="black-text"><em>Good Afternoon</em></h6>

		<?php elseif($time >= 18 && $time < 24): ?>
			<h6 class="black-text"><em>Good Evening</em></h6>

		<?php endif ?>

	<!-- If logged in -->
	<?php else: ?>

		<?php if($time >= 0 && $time < 12): ?>
			<h6 class=" black-text"><em>Good Morning <u><?php echo $_SESSION["username"]?></u></em></h6>

		<?php elseif($time >= 12 && $time < 18): ?>
			<h6 class=" black-text"><em>Good Afternoon <u><?php echo $_SESSION["username"]?></u></em></h6>

		<?php elseif($time >= 18 && $time < 24): ?>
			<h6 class=" black-text"><em>Good Evening <u><?php echo $_SESSION["username"]?></u></em></h6>

		<?php endif ?>

	<?php endif ?>

</div>