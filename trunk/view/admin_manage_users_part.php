
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>Username</th>
			<th>Interested game</th>
			<th>Joined game</th>
			<th>Organizered game</th>
			<th>Friends</th>
			<th>organizer rate</th>
			<th>player rate</th>
			<th>type</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->page["users_information"] as $uid=>$user) {?> 
			<tr>
				<td><?php echo $user["username"] ?></td>
				<td><?php echo $user["interested_games"]?></td>
				<td><?php echo $user["joined_games"]?></td>
				<td><?php echo $user["organized_games"]?></td>
				<td><?php echo $user["friends"]?></td>
				<td><?php echo $user["organizer_rates"]?></td>
				<td><?php echo $user["player_rates"]?></td>
				
				<td><?php  if ($user["type"] == 2){
						echo "Admin";
					}
					else{
						echo "Normal";
					} ?>
				</td>
				<td><span class="label" onClick="delete_user(<?php echo $uid?>)">delete user</span></td>		
			</tr>
		<?php } ?>
	</tbody>



</table>