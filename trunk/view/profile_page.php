<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>

    <div class="span10">
        
        
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