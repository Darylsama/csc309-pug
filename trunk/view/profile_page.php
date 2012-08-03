<div class="container-fluid">
  <div class="row-fluid content-wrapper">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>

    <div class="span9 content">
        
        
      <h2><?php echo get_loggedin_user() -> username; ?>     
      </h2>
      <hr />
      
      <h2>Name: <?php echo get_loggedin_user() -> firstname . " " .  get_loggedin_user() -> lastname; ?></h2>
      <hr/>
	  <form action="edit_profile.php"> 		
	  <button id="profile" href="edit_profile.php">edit your profile</button>
	  </form>
	  <form action="change_password.php">
	  <button id="password" href="change_password.php">change your password</button>
      </form>
      <hr/>
      <h2>Sports</h2>
      <hr/>
      <!-- sports listing -->
      <ul>
      <?php foreach ($this->page["current_sports"] as $sport) { ?>
        <li><span><?php echo $sport -> name; ?></span></li>
      <?php } ?>
      </ul>
      
      
      <form action="add_profile_sports.php">
      <button>add sports</button>
      </form>
      
      
      <hr />
      
     <div class="row-fluid">
     
     <div class="span4">
     <?php echo "Joined game list"?>
     <?php foreach ($this->page["joined_game"] as $gid => $name) { ?>
        <tr>
        	<td>
        	<a href="view_game.php?gid=<?php echo $gid; ?>"><?php echo $name; ?></a>
        	</td>
        </tr>
  	<?php } ?>
     </div>
     
     <div class="span4">
     <?php echo "Interested game list:<br/>"?>
	<?php foreach ($this->page["interested_game"] as $gid => $name) { ?>
	<tr>
	<td>
		<a href="view_game.php?gid=<?php echo $gid; ?>"><?php echo $name; ?></a>
	</td>
	</tr>
	<?php } ?>
     </div>
     
     <div class="span4">
     <?php echo "organized game list:<br/>"?>
     
     <?php foreach ($this->page["organized_game"] as $game) { ?>
		<a href="view_game.php?gid=<?php echo $game->gid?>"><?php echo $game->name?></a><br />
	<?php } ?> 
     </div>
     
     </div>
      
  
	  
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