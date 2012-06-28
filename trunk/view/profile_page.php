<div class="container-fluid">
  <div class="row-fluid">

    <!-- sidebar -->
    <div class="span2">
      <ul class="nav nav-pills nav-stacked">
        <li>
          <a href="#"> Create New Game </a>
        </li>
        <li>
          <a href="#"> Browse Existing Games </a>
        </li>
        <li>
          <a href="#"> View Users </a>
        </li>
      </ul>
    </div>

    <div class="span10">
        
        
      <ul class="nav nav-tabs">
        <li class="active">
          <a href="#">Profile</a>
        </li>
      </ul>
      
      
      <h2>Username: <?php echo get_loggedin_user()->username; ?></h2>
      <h2>Real Name: <?php echo get_loggedin_user()->firstname . " " . get_loggedin_user()->lastname;?></h2>
    </div>

  </div>
</div>