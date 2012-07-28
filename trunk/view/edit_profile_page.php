<div class="container-fluid">
	<div class="row-fluid">
		
		
		
    	<!-- sidebar -->
    	<?php include "view/sidebar.php"?>


		<!-- register form -->
		<div class="span9 hero-unit">
			<?php 
				if (isset($this->page["err"])){
					echo "<div class='alert alert-error'>";
					echo $this->page["err"];
					echo  "</div>";
				}
				
			?>
			<form method="post" action="update_profile.php" name="update_profile" class="form-horizontal">
				<fieldset>

					<legend>Please submit the following information:</legend>
					<!-- title -->

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