<div class="container-fluid">
  <div class="row-fluid content-wrapper">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>


    <div class="span9 content">

    
    <div class="row-fluid">
        <div class="span8">
            <h1><?php echo $this->page["game"]->name; ?> (<?php echo $this->page["game"]->sport->name; ?>)</h1>
            <br />

            <span>Start Time:
                <?php echo 
                    date("M j, Y G:00", $this->page["game"] -> start_time) .
                    "&nbsp;" .
                    ((int)date("G", $this->page["game"] -> start_time) >= 12 ? "PM" : "AM")
                ?>
            </span>
            <br />
            <br />            
            
            <span>Duration: <?php echo $this->page["game"]->duration ?> Hours</span>
            <br />
            <br />
            
            
            <span>Organized by: <?php echo $this->page["game"]->organizer->username; ?> @ <?php echo $this->page["game"]->creation; ?>
        </div>
        
        <div class="span4">
          <div id="show-date" class="pull-right" data-time="<?php echo $this->page["game"]->start_time; ?>"></div>
        </div>
    </div>
    <hr />
    <p>
    <?php echo $this->page["game"]->desc; ?>
    </p>
    <br/>
    <hr />


      <?php if ($this->page["status"] == 0) { ?>
      
      <!-- current user is the organizer for this game -->
      <span class="label label-success">You are the organizer for this game.</span>
      <form method="post" action="cancel_game.php">
      <input type="hidden" name="gid" value="<?php echo $this->page["game"]->gid?>"/>
      <input class="label" type="submit" value="Cancel this game"/>
      </form>
      <!-- players who are interested in playing this game -->
      <?php if (count($this->page["interested_players"]) > 0) { ?>
      <form id="select-form" method="post" action="select_player.php" name="part">
        <ul class="nav nav-list">
        <li class="nav-header">Awesome players who expressed their interest in this game</li>
          
          <?php foreach ($this->page["interested_players"] as $player) { ?>
          <li>
             <a href="#" id="<?php echo $player->uid ?>" class="select-player"><?php echo $player->username ?></a>
          </li>
          <?php } ?>
          
          <!-- consider using session storing application state? -->
          <input name="gid" type="hidden"
            value="<?php echo $this->page["game"]->gid; ?>" />
          <input id="uid-field" name="pid" type="hidden" value="" />
        
        </ul>
      </form>
      <?php } ?>
      
      <!-- players who will be participating this game -->
      <?php if (count($this->page["selected_players"]) > 0) { ?>
      <ul class="nav nav-list">
          <li class="nav-header">Awesome players who will be participating this game</li>
          <?php foreach ($this->page["selected_players"] as $player) { ?>
          <li>
              <a href="#" id="<?php echo $player->uid ?>"><?php echo $player->username ?></a>
          </li>
          <?php } ?>
      </ul>
      <?php } ?>
      
      

      <?php } else if ($this->page["status"] == 1) {?>
      
      <!-- current user is not interested in the game -->
      <form method="post" action="express_interest.php" name="interest">
        <input name="gid" type="hidden"
          value="<?php echo $this->page["game"]->gid; ?>" /> <input
          type="submit" class="btn btn-primary" value="Express Interest" />
      </form>

      <?php } else if ($this->page["status"] == 2) {?>
      <!-- current user is interested in the game -->
      <form method="post" action="cancel_interest.php" name="cancel_interest">
      	<input name='gid' type="hidden" value="<?php echo $this->page["game"]->gid;?>"/>
      	<input type="submit" class="label label-success" value="You have expressed interest in this game. click to cancel."/>
	  </form>
      
      
      <?php } else if ($this->page["status"] == 3) { ?>
      
      <!-- current user is selected in the game -->
      <form method = "post" action="cancel_join.php" name="cancel_join">
      	<input name='gid' type='hidden' value="<?php echo $this->page["game"]->gid;?>"/>
      	<input type="submit" class="label label-success" value="Congradulations, you have been selected to participate in this game. Click to exit this game."/>
      </form>
      <ul class="nav nav-list">
      <li class="nav-header">Other participating players</li>
      <?php foreach ($this->page["selected_players"] as $player) { ?>
        <li>
          <a href="#" id="<?php echo $player->uid ?>"><?php echo $player->username ?></a>
        </li>
      <?php } ?>
      </ul>
          
          
      <?php } ?>
    </div>
  </div>
</div>

