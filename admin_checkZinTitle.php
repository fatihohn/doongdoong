<?php
	include "bbdd_db_conn.php";
	$zinTitle = $_GET["q"];
	// $zinTitle = $_GET["username"];
	$sql = "SELECT * FROM zin WHERE title='$zinTitle'";
    $result = $conn->query($sql);
    $member = mysqli_fetch_assoc($result);
	if($member==0)
	{
?>
	<div style='font-family:"malgun gothic"';><?php echo $zinTitle; ?>는 사용가능한 매거진입니다.</div>
<?php 
	}else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $zinTitle; ?>는 중복된 매거진입니다.<div>
<?php
	}
?>
