
<table class="table table-striped table-bordered table-condensed">
	<thead>
		<tr>
			<th>name</th>
			<th>description</th>
			<th>action</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($this->page["sports_info"] as$sport) {?> 
			<tr>
				<td><?php echo $sport["name"] ?></td>

				<td><?php echo $sport["description"]?></td>		
				<td><button class="btn btn-danger" onClick="">delete</button></td>
			</tr>
		<?php } ?>
	</tbody>



</table>