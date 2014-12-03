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
		
	}else if($_GET['action']=="edit"){
		$id = $_GET['id'];
		$data = $_GET['data'];
		
		//	print_r($data);
		$out = array();
		foreach($data as $key=>$val){
			$out[$val['name']] = $val['value'];
		}	
		header("Content-type: text/json");
		//print_r($out);//$out[clientname], $out[descr], $out[tags]
		//Data to update
		
		$name = $out['clientname'];
		$descr = $out['descr'];
		$tags = $out['tags'];
		if(substr($tags,-1,1) == ",") {
			//	echo "TRUE";
			$tags = rtrim($tags, ",");
		}
		$out = updateCustomer($id, $name, $descr, $tags);
		echo json_encode($out['message']);

			
		
	}else {
		
	}
	
	
}

//If someone posted a new user...
if($_POST['submit']){

	/*============================================ GET NEW CLIENT INFO, UP TO MYSQL */
	$name = ucfirst($_POST['clientname']);
	$descr = $_POST['descr'];
	$tags = $_POST['tags'];
	$tags = trim($tags);
	//echo substr($tags,-1,1)."<br />";
	if(substr($tags,-1,1) == ",") {
	//	echo "TRUE";
		$tags = rtrim($tags, ",");
	}
	//echo $tags;
	//echo $name." ".$desc." ".$sec;
		
	$query = "INSERT INTO work (name, descr, tags) ";
	$query .= "VALUES ('$name','$descr','$tags')";
	//echo $query."<br/>";
	mysqli_query($con, $query) or die(mysqli_error($con));
	$id = getID($name); //get the ID, for below
	
    /*============================================= IMAGE UPLOADS =*/
    
	$j = 0; //Variable for indexing uploaded image 
    
	 
	//Declaring Path for uploaded images
	//echo file_exists($target_path) ? "TRUE" : "FALSE";
    for ($i = 0; $i < count($_FILES['file']['name']); $i++) {//loop to get individual element from the array
		$target_path = "";
		$target_path = $_SERVER['DOCUMENT_ROOT']."/preened/wp-content/themes/preened/photos/";
        $validextensions = array("jpeg", "jpg", "png");  //Extensions which are allowed
        $ext = explode('.', basename($_FILES['file']['name'][$i]));//explode file name from dot(.) 
        $file_extension = end($ext); //store extensions in the variable
        $imagename = "";
        $imagename = basename($_FILES['file']['name'][$i], ".".$file_extension);
		//echo $imagename;

		$target_path = $target_path . $imagename. "." . $ext[count($ext) - 1];//set the target path with a new name of image
        $j = $j + 1;//increment the number of uploaded images according to the files in array       
      
	  
		if (($_FILES["file"]["size"][$i] < 10000000) //Approx. 10MB files can be uploaded.
                && in_array($file_extension, $validextensions)) {


            if (move_uploaded_file($_FILES['file']['tmp_name'][$i], $target_path)) {//if file moved to uploads folder
                echo $j. ').<span id="noerror">Image uploaded successfully!.</span><br/><br/>';
                $file = $imagename.".".$file_extension;
                	$query = "INSERT INTO workimages (filename, url,photo_id) ";
					$query .= "VALUES ('$file','$target_path','$id')";
               	mysqli_query($con, $query) or die(mysqli_error($con));
			   	//echo $query;

                
            } else {//if file was not moved.
                echo $j. ').<span id="error">please try again!</span><br/><br/>';
            }
        } else {//if file size and file type was incorrect.
            echo $j. ').<span id="error">No Additional Photos Were Uploaded</span><br/><br/>';
        }

    }
    $url = get_bloginfo('url');
    $url .= "/upload/";
	echo "Returning you back to <a href='".$url."'>upload</a> page";
	sleep(3); //sleep 5 seconds, then return user to main page.
    echo'<script> window.location="'.$url.'"; </script> ';	
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
function updateCustomer($id, $name, $descr, $tags){
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




?>