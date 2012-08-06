
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>game name</th>
			<th>organizer</th>
			<th>start time</th>
			<th>end time</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->page["game_info"] as $gid=>$game) {?> 
			<tr>
				<td><?php echo $game["name"] ?></td>
				
				<td><?php echo $game["organizer"] ?></td>
				<td><?php echo date("M j, Y G:00", $game["start_time"]) ?></td>
				<td><?php echo $game["duration"]?></td>		
				<td><span class="label" onClick="delete_game(<?php echo $gid;?>)">delete game</span></td>
			</tr>
		<?php } ?>
	</tbody>



</table>