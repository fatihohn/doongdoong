<?php

include "bbdd_db_conn.php";
// init($conn);
// function init($conn) {
$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
$category = $_POST['category'];
$category = mysqli_real_escape_string($conn, $category);
$cat_detail = $_POST['cat_detail'];
$cat_detail = mysqli_real_escape_string($conn, $cat_detail);
$display = $_POST['display'];
$display = mysqli_real_escape_string($conn, $display);
$publish = $_POST['publish'];
$publish = mysqli_real_escape_string($conn, $publish);



$titleSql = "SELECT * FROM thumbs WHERE category='$category'";
$titleCheck = mysqli_query($conn, $titleSql);
$titleCheck = $titleCheck->fetch_array();
if($titleCheck >= 1){
    echo "<script>alert('연재물 제목이 중복됩니다.'); history.back();</script>";
}else{
    
    $uploadimg = include "admin_create_thumbs_files.php";
    $image = $uploadimg['img'];
    $imageName = {$image}$filename;
    $imageDir = {$image}$target_file;
        
    
    // $sql = "
    //                 INSERT INTO `thumbs`
    //                     (username, author, img, img_dir, category, cat_detail, display, publish, created)
    //                 VALUES(
    //                     '{$username}',
    //                     '{$author}',
    //                     '{$image}$filename',
    //                     '{$image}$target_file',
    //                     '{$category}',
    //                     '{$cat_detail}',
    //                     '{$display}',
    //                     '{$publish}',
    //                     NOW()
    //                     )";
                    $sql = "
                    INSERT INTO `thumbs`
                        (`username`, `author`, `img`, `img_dir`, `category`, `cat_detail`, `display`, `publish`, `created`)
                    VALUES(
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        ?,
                        NOW()
                        )";

                        $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                                echo "sql error";
                        } else {
                                mysqli_stmt_bind_param($stmt, "ssssssss", $username, $author, $imageName, $imageDir, $category, $cat_detail, $display, $publish);
                                
                                if(!mysqli_stmt_execute($stmt)){
                                    echo '저장실패. 관리자에게 문의해주세요';
                                    error_log(mysqli_error($conn));
                                }
                                else{
                                    echo("<script>alert('연재물이 생성되었습니다.');location.href='admin_thumbsList.php';</script>");
                                }
                            }
            
        
    }

// $result = mysqli_query($conn, $sql);


//     if($result === false){
//             echo '저장실패. 관리자에게 문의해주세요';
//             error_log(mysqli_error($conn));
//         }
//         else{
//             echo("<script>alert('연재물이 생성되었습니다.');location.href='admin_thumbsList.php';</script>");
//         }



?>