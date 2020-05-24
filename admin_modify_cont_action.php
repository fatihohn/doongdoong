<?php

include 'bbdd_db_conn.php';



$q = intval($_POST['id']); 
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
// $author = mysql_real_escape_string($author);
$username = $_POST['username'];
$category = $_POST['category'];
$sess = $_POST['sess'];
$zin = $_POST['zin'];
$title = $_POST['title'];
$title = mysqli_real_escape_string($conn, $title);
$content = $_POST['ir1'];
$content = mysqli_real_escape_string($conn, $content);

$display = $_POST['display'];
$memo = $_POST['memo'];
$memo = mysqli_real_escape_string($conn, $memo);




        $sql = 
                "UPDATE contents SET 
                `author`='$author', 
                `username`='$username', 
                `category`='$category', 
                `sess`='$sess', 
                `zin`='$zin', 
                `title`='$title', 
                `content`='$content', 
                `display`='$display', 
                `memo`='$memo'
                WHERE `id`='$q'";




$result = mysqli_query($conn, $sql);
// $result = $conn->query($sql);


   
    if($result){
        echo("<script>alert('게시물이 수정되었습니다.');location.href='admin_contList.php';</script>");
    }
    else{
        echo '게시물 저장실패. 관리자에게 문의해주세요';
        error_log(mysqli_error($conn));
    }




?>