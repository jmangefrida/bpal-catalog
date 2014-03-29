
var currentPerfume;
var editPerfume;

setInterval(function(){heartbeat()},30000);

function heartbeat(){
	$.getJSON("http://cpuoftheheart.com/bpal2/code/keepalive.php",
			function(result) {
					if(result != 1) {
						window.location = "http://cpuoftheheart.com/bpal2";
					}
					//alert(result);
				})
}

$(document).ready(function() { 
	

	
	$('#square').on('click', 'div', function(event) {
		currentPerfume = $(this).attr('id');
		fillBox(currentPerfume);
		$perfumeshadowbox.dialog( "open" );
		
		//alert('test');
	});
	
	$('#perfumeUpdateDialog').on('change','select[id=perfumeUpdateSelect]', function() {
		populatePerfumeUpdateDialog($('select[id=perfumeUpdateSelect]').val())
	});
	
	$('#templateUpdateDialog').on('change','select[id=templateUpdateSelect]', function() {
		populateTemplateUpdateDialog($('select[id=templateUpdateSelect]').val())
	});
	
	$('#search').keyup(function() {
		searchFilter($('#search').val());
	});
	
	
	$('body').on('change', '#sort', function() { listRefresh($('#sort').val()); });
	$('body').on('change', '#swappable', function() { listRefresh($('#sort').val()); });
	$('body').on('change', '#discontinued', function() { listRefresh($('#sort').val()); });
	
	$.getJSON("http://cpuoftheheart.com/bpal2/code/getList.php",
			function(result) {
				$.each(result.perfume,function(index, perfume){
					var newRow = $('.listTemplate').clone().removeClass('listTemplate').addClass('listItem').attr('id', perfume.id);
					template(newRow,perfume).appendTo('#square').fadeIn();				
				})
				
			});
	$("div.listItem").on("mouseover", function() {
		$(this).css('background-color', '#ffffff');
	});
	
	$("div.listItem").hover(function() {
			
			$(this).css("border-color","#FF0000");
		},
		function() {
			$(this).css("border-color","#000000");
		});
	
//	$( "#addCategory").click(function() {
//		$dialog.dialog( "open" );
//	});
//	$( "#addTemplate").click(function() {
//		$templateDialog.dialog( "open" );
//	});
//	$( "#addPerfume").click(function() {
//		$perfumeDialog.dialog( "open" );
//	});
	
	 $( "#perfume_rating" ).spinner({
		 spin: function( event, ui ) {
		 if ( ui.value > 10 ) {
		 $( this ).spinner( "value", 0 );
		 return false;
		 } else if ( ui.value < 0 ) {
		 $( this ).spinner( "value", 10 );
		 return false;
		 }
		 }
		 });
	 
	 $( "#addTemplate" ).button().click(function() {
		 $templateDialog.dialog( "open" );
	 }).next().button({
	 text: false,
	 icons: {
	 primary: "ui-icon-triangle-1-s"
	 }
	 })
	 .click(function() {
	 var menu = $( this ).parent().next().show().position({
	 my: "left top",
	 at: "left bottom",
	 of: this
	 });
	 $( document ).one( "click", function() {
	 menu.hide();
	 });
	 return false;
	 })
	 .parent()
	 .buttonset()
	 .next()
	 .hide()
	 .menu();
	 
	 $( "#updateTemplate").click(function() {
		 $templateUpdateDialog.dialog("open");
		 //populatePerfumeUpdateDialog();
	 })
	 
	 
	 $( "#addPerfume" ).button().click(function() {
		 $perfumeDialog.dialog( "open" );
	 }).next().button({
	 text: false,
	 icons: {
	 primary: "ui-icon-triangle-1-s"
	 }
	 })
	 .click(function() {
	 var menu = $( this ).parent().next().show().position({
	 my: "left top",
	 at: "left bottom",
	 of: this
	 });
	 $( document ).one( "click", function() {
	 menu.hide();
	 });
	 return false;
	 })
	 .parent()
	 .buttonset()
	 .next()
	 .hide()
	 .menu();
	 
	 $( "#updatePerfume").click(function() {
		 $perfumeUpdateDialog.dialog("open");
		 //populatePerfumeUpdateDialog();
	 })
	 
	 $( "#updateCategory").click(function() {
		 $categoryUpdateDialog.dialog("open");
	 })
	 
	 $( "#addCategory" ).button().click(function() {
		 $dialog.dialog( "open" );
	 }).next().button({
	 text: false,
	 icons: {
	 primary: "ui-icon-triangle-1-s"
	 }
	 })
	 .click(function() {
	 var menu = $( this ).parent().next().show().position({
	 my: "left top",
	 at: "left bottom",
	 of: this
	 });
	 $( document ).one( "click", function() {
	 menu.hide();
	 });
	 return false;
	 })
	 .parent()
	 .buttonset()
	 .next()
	 .hide()
	 .menu();
	
	 var $perfumeshadowbox = $( "#perfumeModal" ).dialog({
		 autoOpen: false,
		 height: 450,
		 width: 600,
		 modal: true,
		 buttons: {
		EDIT: function() {
			//populatePerfumeUpdateDialog();
			 $( this ).dialog( "close" );
			editPerfume = currentPerfume;
			$perfumeUpdateDialog.dialog("open");
		},
		 OK: function() {
			 $( this ).dialog( "close" );
		 }
		 },
		 close: function() {
			 
		 },
		 open: 
			 function() {
			 
			    	  //alert($(this).parent());
			    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
			    	  //createCategory($( this ).parent());
			    	  //$( this ).parent().parent().dialog( "close" );
			      }
			 
				 // }
		 
		 });
	 
	
	 var $dialog = $( "#dialog-form" ).dialog({
		 autoOpen: false,
		 height: 300,
		 width: 350,
		 modal: true,
		 buttons: {
		 "Create Category": function() {
			 createCategory();
//			 $.get("code/create_category.php", { name: $('input[id=category_name]').val() })
//			 .done(function(data) {
//			 //alert("Data Loaded: " + data);
//				 
//			 });
			 //$( this ).dialog( "close" );
		 },
		 Cancel: function() {
			 $( this ).dialog( "close" );
			 $("#category_alert").hide();
			 $("#category_success").hide();
			 $('input[id=category_name]').val("")
		 }
		 },
		 close: function() {
			 $("#category_alert").hide();
			 $("#category_success").hide();
			 $('input[id=category_name]').val("")
		 },
		 open: 
			 function() {
			 $('input[id=category_name]').keypress(function(e) {
			      if (e.keyCode == $.ui.keyCode.ENTER) {
			    	  createCategory();
			    	  //alert($(this).parent());
			    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
			    	  //createCategory($( this ).parent());
			    	  //$( this ).parent().parent().dialog( "close" );
			      }
			 });
				  }
		 
		 });
	 
	 var $categoryUpdateDialog = $( "#categoryUpdateDialog" ).dialog({
		 autoOpen: false,
		 height: 400,
		 width: 350,
		 modal: true,
		 buttons: {
		 "Update Category": function() {
//			 document.getElementById('perfumeUpdateCategory').innerHTML = "";
			 alert(document.getElementById('perfumeUpdateCategory').length);
			 updateCategory();
//			 $('#updateCategoryName').find('option').remove();
//			 $.get("code/create_category.php", { name: $('input[id=category_name]').val() })
//			 .done(function(data) {
//			 //alert("Data Loaded: " + data);
//				 
//			 });
			 //$( this ).dialog( "close" );
		 },
		 Cancel: function() {
//			 document.getElementById('perfumeUpdateCategory').innerHTML = "";
//			 $('#perfumeUpdateCategory').options.length=0;
			 $( this ).dialog( "close" );
			 $("#category_alert").hide();
			 $("#category_success").hide();
//			 $('#perfumeUpdateCategory').find('option').remove();
		 }
		 },
		 close: function() {
			 $("#category_alert").hide();
			 $("#category_success").hide(); 
			 $('select[id=updateCategoryName]').find('option').remove();
			 
		 },
		 open: 
			 function() {
			 $('input[id=category_name]').keypress(function(e) {
			      if (e.keyCode == $.ui.keyCode.ENTER) {
			    	  createCategory();
			    	  //alert($(this).parent());
			    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
			    	  //createCategory($( this ).parent());
			    	  //$( this ).parent().parent().dialog( "close" );
			      }
			 });
			 
			 $.getJSON('code/getCategories.php', 
					 function(result) {
				 $.each(result.categories, function(index, categories) {
					 $("<option value="+categories.id+">"+categories.name+"</option>").appendTo('select[id=updateCategoryName]');
				 })
			 })
				  }
		 
		 });
	 
	 var $perfumeDialog = $( "#perfumeDialog" ).dialog({
		 autoOpen: false,
		 height: 650,
		 width: 650,
		 modal: true,
		 buttons: {
		 "Add Perfume": function() {
			 //if ($('#template_picture').val() == '') { //If there is a picture to upload...
				 picUpload();
			 //}
			 
			 addPerfume();
//			 $.get("code/create_category.php", { name: $('input[id=category_name]').val() })
//			 .done(function(data) {
//			 //alert("Data Loaded: " + data);
//				 
//			 });
			 //$( this ).dialog( "close" );
		 },
		 Cancel: function() {
			 $( this ).dialog( "close" );
			 $("#perfume_alert").hide();
			 $("#perfume_success").hide();
			 //$('input[id=category_name]').val("")
		 }
		 },
		 close: function() {
			 $("#perfume_alert").hide();
			 $("#perfume_success").hide();
			 $('select[id=template_category]').val("");
			 $('select[id=template_category]').empty();
		 },
		 open: 
			 function() {
			 //$('input[id=category_name]').keypress(function(e) {
			 //     if (e.keyCode == $.ui.keyCode.ENTER) {
			 //   	  createCategory();
			    	  //alert($(this).parent());
			    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
			    	  //createCategory($( this ).parent());
			    	  //$( this ).parent().parent().dialog( "close" );
			  //    }
			 //});
			 $.getJSON('code/getCategories.php', 
					 function(result) {
				 $.each(result.categories, function(index, categories) {
					 $("<option value="+categories.id+">"+categories.name+"</option>").appendTo('select[id=template_category]');
				 })
			 });
				  }
		 
		 });
	 
	 var $perfumeUpdateDialog = $( "#perfumeUpdateDialog" ).dialog({
		 autoOpen: false,
		 height: 650,
		 width: 650,
		 modal: true,
		 buttons: {
		 "Update Perfume": function() {
			 updatePerfume();
			 $( this ).dialog( "close" );
//			 addPerfume();
//			 $.get("code/create_category.php", { name: $('input[id=category_name]').val() })
//			 .done(function(data) {
//			 //alert("Data Loaded: " + data);
//				 
//			 });
			 //$( this ).dialog( "close" );
		 },
		 Cancel: function() {
			 $( this ).dialog( "close" );
			 $("#perfume_alert").hide();
			 $("#perfume_success").hide();
			 //$('input[id=category_name]').val("")
		 }
		 },
		 close: function() {
			 $("#perfume_alert").hide();
			 $("#perfume_success").hide();
			 $('select[id=perfumeUpdateCategory]').empty();
			 $('select[id=perfumeUpdateSelect]').empty();
		 },
		 open: 
			 function() {
			 //$('input[id=category_name]').keypress(function(e) {
			 //     if (e.keyCode == $.ui.keyCode.ENTER) {
			 //   	  createCategory();
			    	  //alert($(this).parent());
			    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
			    	  //createCategory($( this ).parent());
			    	  //$( this ).parent().parent().dialog( "close" );
			  //    }
			 //});
			 
			 $.getJSON('code/getCategories.php', 
					 function(result) {
				 $.each(result.categories, function(index, categories) {
					 $("<option value="+categories.id+">"+categories.name+"</option>").appendTo('select[id=perfumeUpdateCategory]');
				 })
			 });
			 $.getJSON('code/getPerfumes.php?unused=false', 
					 function(result) {
				 $.each(result.perfumes, function(index, perfumes) {
					 $("<option id="+perfumes.id+" value="+perfumes.id+">"+perfumes.name+"</option>").appendTo('select[id=perfumeUpdateSelect]');
				 })
				 $('option[id='+ editPerfume +']').prop('selected', true);
				 populatePerfumeUpdateDialog($('select[id=perfumeUpdateSelect]').val());
				 editPerfume = '';
			 });
			 
			 //alert(editPerfume);
			 //document.getElementById(editPerfume).selected = true;
			 
				  }
		 
		 });
	 
	 
//-----------------------------------------------------------------------------
	 
	 function picUpload() {
		 var fileInput = document.getElementById("template_picture");
		 var fileList = fileInput.files;  // files is a FileList object (similar to NodeList)
		 $('#template_picture').fileupload({
			    url: 'http://cpuoftheheart.com/bpal2/code/picupload.php',
			    dataType: 'json',
			    sequentialUploads: true
			});
		 
		 
			$('#template_picture').bind('fileuploadprogress', function (e, data) { //Bind the progress bar so we can update while the file uploads
			    // Log the current bitrate for this upload:
			    console.log(data);
				//alert(data._progress.loaded / data._progress.total);
				 $( "#template_progressbar" ).progressbar({
						value: data._progress.loaded / data._progress.total * 100
					});
			});
			
			$('#template_picture').hide();
			$('#template_progressbar').show();
			var jqXHR = $('#template_picture').fileupload('send',{files: fileList})
		    .success(function (result, textStatus, jqXHR) {
//		    	$('#template_filename').val(result.location);
//		    	$.post("code/create_template.php",$('#templateform').serialize())
//		    	.done(function(data) {
//		    		//alert(data);
//		    		if(data == "0") {
//		    			 $("#template_alert").hide();
//		    			 $("#template_success").show();
//		    			 $('#templateform')[0].reset();
//		    		 }else{
//		    			 $("#template_alert").show();
//		    			 $("#template_success").hide();
//		    		 }
//		    	});
		    	
		    })
		    .error(function (jqXHR, textStatus, errorThrown) {}) //alert("error");
		    .complete(function (result, textStatus, jqXHR) {
		    	$('#template_picture').show();
		    	$('#template_progressbar').hide();
		    	});
			$('#template_picture').fileupload('destroy');
	 }
	 
//		// files is a FileList object (similar to NodeList)
//		var fileList = fileInput.files;
//		//$('#template_picture').fileupload();
//		$('#template_picture').fileupload({
//		    url: 'http://cpuoftheheart.com/bpal2/code/picupload.php',
//		    dataType: 'json',
//		    sequentialUploads: true
//		});
//		$('#template_picture').bind('fileuploadprogress', function (e, data) {
//		    // Log the current bitrate for this upload:
//		    console.log(data);
//			//alert(data._progress.loaded / data._progress.total);
//			 $( "#template_progressbar" ).progressbar({
//					value: data._progress.loaded / data._progress.total * 100
//				});
//		});
//		$('#template_picture').hide();
//		$('#template_progressbar').show();
//		var jqXHR = $('#template_picture').fileupload('send',{files: fileList})
//	    .success(function (result, textStatus, jqXHR) {
//	    	$('#template_filename').val(result.location);
//	    	$.post("code/create_template.php",$('#templateform').serialize())
//	    	.done(function(data) {
//	    		//alert(data);
//	    		if(data == "0") {
//	    			 $("#template_alert").hide();
//	    			 $("#template_success").show();
//	    			 $('#templateform')[0].reset();
//	    		 }else{
//	    			 $("#template_alert").show();
//	    			 $("#template_success").hide();
//	    		 }
//	    	});
//	    	
//	    })
//	    .error(function (jqXHR, textStatus, errorThrown) {alert("error");})
//	    .complete(function (result, textStatus, jqXHR) {
//	    	$('#template_picture').show();
//	    	$('#template_progressbar').hide();
//	    	});
//		$('#template_picture').fileupload('destroy');
//------------------------------------------------------------------------------------------
	 
	 
	 
//	 var $templateUpdateDialog = $( "#templateUpdateDialog" ).dialog({
//		 autoOpen: false,
//		 height: 350,
//		 width: 650,
//		 modal: true,
//		 buttons: {
//		 "Update Template": function() {
//			 updatePerfume();
//			 $( this ).dialog( "close" );
////			 addPerfume();
////			 $.get("code/create_category.php", { name: $('input[id=category_name]').val() })
////			 .done(function(data) {
////			 //alert("Data Loaded: " + data);
////				 
////			 });
//			 //$( this ).dialog( "close" );
//		 },
//		 Cancel: function() {
//			 $( this ).dialog( "close" );
//			 $("#perfume_alert").hide();
//			 $("#perfume_success").hide();
//			 //$('input[id=category_name]').val("")
//		 }
//		 },
//		 close: function() {
//			 $("#perfume_alert").hide();
//			 $("#perfume_success").hide();
//			 //$('input[id=category_name]').val("")
//		 },
//		 open: 
//			 function() {
//			 //$('input[id=category_name]').keypress(function(e) {
//			 //     if (e.keyCode == $.ui.keyCode.ENTER) {
//			 //   	  createCategory();
//			    	  //alert($(this).parent());
//			    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
//			    	  //createCategory($( this ).parent());
//			    	  //$( this ).parent().parent().dialog( "close" );
//			  //    }
//			 //});
//			 $.getJSON('code/getPerfumes.php?unused=false', 
//					 function(result) {
//				 $.each(result.perfumes, function(index, perfumes) {
//					 $("<option value="+perfumes.id+">"+perfumes.name+"</option>").appendTo('select[id=categoryUpdateSelect]');
//				 })
//			 });
//			 $.getJSON('code/getPerfumes.php', 
//					 function(result) {
//				 $.each(result.perfumes, function(index, perfumes) {
//					 $("<option value="+perfumes.id+">"+perfumes.name+"</option>").appendTo('select[id=perfumeUpdateSelect]');
//				 })
//			 });
//				  }
//		 
//		 });
//	 
//	 $('select[id=perfumeUpdateSelect]').change(
//			 function() {
//				 
//			 });
//	 
//		 $( "#create-user" )
//		 .button()
//		 .click(function() {
//		 $( "#dialog-form" ).dialog( "open" );
//		 });
	

//var $templateDialog = $( "#templateDialog" ).dialog({
//	 autoOpen: false,
//	 height: 450,
//	 width: 475,
//	 modal: true,
//	 buttons: {
//	 "Create Template": function() {
//		 createTemplate();
//		 //createCategory();
////		 $.get("code/create_category.php", { name: $('input[id=category_name]').val() })
////		 .done(function(data) {
////		 //alert("Data Loaded: " + data);
////			 
////		 });
//		 //$( this ).dialog( "close" );
//	 },
//	 Cancel: function() {
//		 $( this ).dialog( "close" );
//		// $("#template_alert").hide();
//		// $("#template_success").hide();
//		// $('input[id=category_name]').val("")
//	 }
//	 },
//	 close: function() {
//		 $("#template_alert").hide();
//		 $("#template_success").hide();
//		 $('input[id=template_name]').val("");
//		 $('select[id=template_category] option').remove();
//		 $('textarea[id=template_description]').val('');
//		 $(" :checked").removeAttr('checked');
//	 },
//	 open: 
//		 function() {
//		 $('input[id=template_name]').keypress(function(e) {
//		      if (e.keyCode == $.ui.keyCode.ENTER) {
//		    	  //createCategory();
//		    	  //alert($(this).parent());
//		    	  //$(this).parent().parent().find("button:eq(0)").trigger("click");
//		    	  //createCategory($( this ).parent());
//		    	  //$( this ).parent().parent().dialog( "close" );
//		      }
//		 });
//		 $.getJSON('code/getCategories.php', 
//				 function(result) {
//			 $.each(result.categories, function(index, categories) {
//				 $("<option value="+categories.id+">"+categories.name+"</option>").appendTo('select[id=template_category]');
//			 })
//		 })
//		// })
//		 $( "#template_progressbar" ).progressbar({
//				value: 5
//			});
//			  }
//	 
//	 
//	 });
	 
	 
//	 $( "#create-user" )
//	 .button()
//	 .click(function() {
//	 $( "#dialog-form" ).dialog( "open" );
//	 });

});


function template(row, list) {
	row.find('.perfumeName').text(list.name);
	row.find('.perfumeCategory').text(list.category.name);
	//row.find('.perfumeRating').text(list.rating);
	row.find('.perfumeBottles').text(list.bottles);
	row.find('.perfumeImps').text(list.imps);
	row.find('.perfumeDescription').text(list.description);
	row.find('.descShort').text(list.description.substring(0,28)+'...');
	for(var i=0; i < list.rating; i++){
		row.find('.perfumeRating').append('<img src=images/bpt.gif />');
	}
	
	return row;
}



function createInstance() {
	var newRow = $('.template').clone().removeClass('template');
	
}

function createCategory() {
	$.get("code/create_category.php", { name: $('input[id=category_name]').val() })
	 .done(function(data) {
	 //alert("Data Loaded: " + data);
		 if(data == "0") {
			 $("#category_alert").hide();
			 $("#category_success").show();
			 $('input[id=category_name]').val("")
		 }else{
			 $("#category_alert").show();
			 $("#category_success").hide();
		 }
	 });
	 //$( this ).dialog( "close" );
}

function updateCategory() {
	$.get("code/update_category.php", { name: $('input[id=newCategoryName]').val(), id:$('select[id=updateCategoryName]').val() })
	 .done(function(data) {
	 //alert("Data Loaded: " + data);
		 if(data == "0") {
			 $("#category_alert").hide();
			 $("#category_success").show();
			 $('input[id=newCategoryName]').val("")
		 }else{
			 $("#category_alert").show();
			 $("#category_success").hide();
		 }
	 });
	 //$( this ).dialog( "close" );
}

//function createTemplate() {
//	var fileInput = document.getElementById("template_picture");
//	
//	if ($('#template_picture').val() == '') {
//		$.post("code/create_template.php",$('#templateform').serialize())
//    	.done(function(data) {
//    		//alert(data);
//    		if(data == "0") {
//    			 $("#template_alert").hide();
//    			 $("#template_success").show();
//    			 $('#templateform')[0].reset();
//    		 }else{
//    			 $("#template_alert").show();
//    			 $("#template_success").hide();
//    		 }
//    	});
//		return;
//	}
//	
//	// files is a FileList object (similar to NodeList)
//	var fileList = fileInput.files;
//	//$('#template_picture').fileupload();
//	$('#template_picture').fileupload({
//	    url: 'http://cpuoftheheart.com/bpal2/code/picupload.php',
//	    dataType: 'json',
//	    sequentialUploads: true
//	});
//	$('#template_picture').bind('fileuploadprogress', function (e, data) {
//	    // Log the current bitrate for this upload:
//	    console.log(data);
//		//alert(data._progress.loaded / data._progress.total);
//		 $( "#template_progressbar" ).progressbar({
//				value: data._progress.loaded / data._progress.total * 100
//			});
//	});
//	$('#template_picture').hide();
//	$('#template_progressbar').show();
//	var jqXHR = $('#template_picture').fileupload('send',{files: fileList})
//    .success(function (result, textStatus, jqXHR) {
//    	$('#template_filename').val(result.location);
//    	$.post("code/create_template.php",$('#templateform').serialize())
//    	.done(function(data) {
//    		//alert(data);
//    		if(data == "0") {
//    			 $("#template_alert").hide();
//    			 $("#template_success").show();
//    			 $('#templateform')[0].reset();
//    		 }else{
//    			 $("#template_alert").show();
//    			 $("#template_success").hide();
//    		 }
//    	});
//    	
//    })
//    .error(function (jqXHR, textStatus, errorThrown) {alert("error");})
//    .complete(function (result, textStatus, jqXHR) {
//    	$('#template_picture').show();
//    	$('#template_progressbar').hide();
//    	});
//	$('#template_picture').fileupload('destroy');
//
//	
//	
//}

function addPerfume() {
	$.post("code/create_perfume.php",$('#perfumeform').serialize())
	.done(function(data) {
		//alert(data);
		if(data == "0") {
			 $("#perfume_alert").hide();
			 $("#perfume_success").show();
			 $('#perfumeform')[0].reset();
		 }else{
			 $("#perfume_alert").show();
			 $("#perfume_success").hide();
		 }
	});
	
	$('#square').empty();

	$.getJSON("http://cpuoftheheart.com/bpal2/code/getList.php",
			function(result) {
				$.each(result.perfume,function(index, perfume){
					var newRow = $('.listTemplate').clone().removeClass('listTemplate').addClass('listItem').attr('id', perfume.id);
					template(newRow,perfume).appendTo('#square').show();
					//alert(result.name);
				
				})
				
			});
}

function updatePerfume() {
	$.post("code/update_perfume.php",$('#perfumeUpdateForm').serialize())
	.done(function(data) {
		//alert(data);
		if(data == "0") {
			 $("#perfume_alert").hide();
			 $("#perfume_success").show();
			 $('#perfumeform')[0].reset();
		 }else{
			 $("#perfume_alert").show();
			 $("#perfume_success").hide();
		 }
	});
	
	$('#square').empty();

	$.getJSON("http://cpuoftheheart.com/bpal2/code/getList.php",
			function(result) {
				$.each(result.perfume,function(index, perfume){
					var newRow = $('.listTemplate').clone().removeClass('listTemplate').addClass('listItem').attr('id', perfume.id);
					template(newRow,perfume).appendTo('#square').show();
					//alert(result.name);
				
				})
				
			});
}

function fillBox(id) {
	//alert(id);
	$.getJSON("http://cpuoftheheart.com/bpal2/code/getPerfume.php?perfume_id=" + id,
			function(result) {
				$.each(result.perfume,function(index, perfume){
					$('#perfumeName').text(perfume.name);
					$('#perfumeDescription').text(perfume.description);
					$('#perfumeCategory').text(perfume.category.name);
					$('#perfumeRating').text('');
					//$('#perfumeStatus').text(perfume.status);
					if(perfume.status == 1){
						$('#perfumeStatus').text('Yes');
					}else{
						$('#perfumeStatus').text('No');
					}
					
					if(perfume.discontinued == 1) {
						$('#perfumeDiscontinued').text('Yes');
					}else {
						$('#perfumeDiscontinued').text('No');
					}
					
					$('#perfumeLocation').text(perfume.location);
					$('#perfumeBottles').text(perfume.bottles);
					$('#perfumeImps').text(perfume.imps);
					$('#perfumeNotes').text(perfume.notes);
					$('#perfumePicture').html('<img id=label src=images/labels/'+id+'.jpg />')
					
					for(var i=0; i < perfume.rating; i++){
						$('#perfumeRating').append('<img src=images/bpt.gif />')
					}
					
					currentPerfume = id;
					//var newRow = $('.listTemplate').clone().removeClass('listTemplate').addClass('listItem').attr('id', perfume.id);
					//template(newRow,perfume).appendTo('#square').fadeIn();
					//alert(result.name);
					//alert(perfume.rating);
				
				})
				
			});
	 
}

$.expr[":"].containsi = $.expr.createPseudo(function(arg) {
    return function( elem ) {
        return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
    };
});

function searchFilter(search){
	//alert(search);
	//search = '';
	//$('.listItem').show();
	//return true;
	var count;
	
	if (search == '') {
		$('.listItem').show();
	} else {
		$('.listItem span.PerfumeName').parent().hide();
		//$('.listItem').not(':contains('+search+')').hide();
		$('.listItem span.PerfumeName:containsi('+search+')').parent().show();
		//count = $('.listItem span.PerfumeName:containsi('+search+')').parent().length;
		$('.listItem span.PerfumeDescription:containsi('+search+')').parent().show();
		//count += $('.listItem span.PerfumeDescription:containsi('+search+')').parent().lenth;
		//$('#count').innerHTML = count;
	}
	
}

function listRefresh(sort){
	//alert(sort);
	$('#square').empty();
	var swap = $('#swappable').is(':checked');
	var disc = $('#discontinued').is(':checked');
	$.getJSON("http://cpuoftheheart.com/bpal2/code/getList.php?order="+sort+"&swap="+swap+"&discontinued="+disc,
			function(result) {
				$.each(result.perfume,function(index, perfume){
					var newRow = $('.listTemplate').clone().removeClass('listTemplate').addClass('listItem').attr('id', perfume.id);
					template(newRow,perfume).appendTo('#square').show();
					//alert(result.name);
				
				})
				
			});
}

function populatePerfumeUpdateDialog( value ) {
	$.getJSON("http://cpuoftheheart.com/bpal2/code/getPerfume.php?perfume_id=" + value,
			function(result) {
				$.each(result.perfume,function(index, perfume){
					//alert(perfume.name);
					//$('#perfumeName').val(perfume.name);
					//$('#perfumeUpdateDescription').val(perfume.description);
					//$('#perfumeCategory').val(perfume.category.name);
					//$('#perfumeUpdateCategory').val(perfume.id);
					$('input[id=perfumeUpdateName]').val(perfume.name);
					//alert(perfume.name);
					$('#perfumeUpdateCategory').val(perfume.category.id);
					//$('#perfumeUpdateDiscontinued').val(perfume.discontinued);
					if(perfume.discontinued == 1){
						$('#perfumeUpdateDiscontinued').prop('checked', true);
					} else {
						$('#perfumeUpdateDiscontinued').prop('checked', false);
					}
					
					$('#perfumeUpdateDescription').val(perfume.description);
					$('#perfumeUpdateRating').val(perfume.rating);
					//$('#perfumeUpdateStatus').val(perfume.status);
					
					if(perfume.status == 1){
						$('#perfumeUpdateStatus').prop('checked', true);
					} else {
						$('#perfumeUpdateStatus').prop('checked', false);
					}
					
					$('#perfumeUpdateLocation').val(perfume.location);
					$('#perfumeUpdateBottles').val(perfume.bottles);
					$('#perfumeUpdateImps').val(perfume.imps);
					$('#perfumeUpdateNotes').val(perfume.notes);
					//$('#perfumePicture').html('<img id=label src=images/labels/'+perfume.picture+' />')
					
					for(var i=0; i < perfume.rating; i++){
						$('#perfumeRating').append('<img src=images/bpt.gif />')
					}
					
				
				})
				
			});
}

function populateTemplateUpdateDialog( value ) {
	$.getJSON("http://cpuoftheheart.com/bpal2/code/getPerfume.php?perfume_id=" + value,
			function(result) {
				
				$.each(result.perfume,function(index, perfume){
					alert(perfume.name);
					//alert(perfume.name);
					//$('#perfumeName').val(perfume.name);
					//$('#perfumeUpdateDescription').val(perfume.description);
					//$('#perfumeCategory').val(perfume.category.name);
					$('#templateUpdateCategory').val(perfume.id);
					$('#templateUpdateName').val(perfume.name);
					$('#templateUpdateDiscontinued').val(perfume.discontinued);
					$('textarea#templateUpdateDescription').val(perfume.description);
//					$('#perfumeUpdateBottles').val(perfume.bottles);
//					$('#perfumeUpdateImps').val(perfume.imps);
//					$('#perfumeUpdateNotes').val(perfume.notes);
//					//$('#perfumePicture').html('<img id=label src=images/labels/'+perfume.picture+' />')
//					
					for(var i=0; i < perfume.rating; i++){
						$('#perfumeRating').append('<img src=images/bpt.gif />')
					}
					
				
				})
				
			});
}