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



      <?php if ($this->page["status"] == 0) { ?>
      <!-- current user is the organizer for this game -->
      <span class="label label-success">You are the organizer for this game.
        Here's a list of players that are interested in this game</span>
      <form id="select-form" method="post" action="select_player.php" name="part">
        <ul>
          <?php foreach ($this->page["interested_players"] as $player) { ?>
          <li><?php echo $player->username ?><input
            id="<?php echo $player->uid ?>" type="button"
            class="btn btn-mini select-player" value="Select" /></li>
          <?php } ?>
        </ul>
        <input name="gid" type="hidden"
          value="<?php echo $this->page["game"]->gid; ?>" /> <input id="uid-field" name="pid"
          type="hidden" value="" />
      </form>


      <?php } else if ($this->page["status"] == 1) {?>
      <!-- current user is not interested in the game -->
      <form method="post" action="express_interest.php" name="interest">
        <input name="gid" type="hidden"
          value="<?php echo $this->page["game"]->gid; ?>" /> <input
          type="submit" class="btn btn-primary" value="Express Interest" />
      </form>



      <?php } else if ($this->page["status"] == 2) {?>
      <!-- current user is interested in the game -->
      <span class="label label-success">You have expressed interest in this
        game.</span>



      <?php } else if ($this->page["status"] == 3) { ?>
      <!-- current user is selected in the game -->
      <span class="label label-success">Congradulations, you have been selected
        to participate in this game</span>
      <?php } ?>

    </div>
  </div>
</div>

