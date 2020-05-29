<?php
	include "bbdd_db_conn.php";
	$authCat = $_GET["q"];
	$displayOn = "on";
	$displayOk = "ok";
	
	// echo $authCat; 
	// $sessOnSql = "SELECT * FROM contents WHERE `category` = '$authCat' AND `display`='on' ORDER BY sess*1 DESC LIMIT 1 ";
	$sessOnSql = "SELECT * FROM contents WHERE `category` = ? AND `display` = ? ORDER BY sess*1 DESC LIMIT 1 ";
	
	$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sessOnSql)) {
                echo "sessOnSql error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $authCat, $displayOn);
                mysqli_stmt_execute($stmt);
                $resultSessOn = mysqli_stmt_get_result($stmt);
                $rowSessOn = mysqli_fetch_assoc($resultSessOn);
                // mysqli_stmt_close();
        }
	
	// $resultSessOn = $conn->query($sessOnSql);    
	// $rowSessOn = $resultSessOn->fetch_assoc();
	$sessOnLatest = intval($rowSessOn['sess']);


	// $sessOkSql = "SELECT * FROM contents WHERE (`category` = '$authCat' AND `display`='on') OR (`category` = '$authCat' AND `display`='ok') ORDER BY sess*1 DESC LIMIT 1 ";
	$sessOkSql = "SELECT * FROM contents WHERE (`category` = ? AND `display`=?) OR (`category` = ? AND `display`=?) ORDER BY sess*1 DESC LIMIT 1 ";
	
	$stmt = mysqli_stmt_init($conn);
	if (!mysqli_stmt_prepare($stmt, $sessOkSql)) {
			echo "sessOkSql error";
	} else {
			mysqli_stmt_bind_param($stmt, "ssss", $authCat, $displayOn, $authCat, $displayOk);
			mysqli_stmt_execute($stmt);
			$resultSessOk = mysqli_stmt_get_result($stmt);
			$rowSessOk = mysqli_fetch_assoc($resultSessOk);
			// mysqli_stmt_close();
	}
	
	// $resultSessOk = $conn->query($sessOkSql);    
	// $rowSessOk = $resultSessOk->fetch_assoc();
	$sessOk = intval($rowSessOk['sess']);
	$sessOkLatest = intval($rowSessOk['sess']);
	
	echo "
	<label class='createGrid1'>
	
	회차
	</label>";
	
	echo '<select class="createGrid2" name="sess" id="sessCat" required>';
	if($sessOk-1 < 0) {
		echo "
		<option class='sess_slct' value='1'>1회</option>
		<option class='sess_slct' value='2'>2회</option>
		<option class='sess_slct' value='3'>3회</option>
		<option class='sess_slct' value='4'>4회</option>
		<option class='sess_slct' value='5'>5회</option>
		<option class='sess_slct' value='6'>6회</option>
		<option class='sess_slct' value='7'>7회</option>
		<option class='sess_slct' value='8'>8회</option>
		<option class='sess_slct' value='9'>9회</option>
		<option class='sess_slct' value='10'>10회</option>
		";
		
	} else {
		
		$sessNum = 1;
		while($sessOk+10 >= 0) {
			echo "<option class='sess_slct' value='";
			echo $sessNum;
			echo "'>";
			echo $sessNum;
			echo "회</option>";
			$sessOk = $sessOk-1;
			$sessNum++;
			
		}
		
		
	}		
	echo "</select>";
	echo " 최신 발행 회차 ";
	echo $sessOnLatest;
	echo "회 | ";
	echo " 최신 내부공개 회차 ";
	echo $sessOkLatest;
	echo "회";

	?>
