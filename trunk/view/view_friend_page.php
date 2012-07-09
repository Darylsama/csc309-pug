<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>

	<script>
			function submit() {
				document.give_rates.submit();
			}
	</script>
    <div class="span10">
    	
    
    			
		<?php echo $this->page["user"]->username; ?>
		<?php echo $this->page["user"]->uid ?>
		<br/>
		<br/>
		<?php 
			echo "The average rate of this user as a player:<br/>";
			if (isset($this->page["player_rates"])){	
				echo $this->page["player_rates"];
				echo "<br/>";
			}		
			else{
				echo "This user hasn't been rated as players by other users yet.";
			}
		?>
		
		<?php
		if ($this->page["rate_player_before"]){
			echo "You have given rates to this friend as a player before. <br/>";
		}
		else {
			echo '<form name="myform" method="POST" action="rate_friend_as_player.php?">
			<select name="value">
			<option>0</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			</select>
			<input type=hidden name="ratee" value=';
			echo $this->page["user"]->uid;
			echo ">";
			echo '<input type=button value="submit" onClick="submit()"/>
			</form>';}
		?>
		<br/>
		
		<?php echo "The average rates of this user as an organizer: <br/>"?>
		<?php 
			if (isset($this->page["organizer_rates"])){
				echo $this->page["organizer_rates"];
			}
			else {
				echo "This user hasn't been rated as organizer yet.";
			}
		?>
		<br/>
		<?php
		if (!$this->page["can_rate_organizer"]) {
			echo "You can not rate this friend as an organizer untill you have joined a game organized by this friend. <br/>";
		}
		else if ($this->page["rate_organizer_before"]){
			echo "You have given rates to this friend as an organizer before. <br/>";
		}
		else {
			echo '<form name="myform" method="POST" action="rate_friend_as_organizer.php?">
			<select name="value">
			<option>0</option>
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<option>4</option>
			<option>5</option>
			<option>6</option>
			<option>7</option>
			<option>8</option>
			<option>9</option>
			<option>10</option>
			</select>
			<input type=hidden name="ratee" value=';
			echo $this->page["user"]->uid;
			echo ">";
			echo '<input type=button value="submit" onClick="submit()"/></form>';
		}
		?>
		<br/>	
		
		
		
		
		
		
		
		
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

    </div>
  </div>
</div>