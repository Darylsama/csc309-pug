
  <div class="row-fluid content-wrapper">

    <div class="span5"></div>
  
    <div class="span6 login-panel">
    
      <div class="hero-unit">
        <h2>Login</h2>
        <span>Sign in using your registered account:</span>
        <hr />

        <form id="login" name="login" action="login.php" method="post">
		  <div class="input-prepend">
              <span class="add-on"><i class="icon-user"></i>
    	  	  </span><input name="username" id="username" type="text" class="input-large" placeholder="Username" />
          </div>
          <div class="input-prepend">
          
          <span class="add-on"><i class="icon-lock"></i>
          </span><input name="password" id="password" type="password" class="input-large" placeholder="Password" />
		  </div>

          <label class="checkbox">Remember me<input type="checkbox" id="rmme"></label>
          <!-- right now broken --> 
          <br />
           
		  <input type="submit" id="loginbtn" class="btn btn-warning btn-medium" value="Log In" />
          <a class="btn btn-primary btn-medium" id="signupbtn" href="register.php">Signup now!</a>

        </form>
      </div>
      
    </div>
  </div>

