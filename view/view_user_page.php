<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>

    <div class="span9 content">

		<h2><?php echo $this->page["user"]->username; ?></h2>
		
		<hr />
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
		<?php 
			echo "The average rates as a player:<br/>";
			if (isset($this->page["player_rates"])){
				echo $this->page["player_rates"];
				echo "<br/>";
			}		
			else{
				echo "<div class='alert alert-info' style='width:600px;'>" .
						"<button type='button' class='close' data-dismiss='alert'>&times;</button>" .
						"This user hasn't been rated as a player by other users yet." .
						"</div>" .
						"<br/>";
			}
		?>
		<?php echo "<div class='alert' style='width:600px;'> " .
				"<button class='close' data-dismiss='alert'>&times;</button>" .
				"You can not give this user any rate until you two become friend." .
				"</div>" .
				"<br/>"?>
		
		<?php 
			echo "The average rates as an organizer:<br/>";
			if (isset($this->page["organizer_rates"])){
				echo $this->page["organzier_rates"];
				echo "<br/>";
			}		
			else{
				echo "<div class='alert alert-info' style='width:600px;'>" .
						"<button type='button' class='close' data-dismiss='alert'>&times;</button>" .
						"This user hasn't been rated as an organizer by other users yet." .
						"</div>" .
						"<br/>";
			}
		?>
		<?php echo "<div class='alert' style='width:600px;' > " .
				"<button class='close' data-dismiss='alert'>&times;</button>" .
				"You can not give this user any rate until you join the game organized by this user before." .
				"</div>" .
				"<br/>"?>
      

    </div>
  </div>
</div>