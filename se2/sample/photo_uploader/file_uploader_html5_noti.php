<?php
	$sFileInfo = '';
	$headers = array();
	
	foreach($_SERVER as $k => $v) {
		if(substr($k, 0, 9) == "HTTP_FILE") {
			$k = substr(strtolower($k), 5);
			$headers[$k] = $v;
		} 
	}
	
	$filename = rawurldecode($headers['file_name']);
	$filename_ext = strtolower(array_pop(explode('.',$filename)));
	$allow_file = array("jpg", "png", "bmp", "gif"); 
	
	if(!in_array($filename_ext, $allow_file)) {
		echo "NOTALLOW_".$filename;
	} else {
		include "../../../bbdd_db_conn.php";
		$sqlNoBefore = "SELECT `no` FROM notice ORDER BY id DESC LIMIT 1";
		$resultNoBefore = $conn->query($sqlNoBefore) or die($conn->error);
		$rowNoBefore = mysqli_fetch_assoc($resultNoBefore);
		$contNoBefore = $rowNoBefore['no'];
		$contNoThis = $contNoBefore + 1;

		$file = new stdClass;

		$file->name = "n".$contNoThis."_".date("YmdHis").mt_rand().".".$filename_ext;

		$file->content = file_get_contents("php://input");

		$uploadDir = '../../upload/';
		// $uploadDir = '../../../uploads/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		
		$newPath = $uploadDir.$file->name;
		
		if(file_put_contents($newPath, $file->content)) {
			$sFileInfo .= "&bNewLine=true";
			$sFileInfo .= "&sFileName=".$filename;
			$sFileInfo .= "&sFileURL=se2/upload/".$file->name;
		}
		
		echo $sFileInfo;
	}
?>