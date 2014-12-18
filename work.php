<?php 
/*
Template Name: Work
*/

include('form-process.php');

$out = getCustomers();
$outjson = json_encode($out);
//print_r($out);

//header("Content-type: text/json");

//make a tag array with cleaned up tags
//print_r($out);
$ct = count($out);

$tagArray = array();
asort($out);
//print_r($out);
//die();
foreach($out as $key=>$val){
	$val = trim($val['tags']);
	$val = explode(", ",$val);
	foreach($val as $k=>$v){
		$tagArray[$v] = ucfirst($v);
	}
	
}
asort($tagArray);


/*
print_r($tagArray);
die();
*/
			
			
			
?>

<?php get_header(); ?>

<?php get_sidebar(); ?>

<div id="primary">
	<div class="entry-content">
	<div id="post-12" class="post-12 page type-page status-publish hentry">
	<div id="links-1" class="links-1-main" style="">
		<ul class="basic-list">
		<?php 
			$count = count($out);
			$namesArr = array();
			/*
				for($w=0; $w<$count; $w++){
					array_push($namesArr, $out[$w]['name'];
				}
				sort($namesArr);
			*/
			
			/*
for($i=0; $i<$count; $i++){
				echo "<li class='links'><a class='all-1 ".$out[$i]["name"]."' data-attribute='".$out[$i]["name"]."' href='#'>".strtoupper($out[$i]['name'])."</a></li>";
			}
*/
			
			foreach($out as $key=>$val){
				echo "<li class='links'><a class='all-1 ".$out[$key]["name"]."' data-attribute='".$out[$key]["name"]."' href='#'>".strtoupper($out[$key]['name'])."</a></li>";
			}
		
		?>
		</ul>
	</div>
	<div id="links-2">
		<ul id="tags-ul">

		</ul>
	</div>

	<div id="item-window" class="white_overlay">
		
		<div id="photo"></div>
		<div id="bird-nav"></div>
		<div id="text"></div>
	</div>
	
	</div>
	</div>


</div>



	
<div id="contact">
<?php if(is_page('awards')){ ?>
	
<?php }elseif(is_page('press')) {?>
	
<?php }else { ?>
	<!-- <p id="design-bird"></p> -->
<?php } ?> 
</div>

<script>

var transition;
$("#no-photo").hide();
$(function(){
		/*
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
		"S",
		"M",
		"L",
		"XL",
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
		"Project Management"
	
	];
*/
	var tags = [
		<?php 
			
			foreach($tagArray as $t=>$a){
			
					echo '"'.$a.'",';
		
			}
		?>
	];

	var cls;
	for(var i=0; i<tags.length; i++){
	
		if(tags[i].charAt(0) == "$"){
			if(tags[i].charAt(1)=="$"){
				if(tags[i].charAt(2)=="$"){
					if(tags[i].charAt(3)=='$'){
						cls= "dollar-4";
					}else{
						cls = "dollar-3";
					}
				}else{
					cls = "dollar-2";
				}
			}else{
				cls = "dollar-1";
			}
		}else{
			cls = tags[i].split(" ");
			cls = cls[0];
		}
	
		$("#tags-ul").append("<li class='all "+cls+"' data-attribute='"+cls+"'>"+tags[i].toUpperCase()+"</li>");	
	}
	
var divHeight = $("#links-1 .basic-list").height();
/*
console.log("Height", divHeight);	
console.log("Tags", tags.length);
*/
var padding = (divHeight-4.95)/tags.length;

padding = (padding-7)/2;
//console.log(padding);
var secpadd = (padding/2)-1;
$("#links-2 ul li").css({"padding":padding+"px 0px"});
$("#links-2 ul").css({"margin-top":"-"+secpadd+"px"});


	//links
$(".links").click(function(e){
	e.preventDefault();
	//$("#primary").css("background","none");
	$("#item-window").hide();
	$("#photo").html("");
	$("#text").text("");
	$("#bird-nav").html("");
	clearInterval(transition);
	//$("#primary").css({'background':'none'});
	$(".all").css({"color":"#aaa"});
	var listOfClients = <?php echo $outjson; ?>

	var name = $(this).find("a").attr('data-attribute');

	$(".all-1").fadeTo(0,"0.4");
	
	//console.log(name);
	//console.log(listOfClients);
	var obj = {};
	
	for(var i in listOfClients){
		//console.log(listOfClients[i].name);
		if(listOfClients[i].name==name){
			obj ={
				id: listOfClients[i].id,
				image: listOfClients[i].image,
				name: listOfClients[i].name,
				tags: listOfClients[i].tags,
				desc: listOfClients[i].desc
			};
		}
		
	}
	name = name.split(" ");
	name = name[0];
	//console.log("name",name);
	$("."+name+"").fadeTo(0,"0.4").fadeTo(1500,"1.0").css({"color":"#181804"});
	
	//console.log(obj);
	
	//The tags
	var tags = obj.tags;
	tags = tags.split(",");
	

	for(var i=0; i<tags.length; i++){
		tags[i] = tags[i].trim();
		tags[i] = tags[i].split(" ");
		tags[i] = tags[i][0].capitalize();
	//	console.log(tags[i]);
		if(tags[i].charAt(0) == "$"){
			if(tags[i].charAt(1)=="$"){
				if(tags[i].charAt(2)=="$"){
					if(tags[i].charAt(3)=='$'){
						tags[i] = "dollar-4";
					}else{
						tags[i] = "dollar-3";					
					}
				}else{
					tags[i] = "dollar-2";
				}
			}else{
				tags[i] = "dollar-1";
			}
		}
		//console.log(tags[i]);
		
		$("."+tags[i]+"").fadeTo(0,"0.4").fadeTo(1500,"1.0").css({"color":"#181804"});
		
	}

	//console.log(tags);
	//The images	
	var im = obj.image;
	console.log(im);
	for(var i=0; i<im.length; i++){
		$("#photo").append("<img class='photos' src='"+"<?php bloginfo('stylesheet_directory'); ?>"+"/photos/"+im[i].filename+"' />");
	}
	
	var countInt = 0;
	var secondCount = 1;
			
	transitionImages();
	
	transition = setInterval(transitionImages,5000);
	
	//The description
	var desc = obj.desc;
	$("#text").html(desc);
	
	$("#item-window").show();

	console.log(im.length);
	var html ="";
	for(var i=im.length; i>=1; i--){
		html += "<a data-attribute='"+i+"' class='birds bird-"+i+"' href='#'><img src='<?php bloginfo('stylesheet_directory'); ?>/images/bird"+i+".jpg' /></a>";
	}
	$("#bird-nav").append(html);
	
	function transitionImages(){
		if(countInt<im.length){
			$(".photos").hide();
			$(".photos:eq("+countInt+")").show();
			//$(".birds").css({"background-position": "0px 0"});
			//console.log(secondCount)
			//$(".bird-"+secondCount+"").css({"background-position": "-36px 0"});
			countInt++;
			secondCount++;
		}else{
			//$(".birds").css({"background-position": "0 0"});
			secondCount = 1;
			countInt=0;
		}
	
	}
	
		$(".birds").click(function(e){
			e.preventDefault();
			console.log(im);
			clearInterval(transition);
			var index = $(this).attr("data-attribute")-1;
			//console.log("bird-"+index+"");
			$(".photos").hide();
			console.log(im[index].filename);
			$(".photos:eq("+index+")").show();
			
			setTimeout(function(){
				clearInterval(transition);
				transition = setInterval(transitionImages,5000);
			},5000);
			
		});
		
	
});

});




/*
	$(".bird").css("background-position-x", "0px");
	$(".bird").css("background-position-x", "0px");

*/
	
String.prototype.capitalize = function() {
    return this.charAt(0).toUpperCase() + this.slice(1);
}
</script>
<?php get_footer(); ?>