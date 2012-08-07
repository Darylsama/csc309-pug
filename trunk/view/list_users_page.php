<div class="container-fluid">
  <div class="row-fluid content-wrapper">

	<!-- side bar-->
	<?php include "view/sidebar.php" ?>
	

	
	
	<div class="span9 content">
	
	    <div class="row-fluid">
	        <div class="span6">
            <h2>List Users</h2>
	        </div>
            
            <div class="span6">
            	<fieldset class="switch">
            		<legend>View: </legend>
            		
            		<input id="all" name="view" type="radio" checked>
            		<label for="all">All</label>
            
            		<input id="friends" name="view" type="radio">	
            		<label for="friends">Friends</label>
            		
            		<span class="switch-button"></span>
        		</fieldset>
            </div>
	    </div>

		<br/>
		<br/>
		
		<table id="user_table">
        <thead>
          <tr>
            <th>User Name</th>
            <th>Player Rating</th>
            <th>Organizer Rating</th>
          </tr>
        </thead>
        <tbody>
        </tbody>

      </table>
      
	</div>
  </div>
</div>
