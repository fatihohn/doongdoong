<?php
	include "bbdd_db_conn.php";
	$category = $_GET["q"];
	// $category = $_GET["username"];
	$sql = "SELECT * FROM thumbs WHERE category='$category'";
    $result = $conn->query($sql);
    $member = mysqli_fetch_assoc($result);
	if($member==0)
	{
?>
	<div style='font-family:"malgun gothic"';><?php echo $category; ?>는 사용가능한 연재물 제목입니다.</div>
<?php 
	}else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $category; ?>는 중복된 연재물 제목입니다.<div>
<?php
	}
?>
