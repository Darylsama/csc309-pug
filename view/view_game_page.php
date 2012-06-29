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

      <?php if (!$this->page["is_interested"]) {?>
      
      <form method="post" action="express_interest.php" name="interest">
        <input name="gid" type="hidden"
          value="<?php echo $this->page["game"]->gid; ?>" /> <input
          type="submit" class="btn btn-primary" value="Express Interest" />
      </form>
      
      <?php } else { ?>
      
          <span class="label label-success">You have expressed interest in this game.</span>
      <?php } ?>
      
    </div>
  </div>
</div>

