<?php
/*
Template Name:Form-Process
*/
//$out = array();
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);


if($_GET){
		$out = array();
		

	if($_GET['action']== "del"){				
		//WP usually closes connections to DB, so have to reinit 
		
		$id = $_GET['id'];
		
		$out = deleteCustomer($id);
		
		echo json_encode($out);	
		
	}
	
}
if($_POST['edit']){
		$id = $_POST['formID'];
		$name = $_POST['clientname'];
		$descr = $_POST['descr'];
		$tags = cleanTags($_POST['tags']);	
		$images = $_POST['images'];
		$files = $_FILES['file'];
		$count = count($_FILES['file']['name']);
		//echo $count;
		

		//$out = updateCustomer($id, $name, $descr, $tags, $images, $files, $count);
	
		//echo json_encode($_GET);
			
}elseif($_POST['submit']){

	/*============================================ GET NEW CLIENT INFO, UP TO MYSQL */
	$name = ucfirst($_POST['clientname']);
	$descr = $_POST['descr'];
	$tags = cleanTags($_POST['tags']);	
	$count = count($_FILES['file']['name']);
	$files = $_FILES['file'];
	//echo substr($tags,-1,1)."<br />";
	
	//echo $tags;
	//echo $name." ".$desc." ".$sec;
		
	$query = "INSERT INTO work (name, descr, tags) ";
	$query .= "VALUES ('$name','$descr','$tags')";
	//echo $query."<br/>";
	mysqli_query($con, $query) or die(mysqli_error($con));
	$id = getID($name); //get the ID, for below
	
	$message = uploadImages($count, $files, $id); 
	print_r($message);
 //    $url = get_bloginfo('url');
 //    $url .= "/upload/";
	// echo "Returning you back to <a href='".$url."'>upload</a> page";
	// sleep(3); //sleep 5 seconds, then return user to main page.
 //   echo'<script> window.location="'.$url.'"; </script> ';	
}else {
	// Do nothing.
}

function cleanTags($tags){

	$tags = trim($tags);
	if(substr($tags,-1,1) == ",") {
	//	echo "TRUE";
		$tags = rtrim($tags, ",");
	}
	return $tags;
}


function getID($name){
	$id;
	global $con;
	$query = "SELECT * FROM work WHERE name='$name'";
	$result = mysqli_query($con, $query);
	if($row = mysqli_fetch_array($result)){
		$id = $row['id'];
	}
	return $id;	
}

function getCustomerById($id){
	global $con;
	$query = "SELECT * FROM work WHERE id='$id'";
	$result = mysqli_query($con, $query);
	$out=array();
	
	if($row = mysqli_fetch_array($result)){
		$out['name'] = $row['name'];
		$out['image'] = array();
		$out['descr'] = $row['descr'];
		$out['tags'] =$row['tags'];
		$out['id'] = $row['id'];
	}
	
	$query = "SELECT * FROM workimages WHERE photo_id='$id'";
	$imresult = mysqli_query($con, $query);
	$j=0;
	while($imrow = mysqli_fetch_array($imresult)){
		$out['image'][$j] = array('filename'=>$imrow['filename'], 'url'=>$imrow['url']);	
		$j++;
	}
	return $out;
	
}
function updateCustomer($id, $name, $descr, $tags, $images, $count){
	global $con;

	$query = "UPDATE work SET name='$name', descr='$descr', tags='$tags' WHERE id='$id'";
	$result = mysqli_query($con, $query);
	$out=array();
	$out = getCustomerById($id);
	$out['message']="Success";
	return $out;

}


function deleteCustomer($id){
	global $con;

	$query = "SELECT * FROM workimages WHERE photo_id='$id'";
	$result = mysqli_query($con, $query);
	$out = array();
	while($row = mysqli_fetch_array($result)){
		array_push($out, array('filename'=>$row['filename']));
	}

	for($i=0; $i<count($out); $i++){
		$target_path = "";
		$target_path = $_SERVER['DOCUMENT_ROOT']."/preened/wp-content/themes/preened/photos/";
		$target_path = $target_path.$out[$i]['filename'];
		unlink($target_path);
	}
		
	$query = "DELETE FROM work WHERE id='$id'";
	$result = mysqli_query($con, $query);
	$query = "DELETE FROM workimages WHERE photo_id='$id'";
	$result = mysqli_query($con, $query);

	return $result ? "Success" : "Error";
}

function getCustomers(){
	global $con;
	$query = "SELECT * FROM work";
	$result = mysqli_query($con, $query);
	$out = array();
	//Fetch data 
	$i=0;
	while($row = mysqli_fetch_array($result)){
		//lets get data and store in array to use later
		$out[$i] = array('name'=>$row['name'], 'image'=>array(), 'desc'=>$row['descr'], 'tags'=>$row['tags'], 'id'=>$row['id']);
		$id = $row['id'];
		$query = "SELECT * FROM workimages WHERE photo_id=$id";
		$imageresult = mysqli_query($con, $query);
		$j=0;
		while($imagerow = mysqli_fetch_array($imageresult)){
			$out[$i]['image'][$j] = array('filename'=>$imagerow['filename'], 'url'=>$imagerow['url']);	
			$j++;
		}
	$i++;
	}
	return $out;

}

function uploadImages($count, $files, $id){
	global $con;
	/*============================================= IMAGE UPLOADS =*/
    
	$j = 0; //Variable for indexing uploaded image 
    

	//Declaring Path for uploaded images
	$out = array();
	$out['message'] ="";

    for ($i = 0; $i < $count; $i++) {//loop to get individual element from the array
		$target_path = "";
		$target_path = $_SERVER['DOCUMENT_ROOT']."/preened/wp-content/themes/preened/photos/";
        $validextensions = array("jpeg", "jpg", "png", "JPG", "PNG", "JPEG");  //Extensions which are allowed
        $ext = explode('.', basename($files['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        
        $imagename = "";
        $imagename = basename($files['name'][$i], ".".$file_extension);
		//echo $imagename;

		$target_path = $target_path . $imagename. "." . $ext[count($ext) - 1];//set the target path with a new name of image
      
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	
		if (($files["size"][$i] < 10000000) //Approx. 10MB files can be uploaded.
                && in_array($file_extension, $validextensions)) {


            if (move_uploaded_file($files['tmp_name'][$i], $target_path)) {
            	//if file moved to uploads folder
                //success

                $file = $imagename.".".$file_extension;
                $query = "INSERT INTO workimages (filename, url,photo_id) ";
				$query .= "VALUES ('$file','$target_path','$id')";
               	mysqli_query($con, $query) or die(mysqli_error($con));
                $out['message'] = "Success";
            } else {
               //error with upload
            	$out['message'] = "Error with upload";
            }
        } else {
        	//error with file size
        	$out['message'] = "Error with filesize";
        }

    }

    return $out;

}


?>