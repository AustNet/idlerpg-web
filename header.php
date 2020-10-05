<?php require_once('include/config.php'); ?>
<?php require_once('include/idlerpg.php'); ?>
<!DOCTYPE html>
<html lang="en">
<title>IdleRPG - <?php echo $_CONFIG['network_name']; ?></title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="include/idlerpg.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<script src="include/idlerpg.js"></script>
<body>

<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-blue-grey w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-blue-grey" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="index.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Game Info</a>
    <a href="admincmd.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Admin Commands</a>
    <a href="players.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Player Info</a>
    <a href="worldmap.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">World Map</a>
    <a href="quest.php" class="w3-bar-item w3-button w3-hide-small w3-padding-large w3-hover-white">Quest Info</a>
    <a href="<?php echo $_CONFIG['network_web']; ?>" class="w3-hide-small" target="_new"><img src="<?php echo $_CONFIG['logo']; ?>" align="right" style="padding-right:10px;"></a>
    <a href="<?php echo $_CONFIG['network_web']; ?>" class="w3-hide-large" target="_new"><img src="<?php echo $_CONFIG['logo']; ?>" style="padding-left: 10px;"></a>
</div>

  <!-- Navbar on small screens -->
  <div id="mobilenav" class="w3-bar-block w3-blue-grey w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="index.php" class="w3-bar-item w3-button w3-padding-large">Game Info</a>
    <a href="admincmd.php" class="w3-bar-item w3-button w3-padding-large">Admin Commands</a>
    <a href="players.php" class="w3-bar-item w3-button w3-padding-large">Player Info</a>
    <a href="worldmap.php" class="w3-bar-item w3-button w3-padding-large">World Map</a>
    <a href="quest.php" class="w3-bar-item w3-button w3-padding-large">Quest Info</a>
  </div>
</div>
