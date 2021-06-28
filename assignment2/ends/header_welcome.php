<?php
  //Start Session
  //session_start();
?>

<head>

  <meta charset="UTF-8">
  <title>Project Management System</title>
  
  
  <?php require_once __DIR__ . "/../config/js_config.php"; ?>
  <?php require_once __DIR__ . "/../config/css_config.php"; ?>
  
</head>

<body class="grey lighten-2">
  <nav class="brand z-depth-2">

    <div class="nav-wrapper">

      <!-- If in main directory -->
      <?php if(getcwd()=="/var/www/html"): ?>
        <h3 class="brand-logo white-text center" style="display: inline; font-size: 40px;"><b>Singh Fuel</b></h3>

        <ul id="nav-mobile" class="left">
          <a href="Index.php" ><i class="material-icons">home</i></a>
        </ul>

        <!-- If logged in to an account -->
        <?php if(isset($_SESSION["loggedin"])): ?>
          <ul id="nav-mobile" class="right"> 

            <?php if($_SESSION["type"] == "customer"): ?>
              <li><b><a href="/user_cust/add.php">Add Project</a></b></li>
              <li><b><a href="/user_cust/edit.php">Account</a></b></li>

            <?php elseif($_SESSION["type"] == "employee"): ?>
              <li><b><a href="/user_emp/edit.php">Account</a></b></li>

            <?php elseif($_SESSION["type"] == "manager"): ?>
              <li><b><a href="/user_man/empty.php">Empty Projects</a></b></li>
              <li><b><a href="/user_man/empty_emp.php">Idle Employees</a></b></li>
              <li><b><a href="/user_man/edit.php">Account</a></b></li>
              <li><b><a href="/login/register.php">Create Account</a></b></li>
              <li><b><a href="#" data-target="drop1" class="dropdown-trigger">Reports</a></b></li>
              <?php require __DIR__ . "/../functions/warnings.php"; ?>
            <?php endif ?>

            <li><b><a href="/login/logout.php">Sign Out</a></b></li>
          </ul>
        <?php endif ?>


    <!-- Else inside a subdirectory  -->
    <?php else: ?>
      <h3 class="brand-logo white-text center" style="display: inline; font-size: 40px;"><b>Singh Fuel</b></h3>

      <ul id="nav-mobile" class="left">
        <a href="../Index.php" ><i class="material-icons">home</i></a>
      </ul>

      <!-- If logged in to an account -->
      <?php if(isset($_SESSION["loggedin"])): ?>
        <ul id="nav-mobile" class="right"> 

          <?php if($_SESSION["type"] == "customer"): ?>
              <li><b><a href="../user_cust/add.php">Add Project</a></b></li>
              <li><b><a href="../user_cust/edit.php">Account</a></b></li>

            <?php elseif($_SESSION["type"] == "employee"): ?>
              <li><b><a href="../user_emp/edit.php">Account</a></b></li>

            <?php elseif($_SESSION["type"] == "manager"): ?>
              <li><b><a href="/../user_man/empty.php">Empty Projects</a></b></li>
              <li><b><a href="/../user_man/empty_emp.php">Idle Employees</a></b></li>
              <li><b><a href="/../user_man/edit.php">Account</a></b></li>
              <li><b><a href="/../login/register.php">Create Account</a></b></li>
              <li><b><a href="#" data-target="drop2" class="dropdown-trigger">Reports</a></b></li>
              <?php require __DIR__ . "/../functions/warnings.php"; ?>
            <?php endif ?>

            <li><b><a href="../login/logout.php">Sign Out</a></b></li>
        </ul>
      <?php endif ?>

      
    <?php endif ?>

    <ul id="drop1" class="dropdown-content">
      <li><a href="/user_man/report1.php">Active Customers</a></li>
      <li><a href="/user_man/report2.php">Employee Status</a></li>
      <li><a href="/user_man/report3.php">Project Status</a></li>
    </ul>
    <ul id="drop2" class="dropdown-content">
      <li><a href="/../user_man/report1.php">Active Customers</a></li>
      <li><a href="/../user_man/report2.php">Employee Status</a></li>
      <li><a href="/../user_man/report3.php">Project Status</a></li>
    </ul>

  </div>
</nav>

<?php if(isset($_SESSION["type"])): ?>
  <?php if($_SESSION["type"] == "manager" && !empty($MANAGER_ERROR) ): ?>
<?php foreach($MANAGER_ERROR as $ERR): ?>
  <div class="red white-text center">
      <h2><?php echo $ERR["Message"]; ?></h2>
  </div>
<?php endforeach ?>
<?php endif ?>
<?php endif ?>
<main>