<?php

include 'bbdd_db_conn.php';



// $uploadimg = include 'admin_create_thumbs_files.php';
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


$sqlNo = "SELECT `no` FROM contents ORDER BY id DESC LIMIT 1";
$resultNo = $conn->query($sqlNo) or die($conn->error);
if($resultNo->num_rows > 0) {
    $rowNo = mysqli_fetch_assoc($resultNo);
    $no = $rowNo['no'];
    $no = intval(intval($no) + 1);
} else {
    $no = "1";
}
// $zin_detail = mysql_real_escape_string($zin_detail);



// $titleSql = "SELECT * FROM zin WHERE title='$title'";
// $titleCheck = mysqli_query($conn, $titleSql);
// $titleCheck = $titleCheck->fetch_array();
//     if($titleCheck >= 1){
// 		echo "<script>alert('매거진 제목이 중복됩니다.'); history.back();</script>";
// 	}else{

//         if($publish == "ready") {
        
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
    //         } else if ($publish == "now") {
    //             $sql = "
    //             INSERT INTO zin
    //                 (author, username, title, zin_detail, display, publish, created)
    //             VALUES(
    //                 '{$author}',
    //                 '{$username}',
    //                 '{$title}',
    //                 '{$zin_detail}',
    //                 '{$display}',
    //                 '{$publish}',
    //                 NOW()
    //                 )
    //                 ";
    //                 // ON DUPLICATE KEY UPDATE `publish`='ready'
    //                 // UPDATE INTO zin WHERE title !='$title'
    //                 //     (publish)
    //                 // VALUES('ready')  
    //             $updateSql= 
    //                 "UPDATE zin SET
    //                 `publish`='ready'
    //                 WHERE title != '$title'"; 
                

    //         }
        


    // }

$result = mysqli_query($conn, $sql);

// if(isset($updateSql)) {
//     $resultNow = mysqli_query($conn, $updateSql);

//     if($result === false){
//         // if($result === false || $resultUpdate === false){
//             echo '저장실패. 관리자에게 문의해주세요';
//             error_log(mysqli_error($conn));
//         }
//         else{
//             echo("<script>alert('현재 발행중 매거진이 생성되었습니다.');location.href='admin_zinList.php';</script>");
//         }


// } else {

// $resultUpdate = mysqli_query($conn, $updateSql);
if($result === false){
// if($result === false || $resultUpdate === false){
    echo '저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}
else{
    echo("<script>alert('게시물이 생성되었습니다.');location.href='admin_contList.php';</script>");
}
// }
// echo $sql;


?>