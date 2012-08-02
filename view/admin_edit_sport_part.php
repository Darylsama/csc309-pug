<hr/>
<br/>
<div>
sport name<br/>
<form >
<input type="text" value= '<?php echo $this->page["name"]?>'/>
<br/>
description<br/>
<textarea style='width: 632px; height: 50px;'>
<?php echo $this->page["description"]?>
</textarea>
<br/>
<input type="submit" class="btn btn-primary" value="update sport"/>


</form>

<button class="btn btn-danger">delete sport</button>
<button class="btn btn-success">go back</button>
	
</div>