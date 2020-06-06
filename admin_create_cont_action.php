<?php

include 'bbdd_db_conn.php';



$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);

$username = $_POST['username'];
$username = mysqli_real_escape_string($conn, $username);

$category = $_POST['category'];
$category = mysqli_real_escape_string($conn, $category);

$sess = $_POST['sess'];
$sess = mysqli_real_escape_string($conn, $sess);

$zin = $_POST['zin'];
$zin = mysqli_real_escape_string($conn, $zin);

$title = $_POST['title'];
$title = mysqli_real_escape_string($conn, $title);

$content = $_POST['ir1'];
$content = mysqli_real_escape_string($conn, $content);

$display = $_POST['display'];
$display = mysqli_real_escape_string($conn, $display);

$memo = $_POST['memo'];
$memo = mysqli_real_escape_string($conn, $memo);


// $id = "id";
$sqlNo = "SELECT `no` FROM contents ORDER BY id DESC LIMIT 1";
// $stmt = mysqli_stmt_init($conn);
// if (!mysqli_stmt_prepare($stmt, $sqlNo)) {
//         echo "sqlNo error";
//     } else {
//             // mysqli_stmt_bind_param($stmt, , );
//             mysqli_stmt_execute($stmt);
//             $resultNo = mysqli_stmt_get_result($stmt);
//             if($resultNo->num_rows > 0) {
//                     $rowNo = mysqli_fetch_assoc($resultNo);
//                     $no = $rowNo['no'];
//                     $no = intval(intval($no) + 1);
//                 } else {
//                         $no = "1";
//                     }
//                     // mysqli_stmt_close();
//                 }
                
                // $sqlNo = "SELECT `no` FROM contents ORDER BY id DESC LIMIT 1";
                $resultNo = $conn->query($sqlNo) or die($conn->error);
                if($resultNo->num_rows > 0) {
                    $rowNo = mysqli_fetch_assoc($resultNo);
                    $no = $rowNo['no'];
                    $no = intval(intval($no) + 1);
                } else {
                    $no = "1";
                }
                
                
                $sql = "
                INSERT INTO contents
                        (no, author, username, category, sess, zin, title, content, display, memo, created)
                    VALUES(
                            '{$no}',
                            '{$author}',
                            '{$username}',
                            '{$category}',
                            '{$sess}',
                            '{$zin}',
                            '{$title}',
                            '{$content}',
                            '{$display}',
                            '{$memo}',
                            NOW()
                            )";
                            
                            $result = mysqli_query($conn, $sql);
                            if($result === false){
                                echo '저장실패. 관리자에게 문의해주세요';
                                error_log(mysqli_error($conn));
                            }
                            else{
                                echo("<script>alert('게시물이 생성되었습니다.');location.href='admin_contList.php';</script>");
                            }
                    
                    
        //             // $created = mysqli_real_escape_string($conn, NOW());
        //             $sql = "
        //             INSERT INTO `contents`
        //                     (`no`, `author`, `username`, `category`, `sess`, `zin`, `title`, `content`, `display`, `memo`, `created`)
        //                 VALUES(
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         ?,
        //                         NOW()
        //                 );";

        // $stmt = mysqli_stmt_init($conn);
        // if (!mysqli_stmt_prepare($stmt, $sql)) {
        //         echo "sql error";
        // } else {
        //         mysqli_stmt_bind_param($stmt, "isssssssss", $no, $author, $username, $category, $sess, $zin, $title, $content, $display, $memo);
        //         // mysqli_stmt_execute($stmt);
        //         // $result = mysqli_stmt_get_result($stmt);
        //         if(!mysqli_stmt_execute($stmt)){
        //         // if($result === false){
        //             echo '저장실패. 관리자에게 문의해주세요';
        //             error_log(mysqli_error($conn));
        //         }
        //         else{
        //             echo("<script>alert('게시물이 생성되었습니다.');location.href='admin_contList.php';</script>");
        //         }
        //         // mysqli_stmt_close();
        //     }
            
            


?>