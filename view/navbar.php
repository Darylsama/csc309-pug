<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">

		<div class="container">

			<!-- title -->
			<a class="brand" href="profile.php">Pick-up Games</a>

			<!-- logout -->
			
			
			<?php if (get_loggedin_user() != null) { ?>
			<ul class="nav nav-pills pull-right">
			  <li class="dropdown" id="menu1">
			    
			    <a class="dropdown-toggle" data-toggle="dropdown" href="#menu1"><?php echo get_loggedin_user()->username ?><b class="caret"></b>
			    </a>
			
			    <ul class="dropdown-menu">
			      <li><a href="edit_profile.php">Edit Profile</a></li>
			      <li class="divider"></li>
			      <li><a href="delete_account.php">Delete your account</a></li>
			      <li><a href="logout.php">Logout</a></li>
			    </ul>
			    
			  </li>
			</ul>
			<?php } ?>
			

</li>
			
		</div>

	</div>
</div>
