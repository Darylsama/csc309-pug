
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>game name</th>
			<th>organizer</th>
			<th>start time</th>
			<th>end time</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->page["game_info"] as $gid=>$game) {?> 
			<tr>
				<td><?php echo $game["name"] ?></td>
				
				<td><?php echo $game["organizer"] ?></td>
				<td><?php echo $game["start_time"] ?></td>
				<td><?php echo $game["end_time"]?></td>		
			</tr>
		<?php } ?>
	</tbody>



</table>