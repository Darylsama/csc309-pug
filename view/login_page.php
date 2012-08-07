
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
		  <div class="input-prepend">
          <span class="add-on">
			<i class="icon-user"></i>
	  	  </span><input name="username" id="username" type="text" class="input-large" placeholder="Username" />
          </div>
          <div class="input-prepend">
          <span class="add-on">
			<i class="icon-star"></i>
		  </span><input name="password" id="password" type="password" class="input-large" placeholder="Password" />
		  </div><input type="submit" id="loginbtn" class="btn btn-warning btn-medium" value="Log In" style="float: right"/>

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

