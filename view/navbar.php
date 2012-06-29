<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">

		<div class="container">

			<!-- title -->
			<a class="brand" href="profile.php">Pick-up Games</a>

			<!-- logout -->
			<ul class="nav pull-right">
				<?php if (get_loggedin_user() != null) { ?>
				<li><a href="logout.php">Logout</a>
				</li>
				<?php } ?>
			</ul>
		</div>

	</div>
</div>
