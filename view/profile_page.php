<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <div class="span2">
      <ul class="nav nav-pills nav-stacked">
        <li>
          <a href="new_game.php"> Create New Game </a>
        </li>
        <li>
          <a href="list_games.php"> Browse Existing Games </a>
        </li>
        <li>
          <a href="#"> View Users </a>
        </li>
      </ul>
    </div>

    <div class="span10">
        
        
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#">Profile</a>
        </li>
      </ul>
      
      
      <h2><?php echo get_loggedin_user() -> username; ?></h2>
      <hr />
      
      <h2>Name: <?php echo get_loggedin_user() -> firstname . " " .  get_loggedin_user() -> lastname; ?></h2>
      <hr />
      
      <h2>Sports</h2>
      
      <!-- sports listing -->
      <ul>
      <?php foreach ($this->page["current_sports"] as $sport) { ?>
        <li><span><?php echo $sport -> name; ?></span></li>
      <?php } ?>
      </ul>
      
    </div>
  </div>
</div>