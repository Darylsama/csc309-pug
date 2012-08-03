<hr/>
<br/>
<div>
sport name<br/>

<form>
<input id="name" type="text" value= '<?php echo $this->page["name"]?>'/>
<br/>
description<br/>
<textarea id="description" style='width: 632px; height: 50px;'>
<?php echo $this->page["description"]?>
</textarea>
<br/>

</form>
<button class="btn btn-primary" onClick="update_sport(<?php echo $this->page["sid"] ?>)">update sport</button>
<button class="btn btn-success" onClick="get_manage_sports()">go back</button>
	
</div>