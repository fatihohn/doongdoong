<?php

include 'bbdd_db_conn.php';



$q = intval($_POST['id']); 
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
// $author = mysql_real_escape_string($author);
$username = $_POST['username'];
$category = $_POST['category'];
// $category = mysqli_real_escape_string($conn, $category);

$cat_detail = $_POST['cat_detail'];
// $cat_detail = mysqli_real_escape_string($conn, $cat_detail);
// $zin_detail = mysql_real_escape_string($zin_detail);
$display = $_POST['display'];
$publish = $_POST['publish'];



$titleSql = "SELECT * FROM thumbs WHERE category='$category'";
$titleCheck = mysqli_query($conn, $titleSql);
$titleCheck = $titleCheck->fetch_array();

$tIdSql = "SELECT * FROM thumbs WHERE id=$q";
$tIdCheck = mysqli_query($conn, $tIdSql);
$tIdCheck = $tIdCheck->fetch_assoc();
    if($titleCheck >= 1 && $tIdCheck['category'] !== $category){
		echo "<script>alert('연재물 제목이 중복됩니다.'); history.back();</script>";
	}else{
        
        
        $sql = 
        "UPDATE thumbs SET 
                `author`='$author', 
                `username`='$username', 
                `category`='$category', 
                `cat_detail`='$cat_detail', 
                `img`='{$uploadimg['img']}$filename',
                `img_dir`='{$uploadimg['img']}$target_file',
                `display`='$display', 
                `publish`='$publish'
                WHERE `id`='$q'";




if($_FILES['img']['size']!==0) {
    unlink($tIdCheck['img_dir']);
    $uploadimg = include 'admin_modify_thumbs_files.php';
        
                $sql0 = 
                "UPDATE thumbs SET 
                `author`='$author', 
                `username`='$username', 
                `category`='$category', 
                `cat_detail`='$cat_detail', 
                `img`='{$uploadimg['img']}$filename',
                `img_dir`='{$uploadimg['img']}$target_file',
                `display`='$display', 
                `publish`='$publish'
                WHERE `id`='$q'";
                $sql = $sql0;
                echo "<br>sql0";
            } else  {
                $sql1 = 
                "UPDATE thumbs SET 
                `author`='$author', 
                `username`='$username', 
                `category`='$category', 
                `cat_detail`='$cat_detail', 
                
                `display`='$display', 
                `publish`='$publish'
                WHERE `id`='$q'";
                $sql = $sql1;
                echo "<br>sql1";

                

            }
        


    }

$result = mysqli_query($conn, $sql);
// $result = $conn->query($sql);


   
    if($result){
        echo("<script>alert('연재물이 수정되었습니다.');location.href='admin_thumbsList.php';</script>");
    }
    else{
        echo '연재물 저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }

    



?>