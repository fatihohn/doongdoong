<?php
	include "bbdd_db_conn.php";
	$authCat = $_GET["q"];
	
	
	// echo $authCat; 
	$sessOnSql = "SELECT * FROM contents WHERE `category` = '$authCat' AND `display`='on' ORDER BY sess*1 DESC LIMIT 1 ";
	$resultSessOn = $conn->query($sessOnSql);    
	$rowSessOn = $resultSessOn->fetch_assoc();
	$sessOnLatest = intval($rowSessOn['sess']);


	$sessOkSql = "SELECT * FROM contents WHERE (`category` = '$authCat' AND `display`='on') OR (`category` = '$authCat' AND `display`='ok') ORDER BY sess*1 DESC LIMIT 1 ";
	$resultSessOk = $conn->query($sessOkSql);    
	$rowSessOk = $resultSessOk->fetch_assoc();
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
