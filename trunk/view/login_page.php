<div class="container-fluid">
  <div class="row-fluid">
    <div class="span2" ></div>
    <!-- some padding -->

    <div class="span8">
      <div class="hero-unit">

        <h1>PUG Login page</h1>
        <p>
          Please Login to join our games
        </p>

        <form id="login" name="login" action="login.php" method="post">

          <input name="username" id="username" type="text" class="input-small" placeholder="Username" />
          <input name="password" id="password" type="password" class="input-small" placeholder="Password" />

          <label class="checkbox"> Remember me
            <input type="checkbox" id="rmme">
            <!-- right now broken -->
          </label>

          <p>
            <input type="submit" id="loginbtn" class="btn btn-primary btn-large" value="Log In" />
          </p>

          <p>
            No accounts? Signup for one
          </p>

          <p>
            <a class="btn btn-primary btn-large" id="signupbtn" href="register.php">Signup now!</a>
          </p>

        </form>

      </div>
    </div>
    <div class="span2" ></div>
    <!-- some padding -->
  </div>
</div>
