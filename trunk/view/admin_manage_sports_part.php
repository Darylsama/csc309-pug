
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>name</th>
			<th>description</th>

		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->page["sports_info"] as $sid=>$sport) {?> 
			<tr onClick="edit_sport(<?php echo $sid ?>)">
				<td><?php echo $sport["name"] ?></td>

				<td><?php echo $sport["description"]?></td>		
			</tr>
		<?php } ?>
		<tr onClick="">
			<td></td>
			<td>click to add sport</td>
		</tr>
	</tbody>



</table>