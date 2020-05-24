<?php

include 'bbdd_db_conn.php';



$q = intval($_POST['id']); 
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

$tIdSql = "SELECT * FROM zin WHERE id=$q";
$tIdCheck = mysqli_query($conn, $tIdSql);
$tIdCheck = $tIdCheck->fetch_assoc();
    if($titleCheck >= 1 && $tIdCheck['title'] !== $title){
		echo "<script>alert('매거진 제목이 중복됩니다.'); history.back();</script>";
	}else{

        $sql = 
                "UPDATE zin SET 
                `author`='$author', 
                `username`='$username', 
                `title`='$title', 
                `zin_detail`='$zin_detail', 
                `display`='$display', 
                `publish`='$publish'
                WHERE `id`='$q'";




        if($publish == "ready") {
        
                $sql0 = 
                "UPDATE zin SET 
                `author`='$author', 
                `username`='$username', 
                `title`='$title', 
                `zin_detail`='$zin_detail', 
                `display`='$display', 
                `publish`='$publish'
                WHERE `id`='$q'";
                $sql = $sql0;
                echo "<br>sql0";
            } else if ($publish == "now") {
                $sql1 = 
                "UPDATE zin SET 
                `author`='$author', 
                `username`='$username', 
                `title`='$title', 
                `zin_detail`='$zin_detail', 
                `display`='$display', 
                `publish`='$publish'
                WHERE `id`='$q'";
                $sql = $sql1;
                echo "<br>sql1";

                $updateSql= 
                    "UPDATE zin SET
                    `publish`='ready'
                    WHERE `title` != '$title'"; 
                echo "<br>updateNow";
                

            }
        


    }

$result = mysqli_query($conn, $sql);
// $result = $conn->query($sql);

if(!isset($updateSql)) {
   
    if($result){
        echo("<script>alert('매거진이 수정되었습니다.');location.href='admin_zinList.php';</script>");
    }
    else{
        echo '매거진 저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }
} else {

    $resultNow = mysqli_query($conn, $updateSql);

    if($result && $resultNow){
        echo("<script>alert('현재 발행중 매거진으로 수정되었습니다.');location.href='admin_zinList.php';</script>");
    }
    else{
        echo '현재 발행중 매거진 저장실패. 관리자에게 문의해주세요';
        // echo '<br>'.$q;
        // echo '<br>'.$author;
        // echo '<br>'.$title;
        // echo '<br>'.$zin_detail;
        // echo '<br>'.$display;
        // echo '<br>'.$publish;
        // echo '<br>'.$sql.'<br>';
        // echo '<br>'.var_dump($result);
        // echo '<br>'.var_dump($resultNow);

        error_log(mysqli_error($conn));
    }

}



?>