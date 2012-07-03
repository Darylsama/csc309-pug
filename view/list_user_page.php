<div class="container-fluid">
  <div class="row-fluid">

	<!-- side bar-->
	<?php include "view/sidebar.php" ?>
	
	<script>
		var friends = new Array();
		var users = new Array();
		var friendshref = new Array();
		var usershref = new Array();
		
		
		<?php foreach ($this->page["users"] as $user) { ?>
			
			users.push("<?php echo $user->username; ?>");
			usershref.push("view_user.php?uid=<?php echo $user->uid; ?>");
		<?php } ?>	
		<?php foreach ($this->page["friends"] as $user) { ?>

			friends.push("<?php echo $user->username; ?>");
			friendshref.push("view_user.php?uid=<?php echo $user->uid; ?>");
		<?php } ?>
		

		
		function list_users() {
			var table = document.getElementById("1");

			var content = "";
			for (var i = 0; i < users.length; i++){
				content = content.concat("<tr><td><a href=");
				content = content.concat(usershref[i]);
				content = content.concat(">");
				content = content.concat(users[i]);
				content = content.concat("</a></td></tr>");
			};
			table.innerHTML = content;
		};
		
		function list_friends() {
		
			var table = document.getElementById("1");
			var content = "";
			for (var i = 0; i < friends.length; i++){
				content = content.concat("<tr><td><a href=");
				content = content.concat(friendshref[i]);
				content = content.concat(">");
				content = content.concat(friends[i]);
				content = content.concat("</a></td></tr>");
			};
			table.innerHTML = content;
			
		};
	</script>
	<div class="span10">
		
		
		
		<input type=buton class="btn btn-primary" value="all users" onclick="list_users()"/>
		<input type=buton class="btn btn-primary" value="friends" onclick="list_friends()"/>
		
		
		<br/>
		<br/>
		
		<table>
        <thead>
          <tr>
            <th>User Name</th>
          </tr>
        </thead>
        <tbody id="1">
          <?php foreach ($this->page["users"] as $user) { ?>
          <tr>
          	<td><a href="view_user.php?uid=<?php echo $user->uid; ?>"><?php echo $user -> username; ?>
            </a></td>
          </tr>
          <?php } ?>
        </tbody>

      </table>
		
		
	</div>
	
	
	
  </div>
</div>
