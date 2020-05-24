<?php
	include "bbdd_db_conn.php";
	$authorName = $_GET["q"];
	// $authorName = $_GET["username"];
	$sql = "SELECT * FROM user_data WHERE author='$authorName'";
    $result = $conn->query($sql);
    $member = mysqli_fetch_assoc($result);
	if($member==0)
	{
?>
	<div style='font-family:"malgun gothic"';><?php echo $authorName; ?>는 사용가능한 필명입니다.</div>
<?php 
	}else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $authorName; ?>는 중복된 필명입니다.<div>
<?php
	}
?>
