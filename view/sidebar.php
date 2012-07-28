<?php
$current_page = basename($_SERVER["PHP_SELF"], ".php");
?>

<div class="span3 sidebar-wrapper">
  <ul class="nav nav-pills nav-stacked sidebar">

    <?php if (get_loggedin_user() -> permission == 2) { ?>
    <!-- user control panel, for admin users only -->
    <li
    <?php echo ($current_page == "admin_dashboard") ? 'class="active"' : ""; ?>>
      <a href="admin_dashboard.php" >Administrivia</a>
    </li>
    <?php } ?>
    
    <li
    <?php echo ($current_page == "profile") ? 'class="active"' : ""; ?>>
      <a href="profile.php"> Profile </a>
    </li>
  
  
    <li
    <?php echo ($current_page == "new_game") ? 'class="active"' : ""; ?>>
      <a href="new_game.php"> Create New Game </a>
    </li>

    <li
    <?php echo ($current_page == "list_games") ? 'class="active"' : ""; ?>>
      <a href="list_games.php">Browse Existing Games</a>
    </li>


    <li
    <?php echo ($current_page == "list_users") ? 'class="active"' : ""; ?>>
      <a href="list_users.php"> View Users </a>
    </li>
    

    
    
  </ul>
</div>

