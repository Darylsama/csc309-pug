<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>


    <div class="span10">
      <?php echo $this->page["game"]->name; ?>
      <br />
      <?php echo $this->page["game"]->sport->name; ?>
      <br />
      <?php echo $this->page["game"]->desc; ?>
      <br />
      <?php echo $this->page["game"]->organizer->username; ?>
      <br />
      <?php echo $this->page["game"]->creation; ?>
      <br />



      <?php if (get_loggedin_user()->uid == $this->page["game"]->organizer->uid) { ?>
      <!-- current user is the organizer for this game -->
      <span class="label label-success">You are the organizer for this game.
        Here's a list of players that are interested in this game</span>
      <ul>
        <?php foreach ($this->page["interested_players"] as $player) { ?>
        <li><?php echo $player->username ?>
        </li>
        <?php } ?>
      </ul>
      
      
      <?php } else if (!$this->page["is_interested"]) {?>
      <!-- current user is not interested in the game -->
      <form method="post" action="express_interest.php" name="interest">
        <input name="gid" type="hidden"
          value="<?php echo $this->page["game"]->gid; ?>" /> <input
          type="submit" class="btn btn-primary" value="Express Interest" />
      </form>


      
      <?php } else if ($this->page["is_interested"]) {?>
      <!-- current user is interested in the game -->
      <span class="label label-success">You have expressed interest in this game.</span>
        
        
        
      <?php } else { ?>
      <!-- current user is selected in the game -->
          <span class="label label-success">Congradulations, you have been selected to participate in this game</span>
      <?php } ?>

    </div>
  </div>
</div>

