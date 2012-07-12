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
    <div class="span10">
		
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
		
		<?php if (isset($this->page["player_rates"])){ ?>
		    <span>The average rate of this user as a player: <?php echo $this->page["player_rates"];?> </span>
		<?php } else {?>
		    <span>This user hasn't been rated as players by other users yet</span>
		<?php } ?>
		<br />
		<?php if ($this->page["rate_player_before"]) { ?>
			<span>You have given rates to this friend as a player before</span>
		<?php } else { ?>
			<form name="myform" method="post" action="rate_friend_as_player.php?">
			<select name="value">
                <?php for ($i = 1; $i <= 5; $i++ ) { ?>
                <option><?php echo $i ?></option>
                <?php } ?>
            </select>

			<input type="hidden" name="ratee" value="<?php echo $this->page["user"]->uid; ?>" >
			<input type="button" value="submit" onClick="submit()"/>
			</form>
		<?php } ?>
		
		
		
		<?php if (isset($this->page["organizer_rates"])) { ?>
		    <span>The average rates of this user as an organizer: <?php echo $this->page["organizer_rates"]; ?></span>
		<?php } else { ?>
		    <span>This user hasn't been rated as organizer yet</span>
		<?php } ?>
		<br />
		<?php if (!$this->page["can_rate_organizer"]) { ?>
			<span>You can not rate this friend as an organizer untill you have joined a game organized by this friend</span>
		<?php } else if ($this->page["rate_organizer_before"]) { ?>
			<span>You have given rates to this friend as an organizer before</span>
		<?php } else { ?>
			<form name="myform" method="POST" action="rate_friend_as_organizer.php?">
			<select name="value">
                <?php for ($i = 1; $i <= 5; $i++ ) { ?>
                <option><?php echo $i ?></option>
                <?php } ?>
            </select>
			<input type="hidden" name="ratee" value="<?php $this->page["user"]->uid ?>" />
			<input type="button" value="submit" onClick="submit()"/>
		    </form>
		<?php } ?>

		
    </div>
  </div>
</div>