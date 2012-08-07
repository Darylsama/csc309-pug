
  <div class="row-fluid content-wrapper">
  	<br/>
	<br/>
    <div class="span4" ></div>
    <!-- some padding -->

    <div class="span3">
      <div class="hero-unit">
		
        <h2>PUG Login page</h2>
        <hr/>
        <p>
          Please Login to join our games
        </p>

        <form id="login" name="login" action="login.php" method="post">

          <input name="username" id="username" type="text" class="input-large" placeholder="Username" />
          <input name="password" id="password" type="password" class="input-large" placeholder="Password" />

		  <span class="pull-right">
            <input type="submit" id="loginbtn" class="btn btn-warning btn-large" value="Log In" />
		  </span>
		  <br/>
          	<label class="checkbox"> Remember me       
           		<input type="checkbox" id="rmme">
            	<!-- right now broken --> </label>
		  <br/>
		  <hr/>
          <p>
            No accounts? Signup for one
          </p>

          <p>
            <a class="btn btn-primary btn-large" id="signupbtn" href="register.php">Signup now!</a>
          </p>

        </form>

      </div>
    </div>
    <div class="span4" ></div>
    <!-- some padding -->
  </div>

