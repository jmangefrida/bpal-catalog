<div id="perfumeUpdateDialog" title="Update Perfume">
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
<form id="perfumeUpdateForm" enctype="multipart/form-data" method="Post">
Update Perfume Information<br>
<fieldset>
<select name="id" id="perfumeUpdateSelect">
<option>Select a Perfume</option>
 </select>
 <br>
<label for="category">Category</label>

<select name="category" id="perfumeUpdateCategory" class="text ui-widget-content ui-corner-all" >
</select>
<br>
<label for="name">Name</label>

<input type="text" name="name" id="perfumeUpdateName" class="text ui-widget-content ui-corner-all" />
<br>
<label for="picture">Picture</label>

<div id="perfumeUpdateProgressbar" style="display: none"></div>
<input type="file" name="file" id="template_picture" class="text ui-widget-content ui-corner-all" />
<input type="hidden" name="filename" id="perfumeUpdateFilename" />
<br>
<label for="discontinued">Discontinued</label>
<input type="checkbox" name="discontinued" id="perfumeUpdateDiscontinued" class="text ui-widget-content ui-corner-all" />
<br>

<label for="rating">Rating</label>

<input type="text" name="rating" id="perfumeUpdateRating" class="text ui-widget-content ui-corner-all" />
<br>
<div style="display: inline-block"><label for="imps">Imps</label>
<input type="text" name="imps" id="perfumeUpdateImps" size=2 class="text ui-widget-content ui-corner-all" /></div>
<br>
<div style="display: inline-block"><label for="bottles">Bottles</label>
<input type="text" name="bottles" id="perfumeUpdateBottles"  size=2 class="text ui-widget-content ui-corner-all" /></div>
<br>
<label for="status">Swappable</label>

<input type="checkbox" name="status" id="perfumeUpdateStatus" class="text ui-widget-content ui-corner-all" />
<br>
<label for="location">Location</label>

<input type="text" name="location" id="perfumeUpdateLocation" class="text ui-widget-content ui-corner-all" />
<br>
<label for="description">Scent Notes</label>

<textarea  name="description" id="perfumeUpdateDescription" class="text ui-widget-content ui-corner-all" ></textarea>
<br>
<label for="notes">extra Info</label>

<textarea  name="notes" id="perfumeUpdateNotes" class="text ui-widget-content ui-corner-all" ></textarea>
</fieldset>
</form>
</div>
