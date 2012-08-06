<div class="container-fluid">
	<div class="row-fluid content-wrapper">
		
		
		
    	<!-- sidebar -->
    	<?php include "view/sidebar.php"?>
        
		<!-- register form -->
		<div class="span6 content">
		
		
		
			<?php 
				if (isset($this->page["err"])){
					echo "<div class='alert alert-error'>";
					echo $this->page["err"];
					echo  "</div>";
				}
				
			?>
			
			<form method="post" action="update_profile.php" name="update_profile" class="form-horizontal">
				<fieldset>

					<legend>Edit Profile</legend> <br />
					<!-- title -->

					
					
					<h3>General Information</h3><br />
					
					<div class="control-group">
						<label class="control-label" for="username-input">Username</label>
						<div class="controls">
							<input id="username-input" class="input-xlarge" name="username" type="text" value="<?php echo $this->page["username"];?>"/>
						</div>
					</div>
					<!-- username -->
					
					<div class="control-group">
						<label class="control-label" for="firstname-input">First Name</label>
						<div class="controls">
							<input id="firstname-input" class="input-xlarge" name="firstname" type="text" value="<?php echo $this->page["firstname"];?>"/>
						</div>
					</div>
					<!-- firstname -->
					
					<div class="control-group">
						<label class="control-label" for="lastname-input">Last Name</label>
						<div class="controls">
							<input id="lastname-input" class="input-xlarge" name="lastname" type="text" value="<?php echo $this->page["lastname"];?>" />
						</div>
					</div>
					<!-- lastname -->
					<hr />
					
					
					
					
					<h3>Password</h3><br />
					<div class="control-group">
						<label class="control-label" for="oldpass-input">Old Password</label>
						<div class="controls">
							<input id="oldpass-input" class="input-xlarge" name="oldpass" type="password" value=""/>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="newpass-input">New Password</label>
						<div class="controls">
							<input id="newpass-input" class="input-xlarge" name="newpass" type="password" value=""/>
						</div>
					</div>
					
					<div class="control-group">
						<label class="control-label" for="confirm-input">Confirm</label>
						<div class="controls">
							<input id="confirm-input" class="input-xlarge" name="confirm" type="password" value=""/>
						</div>
					</div>
					
					<hr />
					
					
					
					<h3>Manage Sports</h3><br />
					<div class="row-fluid">
    					
    					<div id="user-sports" class="span6" >
        					<ul class="nav nav-list">
                              <li class="nav-header">My Sports</li>
                              <?php foreach ($this->page["current_sports"] as $sport) { ?>
                                <li data-sid="<?php echo $sport->sid ?>" style="cursor:hand; cursor:pointer;" ><?php echo $sport->name ?></li>
                              <?php } ?>
                            </ul>
    					</div>
    					
					    <div id="available-sports" class="span6" >
        					<ul class="nav nav-list">
                              <li class="nav-header">Available Sports</li>
                              <?php foreach ($this->page["all_sports"] as $sport) {
                              	if (!in_array($sport, $this->page["current_sports"])){ ?>
                        	  	<li data-sid="<?php echo $sport->sid ?>" style="cursor:hand; cursor:pointer;" ><?php echo $sport->name ?></li>
                              	<?php } 
                              }?>
                            </ul>
    					</div>
    					
    					<div id="sports-queue"></div>
    					
					</div>
					
					<hr />
					
					<div class="control-group">
						<input type="submit" class="btn btn-primary pull-right" value="update profile" />
					</div>
					<!-- submit -->
				</fieldset>
				
				
			</form>
		</div>
		<div class="span6" ></div>
		<!-- some padding -->
	</div>
</div>