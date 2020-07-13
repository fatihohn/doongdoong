<?php

include 'bbdd_db_conn.php';




$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);

$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);

$title = $_POST['title'];
$title = mysqli_real_escape_string($conn, $title);

$zin_detail = $_POST['zin_detail'];
$zin_detail = mysqli_real_escape_string($conn, $zin_detail);

$display = $_POST['display'];
$display = mysqli_real_escape_string($conn, $display);

$publish = $_POST['publish'];
$publish = mysqli_real_escape_string($conn, $publish);

$zin_column = $_POST['zin_column'];
$zin_column = mysqli_real_escape_string($conn, $zin_column);

$zin_color = $_POST['zin_color'];
$zin_color = mysqli_real_escape_string($conn, $zin_color);

$title_color = $_POST['title_color'];
$title_color = mysqli_real_escape_string($conn, $title_color);

$date = $_POST['date'];

$titleSql = "SELECT * FROM zin WHERE title='$title'";
$titleCheck = mysqli_query($conn, $titleSql);
$titleCheck = $titleCheck->fetch_array();

$dQuote = '"';
$sQuote = "'";

    if($titleCheck >= 1){
		echo "<script>alert('매거진 제목이 중복됩니다.'); history.back();</script>";
    }else if(strpos($title, $dQuote) == true || strpos($title, $sQuote) == true) {
		echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
    }else if(preg_match('/[\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u', $zinTitle) && mb_strlen($zinTitle, "UTF-8") >= 21) {
     
        echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
       
    }else if(!preg_match('/[\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u', $zinTitle) && strlen($zinTitle) >= 25) {
 
        echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
      

    } else {
        $uploadimg = include "admin_create_zin_files.php";
        $image = $uploadimg['img'];
   

        if($publish == "ready") {
        
                $sql = "
                    INSERT INTO zin
                        (author, username, title, img, img_dir, zin_detail, display, publish, column, zin_color, title_color, date, created)
                    VALUES(
                        '{$author}',
                        '{$username}',
                        '{$title}',
                        '{$image}$filename',
                        '{$image}$target_file',
                        '{$zin_detail}',
                        '{$display}',
                        '{$publish}',
                        '{$zin_column}',
                        '{$zin_color}',
                        '{$title_color}',
                        '{$date}',
                        NOW()
                        )";

            } else if ($publish == "now") {
                $sql = "
                INSERT INTO zin
                    (author, username, title, img, img_dir, zin_detail, display, publish, column, zin_color, title_color, date, created)
                VALUES(
                    '{$author}',
                    '{$username}',
                    '{$title}',
                    '{$image}$filename',
                    '{$image}$target_file',
                    '{$zin_detail}',
                    '{$display}',
                    '{$publish}',
                    '{$zin_column}',
                    '{$zin_color}',
                    '{$title_color}',
                    '{$date}',
                    NOW()
                    )
                    ";
                 
                $updateSql= 
                    "UPDATE zin SET
                    `publish`='ready'
                    WHERE `publish` = 'now' AND title != '$title'"; 

            } else if ($publish == "standing") {
                $sql = "
                INSERT INTO zin
                    (author, username, title, img, img_dir, zin_detail, display, publish, column, zin_color, title_color, date, created)
                VALUES(
                    '{$author}',
                    '{$username}',
                    '{$title}',
                    '{$image}$filename',
                    '{$image}$target_file',
                    '{$zin_detail}',
                    '{$display}',
                    '{$publish}',
                    '{$zin_column}',
                    '{$zin_color}',
                    '{$title_color}',
                    '{$date}',
                    NOW()
                    )
                    ";
                 
                $updateSql= 
                    "UPDATE zin SET
                    `publish`='ready'
                    WHERE `publish` = 'standing' AND title != '$title'"; 

            }
    }


$result = mysqli_query($conn, $sql);

if(isset($updateSql)) {
    $resultNow = mysqli_query($conn, $updateSql);
    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }
    else{
        echo("<script>alert('현재 발행중 매거진이 생성되었습니다.');location.href='admin_zinList.php';</script>");
    }
} else {

    if($result === false){
        echo '저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }
    else{
        echo("<script>alert('매거진이 생성되었습니다.');location.href='admin_zinList.php';</script>");
    }
}

?>