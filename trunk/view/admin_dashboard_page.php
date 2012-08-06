
<div class="container-fluid">
  <div class="row-fluid content-wrapper">
    
    <?php include "view/sidebar.php" ?>
    
    <div class="span9 content">
   		<h2><?php echo "Administrator" ?>     
      	</h2>		
    
    	<div class="btn">
    		<button class="btn btn-primary" onClick="get_manage_users()">
    			manage users
    		</button>
    		<button class="btn btn-info" onClick="get_manage_games()">
    			manage games
    		</button>	
    		<button class="btn btn-success" onClick="get_manage_sports()">
    			manage sports
    		</button>
			<button class="btn btn-warning" onClick="get_manage_system()">
				manage system
			</button>
			<button class="btn btn-danger">
				send announcement
			</button>
			
   		</div>
   		<br/>
   		<hr/>
   		<div id="main-part">	
 
    	
    	
   
    	</div>
    </div>
   
  </div>
</div>