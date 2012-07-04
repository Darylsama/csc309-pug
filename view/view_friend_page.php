<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <?php include "view/sidebar.php" ?>


    <div class="span10">
    	
    
    			
		<?php echo $this->page["user"]->username; ?>
		<?php echo $this->page["user"]->uid ?>
		<br/>
		<br/>
		<?php 
			echo "The average rates as a player:<br/>";
			if (isset($this->page["rating"])){	
				echo $this->page["rating"];
			}		
			else{
				echo "This user hasn't been rated as users by other users yet.";
			}
		?>
		<script>
			function submit() {
				document.give_rates.submit()
			}
		</script>
		<form name="myform" method="POST" action="rate_friend.php?">
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
		<input type=hidden name="ratee" value=<?php echo $this->page["user"]->uid?>>
		<input type=button value="submit" onClick="submit()"/>
		</form>
		<br/>
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