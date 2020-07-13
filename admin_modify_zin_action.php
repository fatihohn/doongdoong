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
$zin_column = $_POST['zin_column'];
$zin_color = $_POST['zin_color'];
$title_color = $_POST['title_color'];
$date = $_POST['date'];



$titleSql = "SELECT * FROM zin WHERE title='$title'";
$titleCheck = mysqli_query($conn, $titleSql);
$titleCheck = $titleCheck->fetch_array();

$tIdSql = "SELECT * FROM zin WHERE id=$q";
$tIdCheck = mysqli_query($conn, $tIdSql);
$tIdCheck = $tIdCheck->fetch_assoc();

$dQuote = '"';
$sQuote = "'";

//     echo "<script>alert('매거진 제목이 중복됩니다.'); history.back();</script>";
// }else if(strpos($title, $dQuote) == true || strpos($title, $sQuote) == true) {
    // 	echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
    // if($titleCheck >= 1){
    if($titleCheck >= 1 && $tIdCheck['title'] !== $title){
		echo "<script>alert('매거진 제목이 중복됩니다.'); history.back();</script>";
    }else if(strpos($title, $dQuote) == true || strpos($title, $sQuote) == true) {
		echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
    }else if(preg_match('/[\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u', $zinTitle) && mb_strlen($zinTitle, "UTF-8") >= 21) {
     
        echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
       
    }else if(!preg_match('/[\x{3130}-\x{318F}\x{AC00}-\x{D7AF}]/u', $zinTitle) && strlen($zinTitle) >= 25) {
 
        echo "<script>alert('사용불가능한 매거진 제목입니다.'); history.back();</script>";
      

	}else{
        $zin = $title;
        $zin_original = $tIdCheck['title'];
        if($zin !== $zin_original) {

            $updateZinSql = 
                "UPDATE contents SET
                `zin`='$zin'
                WHERE `zin`='$zin_original'";
        }


        if($_FILES['img']['size']!==0) {
            unlink($tIdCheck['img_dir']);
            $uploadimg = include 'admin_modify_zin_files.php';
            $image = $uploadimg['img'];
            $sql = 
                    "UPDATE zin SET 
                    `author`='$author', 
                    `username`='$username', 
                    `title`='$title', 
                    `img`='{$image}$filename',
                    `img_dir`='{$image}$target_file',
                    `zin_detail`='$zin_detail', 
                    `display`='$display', 
                    `publish`='$publish',
                    `zin_column`='$zin_column',
                    `zin_color`='$zin_color',
                    `title_color`='$title_color',
                    `date`='$date'
                    WHERE `id`='$q'";
            if($publish == "ready") {
        
                $sql0 = 
                "UPDATE zin SET 
                `author`='$author', 
                `username`='$username', 
                `title`='$title',
                `img`='{$image}$filename',
                `img_dir`='{$image}$target_file', 
                `zin_detail`='$zin_detail', 
                `display`='$display', 
                `publish`='$publish',
                `zin_column`='$zin_column',
                `zin_color`='$zin_color',
                `title_color`='$title_color',
                `date`='$date'
                WHERE `id`='$q'";
                $sql = $sql0;
                echo "<br>sql0";
            } else if ($publish == "now") {
                $sql1 = 
                "UPDATE zin SET 
                `author`='$author', 
                `username`='$username', 
                `title`='$title', 
                `img`='{$image}$filename',
                `img_dir`='{$image}$target_file',
                `zin_detail`='$zin_detail', 
                `display`='$display', 
                `publish`='$publish',
                `zin_column`='$zin_column',
                `zin_color`='$zin_color',
                `title_color`='$title_color',
                `date`='$date'
                WHERE `id`='$q'";
                $sql = $sql1;
                echo "<br>sql1";

                $updateSql= 
                    "UPDATE zin SET
                    `publish`='ready'
                    WHERE `publish` = 'now' AND `title` != '$title'"; 
                echo "<br>updateNow";    
            } else if ($publish == "standing") {
                $sql2 = 
                "UPDATE zin SET 
                `author`='$author', 
                `username`='$username', 
                `title`='$title', 
                `img`='{$image}$filename',
                `img_dir`='{$image}$target_file',
                `zin_detail`='$zin_detail', 
                `display`='$display', 
                `publish`='$publish',
                `zin_column`='$zin_column',
                `zin_color`='$zin_color',
                `title_color`='$title_color',
                `date`='$date'
                WHERE `id`='$q'";
                $sql = $sql2;
                echo "<br>sql2";

                $updateSql= 
                    "UPDATE zin SET
                    `publish`='ready'
                    WHERE `publish` = 'standing' AND `title` != '$title'"; 
                echo "<br>updateNow";    
            }

        } else {
            $sql = 
            "UPDATE zin SET 
            `author`='$author', 
            `username`='$username', 
            `title`='$title', 
            `zin_detail`='$zin_detail', 
            `display`='$display', 
            `publish`='$publish',
            `zin_column`='$zin_column',
            `zin_color`='$zin_color',
            `title_color`='$title_color',
            `date`='$date'
            WHERE `id`='$q'";
        if($publish == "ready") {
            $sql3 = 
            "UPDATE zin SET 
            `author`='$author', 
            `username`='$username', 
            `title`='$title', 
            `zin_detail`='$zin_detail', 
            `display`='$display', 
            `publish`='$publish',
            `zin_column`='$zin_column',
            `zin_color`='$zin_color',
            `title_color`='$title_color',
            `date`='$date'
            WHERE `id`='$q'";
            $sql = $sql3;
            echo "<br>sql3";
        } else if ($publish == "now") {
            $sql4 = 
            "UPDATE zin SET 
            `author`='$author', 
            `username`='$username', 
            `title`='$title', 
            `zin_detail`='$zin_detail', 
            `display`='$display', 
            `publish`='$publish',
            `zin_column`='$zin_column',
            `zin_color`='$zin_color',
            `title_color`='$title_color',
            `date`='$date'
            WHERE `id`='$q'";
            $sql = $sql4;
            echo "<br>sql4";

            $updateSql= 
                "UPDATE zin SET
                `publish`='ready'
                WHERE `title` != '$title'"; 
            echo "<br>updateNow";    
        } else if ($publish == "standing") {
            $sql5 = 
            "UPDATE zin SET 
            `author`='$author', 
            `username`='$username', 
            `title`='$title', 
            `zin_detail`='$zin_detail', 
            `display`='$display', 
            `publish`='$publish',
            `zin_column`='$zin_column',
            `zin_color`='$zin_color',
            `title_color`='$title_color',
            `date`='$date'
            WHERE `id`='$q'";
            $sql = $sql5;
            echo "<br>sql5";

            $updateSql= 
                "UPDATE zin SET
                `publish`='ready'
                WHERE `publish` = 'standing' AND `title` != '$title'"; 
            echo "<br>updateNow";    
        }
            
        }


    }

$result = mysqli_query($conn, $sql);
// $result = $conn->query($sql);

if(!isset($updateSql)) {
   if(!isset($updateZinSql)){

       if($result){
           echo("<script>alert('매거진이 수정되었습니다.');location.href='admin_zinList.php';</script>");
        }
        else{
            echo '매거진 저장실패. 관리자에게 문의해주세요';
            error_log(mysqli_error($conn));
        }
    } else {
        $resultNewTitle = mysqli_query($conn, $updateZinSql);

    if($result && $resultNewTitle){
        echo("<script>alert('매거진이 수정되었습니다.');location.href='admin_zinList.php';</script>");
    }
    else{
        echo '매거진 저장실패. 관리자에게 문의해주세요';
    }
}
} else {
    if(!isset($updateZinSql)){
        $resultNow = mysqli_query($conn, $updateSql);

        if($result && $resultNow){
            echo("<script>alert('현재 발행중 매거진으로 수정되었습니다.');location.href='admin_zinList.php';</script>");
        }
        else{
            echo '현재 발행중 매거진 저장실패. 관리자에게 문의해주세요';
            // error_log(mysqli_error($conn));
        }
    } else {
        $resultNow = mysqli_query($conn, $updateSql);
        $resultNewTitle = mysqli_query($conn, $updateZinSql);
        if($result && $resultNow && $resultNewTitle){
            echo("<script>alert('현재 발행중 매거진으로 수정되었습니다.');location.href='admin_zinList.php';</script>");
        }
        else{
            echo '현재 발행중 매거진 저장실패. 관리자에게 문의해주세요';
            // error_log(mysqli_error($conn));
        }
    }

}



?>