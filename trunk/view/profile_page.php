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
	    <span>Player Reputation: </span>
	    <br />
  		<?php if (isset($this->page["player_rates"])) { ?>
    		<div class="player-rating-avg"
    	        data-ratee=""
    	        data-action=""
    	        data-value="<?php echo $this->page["player_rates"];?>"
    	        data-comment=""
    	        data-widget-style="0">
            </div>
            
            <hr />
            <?php foreach ($this->page["all_ratings"][1] as $rating) { ?>
    		<div class="player-rating"
    		    data-rater="<?php echo $rating->rater->username ?>"
    	        data-ratee=""
    	        data-action=""
    	        data-value="<?php echo $rating->value; ?>"
    	        data-comment="<?php echo $rating->comment; ?>"
    	        data-widget-style="1">
	        </div>
            <?php } ?>
		<?php } else{ ?>
			<span class="label">Rating Not Available</span>
		<?php } ?>
	  </div>
	  
  	  <div class="span6">
      	<span>Organizer Reputation: </span>
      	<br />
        <?php if (isset($this->page["organizer_rates"])) { ?>
    		<div class="organizer-rating-avg"
    	        data-ratee=""
    	        data-action=""
    	        data-value="<?php echo $this->page["organizer_rates"]; ?>"
    	        data-comment=""
    	        data-widget-style="0">
            </div>
            
            <hr />
            <?php foreach ($this->page["all_ratings"][0] as $rating) { ?>
    		<div class="organizer-rating"
    		    data-rater="<?php echo $rating->rater->username ?>"
    	        data-ratee=""
    	        data-action=""
    	        data-value="<?php echo $rating->value; ?>"
    	        data-comment="<?php echo $rating->comment; ?>"
    	        data-widget-style="1">
    	    </div>
            <?php } ?>
            
        <?php } else { ?>
        	<span class="label">Rating Not Available</span>
        <?php } ?>
	  </div>
  	  
  	  </div>
	  

      
    </div>
  </div>
</div>