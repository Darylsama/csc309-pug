
<div class="container-fluid">
  <div class="row-fluid content-wrapper">
    
    <?php include "view/sidebar.php" ?>
    
    <div class="span9 content">
   		<h2><?php echo "Message box" ?>     
      	</h2>		
    
    	<div class="btn">
    	
    		<button class="btn btn-primary" onClick="get_receive_messages()">
    			received messages
    		</button>
    		<button class="btn btn-info" onClick="get_send_messages()">
    			sent messages
    		</button>
			
   		</div>
   		<br/>
   		<hr/>
   		<br/>
   		<div id="main-part">	
 
    	
    	
   
    	</div>
    </div>
   
  </div>
</div>