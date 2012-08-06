<div class="container-fluid">
  <div class="row-fluid content-wrapper">

	<!-- side bar-->
	<?php include "view/sidebar.php" ?>
	
	<script>
		var friends = new Array();
		var users = new Array();
		var friendshref = new Array();
		var usershref = new Array();
		
		
		<?php foreach ($this->page["user_info"] as $uid=>$user) { ?>
			
			users.push("<?php echo $user["username"]; ?>");
			usershref.push("profile.php?uid=<?php echo $uid; ?>");
		<?php } ?>	
		<?php foreach ($this->page["friend_info"] as $uid=>$user) { ?>

			friends.push("<?php echo $user["username"]; ?>");
			friendshref.push("profile.php?uid=<?php echo $uid; ?>");
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
	<div class="span9 content">
		
		
		
		<input type=buton class="btn btn-primary" value="all users" onclick="list_users()"/>
		<input type=buton class="btn btn-primary" value="friends" onclick="list_friends()"/>
		
		
		<br/>
		<br/>
		
		<table id="user_table">
        <thead>
          <tr>
            <th>User Name</th>
            <th>Player Rating</th>
            <th>Organizer Rating</th>
          </tr>
        </thead>
        <tbody id="1">
          <?php foreach ($this->page["user_info"] as $uid=>$user) { ?>
          <tr>
          	<td><a href="profile.php?uid=<?php echo $uid; ?>"><?php echo $user["username"]; ?>
            </a></td>
            <td><?php echo $user["player_rates"]; ?></td>
            <td><?php echo $user["organizer_rates"]; ?> </td>
          </tr>
          <?php } ?>
        </tbody>

      </table>
		
		
	</div>
	
	
	
  </div>
</div>
