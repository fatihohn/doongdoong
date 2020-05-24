<?php
	include "bbdd_db_conn.php";
	$uid = $_GET["q"];
	// $uid = $_GET["username"];
	$sql = "SELECT * FROM user_data WHERE username='$uid'";
    $result = $conn->query($sql);
    $member = mysqli_fetch_assoc($result);
	if($member==0)
	{
?>
	<div style='font-family:"malgun gothic"';><?php echo $uid; ?>는 사용가능한 아이디입니다.</div>
<?php 
	}else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $uid; ?>는 중복된 아이디입니다.<div>
<?php
	}
?>
