<div id="perfumeDialog" title="Add Perfume">
<div id="perfume_success" class="ui-widget" style="display: none; ; font-size:50%;">
	<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span>
		<strong>Success!</strong></p>
	</div>
</div>
<div class="ui-widget"  id="perfume_alert" style="display: none; font-size:50%;">
	<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">
		<p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>
		<strong>Failed!</strong></p>
	</div>
</div>
<form id="perfumeform" enctype="multipart/form-data" method="Post">
Enter Perfume Information<br>
<fieldset>
<label for="category">Category</label>
<select name="category" id="template_category" class="text ui-widget-content ui-corner-all" >
</select>
<br>
<label for="name">Name</label>

<input type="text" name="name" id="template_name" class="text ui-widget-content ui-corner-all" />
<br>
<label for="picture">Picture</label>

<div id="template_progressbar" style="display: none"></div>
<input type="file" name="file" id="template_picture" class="text ui-widget-content ui-corner-all" />
<input type="hidden" name="filename" id="template_filename" />
<br>
<label for="discontinue">Discontinued</label>

<input type="checkbox" name="discontinued" id="template_discontinued" class="text ui-widget-content ui-corner-all" />
<br>
<label for="rating">Rating</label>

<input  name="rating" id="perfume_rating" class="text ui-widget-content ui-corner-all" />
<br>
<div style="display: inline-block"><label for="imps">Imps</label>
<input type="text" name="imps" id="perfume_imps" size=2 class="text ui-widget-content ui-corner-all" /></div>
<br>
<div style="display: inline-block"><label for="bottles">Bottles</label>
<input type="text" name="bottles" id="perfume_bottles"  size=2 class="text ui-widget-content ui-corner-all" /></div>
<br>
<label for="status">Swappable</label>

<input type="checkbox" name="status" id="perfume_status" class="text ui-widget-content ui-corner-all" />
<br> 
<label for="location">Location</label>

<input type="text" name="location" id="perfume_location" class="text ui-widget-content ui-corner-all" />
<br>
<label for="description">Scent Notes</label>

<textarea  name="description" id="template_description" class="text ui-widget-content ui-corner-all" ></textarea>
<br>
<label for="notes">Extra Info</label>

<textarea  name="notes" id="perfume_notes" class="text ui-widget-content ui-corner-all" ></textarea>
</fieldset>
</form>
</div>