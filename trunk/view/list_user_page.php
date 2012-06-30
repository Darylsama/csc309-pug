<div class="container-fluid">
  <div class="row-fluid">

	<!-- side bar-->
	<?php include "view/sidebar.php" ?>
	
	<div class="span10">
		<input type=buton class="btn btn-primary" value="all users"/>
		<input type=buton class="btn btn-primary" value="firends"/>
		<br/>
		<br/>
		
		<table>
        <thead>
          <tr>
            <th>User Name</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($this->page["users"] as $user) { ?>
          <tr>
          	<td><a href="view_user.php?gid=<?php echo $user->uid; ?>"><?php echo $user -> username; ?>
            </a></td>
          </tr>
          <?php } ?>
        </tbody>

      </table>
		
		
	</div>
	
	
	
  </div>
</div>
