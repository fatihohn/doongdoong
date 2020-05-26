<?php

include "bbdd_db_conn.php";
// init($conn);
// function init($conn) {
$username = $_POST['username'];
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
$category = $_POST['category'];
$category = mysqli_real_escape_string($conn, $category);
$cat_detail = $_POST['cat_detail'];
$cat_detail = mysqli_real_escape_string($conn, $cat_detail);
$display = $_POST['display'];
$publish = $_POST['publish'];



$titleSql = "SELECT * FROM thumbs WHERE category='$category'";
$titleCheck = mysqli_query($conn, $titleSql);
$titleCheck = $titleCheck->fetch_array();
if($titleCheck >= 1){
    echo "<script>alert('연재물 제목이 중복됩니다.'); history.back();</script>";
}else{
    
    $uploadimg = include "admin_create_thumbs_files.php";
    $image = $uploadimg['img'];
    // $img = "{$uploadimg['img']}$filename";
    // $img_dir = "{$uploadimg['img']}$target_file";
    // '{$img}',
    // '{$img_dir}',
    // '{$uploadimg['img']}$filename',
    // '{$uploadimg['img']}$target_file',
        
    
    $sql = "
                    INSERT INTO `thumbs`
                        ('username', 'author', 'img', 'img_dir', 'category', 'cat_detail', 'display', 'publish', 'created')
                    VALUES(
                        '{$username}',
                        '{$author}',
                        '{$image}$filename',
                        '{$image}$target_file',
                        '{$category}',
                        '{$cat_detail}',
                        '{$display}',
                        '{$publish}',
                        NOW()
                        )";
                // $sql = 
                // "INSERT INTO thumbs SET 
                // `username`='$username', 
                // `author`='$author', 
                // `img`='{$uploadimg['img']}$filename',
                // `img_dir`='{$uploadimg['img']}$target_file',
                // `category`='$category', 
                // `cat_detail`='$cat_detail', 
                // `display`='$display', 
                // `publish`='$publish',
                // `created`=Now()";
            
        
    }

$result = mysqli_query($conn, $sql);


    if($result === false){
        // if($result === false || $resultUpdate === false){
            // echo '저장실패. 관리자에게 문의해주세요<br>'.$sql.'<br>'.$result.'<br>'.mysqli_connect_error($conn).'<br>'.error_log(mysqli_error($conn));
            echo '저장실패. 관리자에게 문의해주세요<br>'.$sql.'<br>'."{$image}$filename".'<br>'."{$image}$target_file".'<br>'.$result.'<br>'. mysqli_connect_error($conn);
            error_log(mysqli_error($conn));
            error_log(mysqli_connect_error($conn));
        }
        else{
            echo("<script>alert('연재물이 생성되었습니다.');location.href='admin_thumbsList.php';</script>");
        }

    // }


?>