<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <div class="span2">
      <ul class="nav nav-pills nav-stacked">
        <li>
          <a href="new_game.php"> Create New Game </a>
        </li>
        <li>
          <a href="list_games.php">Browse Existing Games</a>
        </li>
        <li>
          <a href="#"> View Users </a>
        </li>
      </ul>
    </div>


    <div class="span10" >
<?php echo $this->page["game"]->name; ?><br />
<?php echo $this->page["game"]->sport->name; ?><br />
<?php echo $this->page["game"]->desc; ?><br />
<?php echo $this->page["game"]->organizer->username; ?><br />
<?php echo $this->page["game"]->creation; ?><br />
    </div>
    
  </div>
</div>

