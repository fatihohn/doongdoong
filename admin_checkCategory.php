<?php
	include "bbdd_db_conn.php";
	$category = $_GET["q"];
	// $category = $_GET["username"];
	// $sql = "SELECT * FROM thumbs WHERE category='$category'";
	$sql = "SELECT * FROM thumbs WHERE category=?";

	$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // echo "sql error";
    } else {
    mysqli_stmt_bind_param($stmt, "s", $category);
    mysqli_stmt_execute($stmt);
    $resultresultPrev = mysqli_stmt_get_result($stmt);
    }

    // $result = $conn->query($sql);
	$member = mysqli_fetch_assoc($result);
	$dQuote = '"';

	if($member==0) {

		if(strpos($category, $dQuote) == true) {
			?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $category; ?>는 사용불가능한 연재물 제목입니다.<div>
<?php
		} else {


?>
	<div style='font-family:"malgun gothic"';><?php echo $category; ?>는 사용가능한 연재물 제목입니다.</div>
<?php 
		}


	}else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $category; ?>는 중복된 연재물 제목입니다.<div>
<?php
	}
?>
