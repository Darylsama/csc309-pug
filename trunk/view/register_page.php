<html>
	<head>
		<title>Register</title>
	</head>

	<body>
	<form method="post" action="register.php" name="test">
	<br /><span class="label">username</span><input name="username" type="text">
	<br /><span class="label">password</span><input name="password" type="password">
	<br /><span class="label">permission</span><input name="permission" type="text">
	<br /><span class="label">firstname</span><input name="firstname" type="text">
	<br /><span class="label">lastname</span><input name="lastname" type="text">
	<input type="submit" ></input>
	</form>

	<?php if (isset($user)) var_dump($user); ?>

</body>
</html>