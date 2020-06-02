<?php

include 'bbdd_db_conn.php';



$q = intval($_POST['id']); 
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
// $author = mysql_real_escape_string($author);
$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);
$category = $_POST['category'];
$category = mysqli_real_escape_string($conn, $category);
$title = $_POST['title'];
$title = mysqli_real_escape_string($conn, $title);
$content = $_POST['ir1'];
$content = mysqli_real_escape_string($conn, $content);
$display = $_POST['display'];
$display = mysqli_real_escape_string($conn, $display);




        // $sql = 
        //         "UPDATE notice SET 
        //         `author`='$author', 
        //         `username`='$username', 
        //         `category`='$category', 
        //         `title`='$title', 
        //         `content`='$content', 
        //         `display`='$display' 
        //         WHERE `id`='$q'";
        $sql = 
                "UPDATE notice SET 
                author = ?, 
                username = ?, 
                category = ?, 
                title = ?, 
                content = ?, 
                display = ? 
                WHERE id = ?";

$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
                echo "sql error";
        } else {
                mysqli_stmt_bind_param($stmt, "ssssssi", $author, $username, $category, $title, $content, $display, $q);
              
                if(!mysqli_stmt_execute($stmt)){
                    echo '공지 저장실패. 관리자에게 문의해주세요';
                    error_log(mysqli_error($conn));
                }
                else{
                    echo("<script>alert('공지가 수정되었습니다.');location.href='admin_notiList.php';</script>");
                }
            }


// $result = mysqli_query($conn, $sql);
// // $result = $conn->query($sql);


   
//     if($result){
//         echo("<script>alert('공지가 수정되었습니다.');location.href='admin_notiList.php';</script>");
//     }
//     else{
//         echo '공지 저장실패. 관리자에게 문의해주세요';
//         error_log(mysqli_error($conn));
//     }




?>