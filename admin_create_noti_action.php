<?php

include 'bbdd_db_conn.php';



$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);

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

$sqlNo = "SELECT `no` FROM notice ORDER BY id DESC LIMIT 1";
$resultNo = $conn->query($sqlNo) or die($conn->error);
if($resultNo->num_rows > 0) {
    $rowNo = mysqli_fetch_assoc($resultNo);
    $no = $rowNo['no'];
    $no = intval(intval($no) + 1);
} else {
    $no = "1";
}
        
                $sql = "
                    INSERT INTO notice
                        (no, author, username, category, title, content, display, created)
                    VALUES(
                        '{$no}',
                        '{$author}',
                        '{$username}',
                        '{$category}',
                        '{$title}',
                        '{$content}',
                        '{$display}',
                        NOW()
                        )";
        //         $sql = "
        //             INSERT INTO `notice`
        //                 (`no`, `author`, `username`, `category`, `title`, `content`, `display`, `created`)
        //             VALUES(
        //                 ?,
        //                 ?,
        //                 ?,
        //                 ?,
        //                 ?,
        //                 ?,
        //                 ?,
        //                 NOW()
        //                 )";
    
        // $stmt = mysqli_stmt_init($conn);
        // if (!mysqli_stmt_prepare($stmt, $sql)) {
        //         echo "sql error";
        // } else {
        //         mysqli_stmt_bind_param($stmt, "issssss", $no, $author, $username, $category, $title, $content, $display);
                
        //         if(!mysqli_stmt_execute($stmt)){
        //             echo '저장실패. 관리자에게 문의해주세요';
        //             error_log(mysqli_error($conn));
        //         }
        //         else{
        //             echo("<script>alert('게시물이 생성되었습니다.');location.href='admin_notiList.php';</script>");
        //         }
        //     }

$result = mysqli_query($conn, $sql);

if($result === false){
    echo '저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}
else{
    echo("<script>alert('게시물이 생성되었습니다.');location.href='admin_notiList.php';</script>");
}



?>