<?php
// default redirection
$url = 'callback.html?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if($bSuccessUpload) {

	include "../../../bbdd_db_conn.php";
		$sqlNoBefore = "SELECT `no` FROM notice ORDER BY id DESC LIMIT 1";
		$resultNoBefore = $conn->query($sqlNoBefore) or die($conn->error);
		$rowNoBefore = mysqli_fetch_assoc($resultNoBefore);
		$contNoBefore = $rowNoBefore['no'];
		$contNoThis = $contNoBefore + 1;

	$tmp_name = $_FILES['Filedata']['tmp_name'];
	// $name = $_FILES['Filedata']['name'];
	$name = "n".$contNoThis."_".$_FILES['Filedata']['name'];
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		$uploadDir = '../../upload/';
		// $uploadDir = '../../../uploads/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.urlencode("n".$contNoThis."_".$_FILES['Filedata']['name']);
		
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		// $url .= "&sFileURL=upload/".urlencode(urlencode($name));
		$url .= "&sFileURL=se2/upload/".urlencode(urlencode($name));
		// $url .= "&bNewLine=true";
		// $url .= "&sFileName=".urlencode(urlencode($name));
		// // $url .= "&sFileURL=upload/".urlencode(urlencode($name));
		// $url .= "&sFileURL=se2/upload/".urlencode(urlencode($name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>