<?php
	include "bbdd_db_conn.php";
	$uid = $_GET["q"];
	// $uid = $_GET["username"];
	$sql = "SELECT * FROM user_data WHERE username='$uid'";
    $result = $conn->query($sql);
    $member = mysqli_fetch_assoc($result);
	// if($member==0 && ctype_alnum($uid) && strlen($uid)>=8)
	if($member==0 && preg_match("/^[a-zA-Z](?=.{0,28}[0-9])[0-9a-zA-Z]{6,29}$/", $uid) && strlen($uid)>=7)
	{
?>
		<div style='font-family:"malgun gothic";'><?php echo $uid; ?>는 사용가능한 아이디입니다.</div>
		<?php 
	}else{
		?>
		<div style='font-family:"malgun gothic"; color:red;'><?php echo $uid; ?>는 사용할 수 없는 아이디입니다.<div>
<?php
	}

	




?>
