<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>


    <div class="span9">
      <h1>
        <?php echo $this->page["game"]->name; ?> (<?php echo $this->page["game"]->sport->name; ?>)
      </h1>
      <br /> <span><?php echo $this->page["game"]->organizer->username; ?> @ <?php echo $this->page["game"]->creation; ?>
      </span> <br /> <br />
      <?php echo $this->page["game"]->desc; ?>
      <br />
      <hr />


      <?php if ($this->page["status"] == 0) { ?>
      
      <!-- current user is the organizer for this game -->
      <span class="label label-success">You are the organizer for this game.</span>

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
      <span class="label label-success">Congradulations, you have been selected to participate in this game</span>
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

