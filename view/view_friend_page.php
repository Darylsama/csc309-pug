<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>

	<script>
    // TODO: move this to a separate js file
			function submit() {
				document.give_rates.submit();
			}
	</script>
    <div class="span9">
		
		<h1><?php echo $this->page["user"]->username; ?></h1>
		<!-- <?php echo $this->page["user"]->uid ?> -->

		<hr />
		<h2>Games</h2>
				
		<table>
        	<thead>
        		<tr><?php echo "Joined game list:<br/>"?></tr>
        	</thead>
			<tbody>
			<?php foreach ($this->page["joined_game"] as $gid => $name) { ?>
        	  	<tr>
        	    <td><a href="view_game.php?gid=<?php echo $gid; ?>"><?php echo $name; ?>
          		</a></td>
          		</tr>
          	<?php } ?>
			</tbody>
		</table>
		<br/>
		<br/>
		<table>
			<thead>
				<tr><?php echo "Interested game list:<br/>"?></tr>
			</thead>
			<tbody>
			<?php foreach ($this->page["interested_game"] as $gid => $name) { ?>
          	<tr>
            	<td><a href="view_game.php?gid=<?php echo $gid; ?>"><?php echo $name; ?>
            	</a></td>
          	</tr>
          	<?php } ?>
       		</tbody>
       	</table>
		<br/>
		<br/>
		<table>
			<thead><tr></tr><?php echo "organized game list:<br/>"?></tr></thead>
			<tbody>
				<?php foreach ($this->page["organized_game"] as $game) { ?>
				<tr>
					<td>
						<a href="view_game.php?gid=<?php echo $game->gid?>">
							<?php echo $game->name?>
						</a>
					</td>
				</tr>	
				<?php } ?> 
			</tbody>
		</table>
		<br/>
		<br/>

		<hr />

		<h2>Ratings</h2>
		
	    <h3>Average Rating as Player: </h3>
		<?php if (isset($this->page["player_rates"])){ ?>
		<div class="player-rating-avg"
	        data-ratee=""
	        data-action=""
	        data-value="<?php echo $this->page["player_rates"];?>"
	        data-comment=""
	        data-widget-style="0">
        </div>
		<?php } else {?>
		    <div class='alert alert-info' style='width:600px;'> 
			<button type='button' class='close' data-dismiss='alert'>&times;</button>
			This user hasn't been rated as a player by other users yet.
			</div>
			</span>
		<?php } ?>
		
		<h3>Your Rating for This Player: </h3>
		<?php if ($this->page["rate_player_before"]) { ?>
	    <!-- change this to actual rating? -->
		<span>
		<div class='alert alert-success' style='width:600px;' >
		<button class='close' data-dismiss='alert'>&times;</button>
		You have given rates to this friend as a player before
		</div>
		<br/>
		</span>
		<?php } else { ?>
		<div class="player-rating-user"
	        data-ratee="<?php echo $this->page["user"]->uid; ?>"
	        data-action="rate_friend_as_player.php"
	        data-value="0"
	        data-comment=""
	        data-widget-style="2">
	     </div>
		<?php } ?>
		
		
	
	    <h3>Average Rating as Organizer:</h3>
		<?php if (isset($this->page["organizer_rates"])) { ?>
		<div class="organizer-rating-avg"
	        data-ratee=""
	        data-action=""
	        data-value="<?php echo $this->page["organizer_rates"]; ?>"
	        data-comment=""
	        data-widget-style="0">
        </div>
		<?php } else { ?>
		<!-- let the user be the first one rating this? -->
	    <div class='alert alert-info' style='width:600px;'> 
		<button type='button' class='close' data-dismiss='alert'>&times;</button>
		This user hasn't been rated as an organizer by other users yet.
		</div>
		
		</span>
		<?php } ?>
		
		
		<?php if (!$this->page["can_rate_organizer"]) { ?>
			<span><div class='alert' style='width:600px;' >
				<button class='close' data-dismiss='alert'>&times;</button>
				You can not give this user any rate until you join the game organized by this user before.
				</div>
				<br/>
			</span>
		<?php } else if ($this->page["rate_organizer_before"]) { ?>
		<!-- change this to actual rating? -->
		<span>
		<div class='alert alert-success' style='width:600px;' >
		<button class='close' data-dismiss='alert'>&times;</button>
		You have given rates to this friend as an organizer before
		</div>
		<br/>
		</span>
		<?php } else { ?>
		<div class="organizer-rating-user"
	        data-ratee="<?php echo $this->page["user"]->uid; ?>"
	        data-action="rate_friend_as_organizer.php?"
	        data-value="0"
	        data-comment=""
	        data-widget-style="2">
	    </div>
		<?php } ?>

		
    </div>
  </div>
</div>