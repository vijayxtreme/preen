<?php
/* 
Template Name: Upload
*/

include('form-process.php');
//echo function_exists('getCustomers') ?"TRUE":"FALSE";

//WP usually closes connections to DB, so have to reinit 

$out = getCustomers();
//print_r($out);
$outjson = json_encode($out); //json encode the array from PHP


?>

<?php get_header(); ?>
<?php get_sidebar(); ?>

<div id="primary">
<div class="entry-content">
	<div id="links-1">
		<div id="form-area">
		<h1 id="form-message">Enter a new client</h1>
		<form id="myForm" name="myForm" enctype="multipart/form-data" onsubmit="return validateForm()" action="<?php bloginfo('url');?>/form-process/" method="post">
			<input id="clientname" name="clientname" type="text" class="newcustomer" placeholder="Client Name" />
			<br /><textarea  id="descr" name="descr" class="newcustomer" placeholder="Enter a description"></textarea>
			<br />Enter tags (separate with commas)
			<br /><textarea id="tagsbox" name="tags" class="newtags" placeholder="Enter tags, separate with commas"></textarea>
			<div id="fileUp">
				<br />Upload Images
				<br /><input name="file[]" type="file" id="file"/>
			</div>
			
			<button id="add_more">Add More Files</button>
			<br /><br /><input id="submit" type="submit" name="submit" value="Submit" />
			
			<br /><input id="editForm" type="submit" name="edit" value="Change" /> 
			<span id="fileSub"></span>
			<br /><input id="formID" type="hidden" val="">
			 		</form>
		</div>
		<div id="input-area">
		<h1>List of Clients</h1>
		<p>Click client name to display information below</p>
		<ul class="client-list">
			<?php 
				$count = count($out);
				for($i=0; $i<$count; $i++){
					$y=$i+1; //Since counter is zero based
					echo "<li>".$y.") <a class='client' href='#' data-row='".$i."' data-id='".$out[$i]['id']."'>".$out[$i]['name']."</a> | <a class='delete' data-id='".$out[$i]['id']."' href='#'>X</a></li>";
				} 
			?>
		</ul>
		</div>
		<div id="tags-area">
		<h1>Tags -- Click to Add to Profile</h1>
		<div>
			<ul id="tags-area-list">
				<li></li>
			</ul>
		</div>
		</div>
		<br style="clear:both;">
		<div id="result-area">
			<div id="result-image"></div>	
		</div>	
		<br style="clear:both;">
		
	</div>
</div>

</div>
<script>
var listclients = <?php echo $outjson ?>;
var totalimuploads = 0;
//console.log(listclients);
$("#result-area").hide();
$("#editForm").hide();
function validateForm() {
    var x = document.forms["myForm"]["clientname"].value;
    var y = document.forms["myForm"]["descr"].value;
    var z = document.forms["myForm"]["tags"].value;
    if ((x == null || y== null || z== null) || (x == "" || y=="" || z=="")) {
        alert("Name, Description and Tags must be filled out!");
        return false;
    }
}

$(function(){

	var tags =[
		"Hotel",
		"Restaurant",
		"Bar / Lounge",
		"Retail",
		"Residential",
		"Sustainable",
		"Awards",
		"$",
		"$$",
		"$$$",
		"$$$$",
		"Size-S",
		"Size-M",
		"Size-L",
		"Size-XL",
		"Architecture",
		"Interior Design",
		"Concept",
		"Naming",
		"Graphic Identities",
		"Menu Design",
		"Music + Sound Design",
		"City Review + Permitting",
		"Technical Drawing",
		"3D Modeling",
		"Hand Rendering",
		"Furniture Design",
		"Purchasing",
		"Project Management",
	
	];
	
	
	for(var i=0; i<tags.length; i++){
		$("#tags-area-list").append("<li class='taglist' data-attribute='"+tags[i]+"'><a href='#'>"+tags[i]+"</a></li>");	
	}
	$(".taglist").click(function(e){
		e.preventDefault();
		var dataAtt = $(this).attr('data-attribute');
		dataAtt+= ", ";
		console.log(dataAtt);
		$("#tagsbox").val($('#tagsbox').val()+dataAtt);
	});
	
	
});
 $('#add_more').click(function(e) {
	
 //When Add More Files button Clicked these function Willbe Called (new file field is added dynamically)
 	e.preventDefault();
 	 totalimuploads++;
 	if(totalimuploads <12){
        $(this).before($("<div/>", {id: 'myForm'}).fadeIn('slow').append(
                $("<input/>", {name: 'file[]', type: 'file', id: 'file'}))
                );
	 	
 	}else{
	 	alert("Maximum amount of images uploaded can be 12");
 	}
 	
});

$(".delete").click(function(e){
	e.preventDefault();
	var index = $(this).attr('data-id');
	 //because mysql table starts at 1
	var prompt = confirm("Sure you want to delete?");
	if(prompt === true){
		$.ajax({
			url: "<?php bloginfo('url'); ?>/form-process",
			data: {id:index, action:'del'},
			type: "GET",
			success: function(data){
				console.log(data);
				window.location.reload();
				//window.location.href="<?php bloginfo('url'); ?>/upload/";
			}
		});
	}else{
		//Do nothing
	}
	
});

//Get client function
$(".client").click(function(e){
	$("#form-message").text("Edit the client");
	$("#result-area").show();
	$("#editForm").show();
	$("#fileUp").hide();
	$("#add_more").hide()
	$("#submit").hide();
	e.preventDefault();
	var index = $(this).attr('data-row');
	var table = $(this).attr('data-id');
	console.log(listclients);
	var name = listclients[index].name;
	var image = listclients[index].image;
	console.log(image);
	
	var desc = listclients[index].desc;
	var tags = listclients[index].tags;
	$("#formID").val(table);
	$("#clientname").val(name);
	$("#descr").val(desc);
	$("#tagsbox").val(tags);
	
	if(image.length !== 0){
		$("#result-image").html("");
		$("#result-image").html("Images: ");
		for(var i=0; i<image.length; i++){
			var im = image[i].url;
			//console.log(im);
			im = im.match(/wp-content\/themes\/preened\/photos\/(.*)/);
			im = im[0];
			$("#result-image").append("<a target='_blank' href='<?php bloginfo('url'); ?>/"+im+"'>"+image[i].filename+"</a> ");
		}	
	}else{
		$("#result-image").html("No images.");
	}
	

		
	
		
	$("#editForm").click(function(e){
		e.preventDefault();
		var index = $("#formID").val();
		console.log(index);
		var formData= $("#myForm").serializeArray();
		console.log(formData);
		
		
		//if the user clicks Edit, then an ajax call gets made
		//the ajax call passes the id, along with an 'edit' to
		//form_process (also a array holding all the remaining filenames)
		//forgot, add form data
		
		
		
		$.ajax({
			url: "<?php bloginfo('url'); ?>/form-process",
			data: {id:index, data:formData, action:'edit'},
			type: "GET",
			success: function(data){
				console.log(data);
				window.location.reload();
				//window.location.href="<?php bloginfo('url'); ?>/upload/";
			}
		});
		



		
		//Form_process
		//gets the id, the array, finds the table with id and photo_id id
		//(might be cleaner to use name)
		//updates record with new information from form data at the row
		//and photos row
		
		
	});
	
	$("#fileSub").html("<button id='backNew'>Back</button>");
	
	$("#backNew").click(function(e){
			e.preventDefault();
			window.location.reload();
	});
				
	
	//console.log(listclients);
});

</script>

<?php get_footer(); ?>

