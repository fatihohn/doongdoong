<?php

include 'bbdd_db_conn.php';



$uploadimg = include 'admin_create_thumbs_files.php';
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
// $author = mysql_real_escape_string($author);
$username = $_POST['username'];
$title = $_POST['title'];

$zin_detail = $_POST['zin_detail'];
$zin_detail = mysqli_real_escape_string($conn, $zin_detail);
// $zin_detail = mysql_real_escape_string($zin_detail);
$display = $_POST['display'];
$publish = $_POST['publish'];



$titleSql = "SELECT * FROM zin WHERE title='$title'";
$titleCheck = mysqli_query($conn, $titleSql);
$titleCheck = $titleCheck->fetch_array();
    if($titleCheck >= 1){
		echo "<script>alert('매거진 제목이 중복됩니다.'); history.back();</script>";
	}else{

        if($publish == "ready") {
        
                $sql = "
                    INSERT INTO zin
                        (author, username, title, zin_detail, display, publish, created)
                    VALUES(
                        '{$author}',
                        '{$username}',
                        '{$title}',
                        '{$zin_detail}',
                        '{$display}',
                        '{$publish}',
                        NOW()
                        )";
            } else if ($publish == "now") {
                $sql = "
                INSERT INTO zin
                    (author, username, title, zin_detail, display, publish, created)
                VALUES(
                    '{$author}',
                    '{$username}',
                    '{$title}',
                    '{$zin_detail}',
                    '{$display}',
                    '{$publish}',
                    NOW()
                    )
                    ";
                    // ON DUPLICATE KEY UPDATE `publish`='ready'
                    // UPDATE INTO zin WHERE title !='$title'
                    //     (publish)
                    // VALUES('ready')  
                $updateSql= 
                    "UPDATE zin SET
                    `publish`='ready'
                    WHERE title != '$title'"; 
                

            }
        


    }

$result = mysqli_query($conn, $sql);

if(isset($updateSql)) {
    $resultNow = mysqli_query($conn, $updateSql);

    if($result === false){
        // if($result === false || $resultUpdate === false){
            echo '저장실패. 관리자에게 문의해주세요';
            error_log(mysqli_error($conn));
        }
        else{
            echo("<script>alert('현재 발행중 매거진이 생성되었습니다.');location.href='admin_zinList.php';</script>");
        }


} else {

// $resultUpdate = mysqli_query($conn, $updateSql);
if($result === false){
// if($result === false || $resultUpdate === false){
    echo '저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}
else{
    echo("<script>alert('매거진이 생성되었습니다.');location.href='admin_zinList.php';</script>");
}
}
// echo $sql;


?>