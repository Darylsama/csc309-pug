<?php
$current_page = basename($_SERVER["PHP_SELF"], ".php");
?>

<div class="span2">
  <ul class="nav nav-pills nav-stacked">
  
    <li
    <?php echo ($current_page == "new_game") ? 'class="active"' : ""; ?>>
      <a href="new_game.php"> Create New Game </a>
    </li>

    <li
    <?php echo ($current_page == "list_games") ? 'class="active"' : ""; ?>>
      <a href="list_games.php">Browse Existing Games</a>
    </li>


    <li
    <?php echo ($current_page == "view_user") ? 'class="active"' : ""; ?>>
      <a href="#"> View Users </a>
    </li>
    
  </ul>
</div>

