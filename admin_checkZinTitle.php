<?php
	include "bbdd_db_conn.php";
	$zinTitle = $_GET["q"];
	// $zinTitle = $_GET["username"];
	// $sql = "SELECT * FROM zin WHERE title='$zinTitle'";
	$sql = "SELECT * FROM zin WHERE title=?";

	$stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        // echo "sql error";
    } else {
    mysqli_stmt_bind_param($stmt, "s", $zinTitle);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    }

    // $result = $conn->query($sql);
	$member = mysqli_fetch_assoc($result);
	
	$dQuote = '"';
	$sQuote = '\'';

	if($member==0){

		// if(strpos($zinTitle, $dQuote) == true || strpos($title, $sQuote) == true) {
		if(strpos($zinTitle, $dQuote) == true || preg_match("/'/u", $zinTitle)) {
		
			?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $zinTitle; ?>는 사용불가능한 매거진입니다.<div>
<?php
}else if(strlen($zinTitle) > 7) {
			?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $zinTitle; ?>는 사용불가능한 매거진입니다.<div>
<?php
	

		} else {

			
			?>
	<div style='font-family:"malgun gothic"';><?php echo $zinTitle; ?>는 사용가능한 매거진입니다.</div>
<?php 
		}
	}else{
?>
	<div style='font-family:"malgun gothic"; color:red;'><?php echo $zinTitle; ?>는 중복된 매거진입니다.<div>
<?php
	}
?>
