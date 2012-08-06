<div class="container-fluid">
  <div class="row-fluid content-wrapper">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>

    <div class="span9 content">
        
      <h3><?php echo get_loggedin_user() -> username; ?></h3>
      <hr />
      
      <h3>Name: <?php echo get_loggedin_user() -> firstname . " " .  get_loggedin_user() -> lastname; ?></h2>
      <hr />
      
      <h3>Sports</h3>
      <!-- sports listing -->
      <ul>
      <?php foreach ($this->page["current_sports"] as $sport) { ?>
        <li><span><?php echo $sport -> name; ?></span></li>
      <?php } ?>
      </ul>
      <hr />
     
     
      
     <h3>Games</h3> 
     <div class="row-fluid">
     
         <div class="span4">
         <ul class="nav nav-list">
         <li class="nav-header">Joined Games</li>
         <?php foreach ($this->page["joined_game"] as $gid => $name) { ?>
    	 <li><a href="view_game.php?gid=<?php echo $gid; ?>"><?php echo $name; ?></a></li>
      	 <?php } ?>
      	 </ul>
         </div>
         
         <div class="span4">
         <ul class="nav nav-list">
         <li class="nav-header">Interested Games</li>
    	 <?php foreach ($this->page["interested_game"] as $gid => $name) { ?>
    	 <li><a href="view_game.php?gid=<?php echo $gid; ?>"><?php echo $name; ?></a></li>
    	 <?php } ?>
    	 </ul>
         </div>
         
         <div class="span4">
         <ul class="nav nav-list">
         <li class="nav-header">Organized Games</li>
         <?php foreach ($this->page["organized_game"] as $game) { ?>
    	 <li><a href="view_game.php?gid=<?php echo $game->gid?>"><?php echo $game->name?></a></li>
    	 <?php } ?> 
    	 </ul>
         </div>
     
     </div>
     <hr />
  
	 <h3>Ratings</h3>
	  <div class="row-fluid">
	  
	  <div class="span6">
  		<?php 
			echo "The average rates of you as a player:<br/>";
			if (isset($this->page["player_rates"])){
				
				echo $this->page["player_rates"];
				echo "<br/>";
			}		
			else{
				echo "You have not been rated as an player yet.<br/>";
			}
		?>
	  </div>
	  
  	  <div class="span6">
  	  		<?php 
			echo "The average rates of you as an organizer:<br/>";
			if (isset($this->page["organizer_rates"])){
				
				echo $this->page["organizer_rates"];
				echo "<br/>";
			}		
			else{
				echo "You have not been rated as an organizer yet.<br/>";
			}
		?>
	  </div>
  	  
  	  </div>
	  

      
    </div>
  </div>
</div>