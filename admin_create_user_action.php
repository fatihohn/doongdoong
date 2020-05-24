<?php

include 'bbdd_db_conn.php';

function getSalt() {
    $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    // $charset = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789/\][{};:?.>,<!@#$%^&*()-_=+|';
    $randStringLen = 64;

    $randString = "";
    for ($i = 0; $i < $randStringLen; $i++) {
        $randString .= $charset[mt_rand(0, strlen($charset) - 1)];
    }

    return $randString;
}

$realname = $_POST['realname'];
$username = $_POST['username'];
$password=$_POST['password'];
$salt = getSalt();
$pwSalt = $password.$salt;
$password = base64_encode(hash('sha512', $pwSalt, true));
$email = $_POST['email'];
$author = $_POST['author'];
$author = mysqli_real_escape_string($conn, $author);
// $author = mysql_real_escape_string($author);

$auth_detail = $_POST['auth_detail'];
$auth_detail = mysqli_real_escape_string($conn, $auth_detail);
// $auth_detail = mysql_real_escape_string($auth_detail);
$cast = $_POST['cast'];
$active = $_POST['active'];
$pw_one = $_POST['password'];
$pw_two = $_POST['password_conf'];


$nameSql = "SELECT * FROM user_data WHERE username='$username'";
$nameCheck = mysqli_query($conn, $nameSql);
    $nameCheck = $nameCheck->fetch_array();
    if($nameCheck >= 1){
		echo "<script>alert('아이디가 중복됩니다.'); history.back();</script>";
	}else{

        $authNameSql = "SELECT * FROM user_data WHERE author='$author'";
        $authNameCheck = mysqli_query($conn, $authNameSql);
            $authNameCheck = $authNameCheck->fetch_array();
        if($authNameCheck >= 1) {
            echo "<script>alert('필명이 중복됩니다.'); history.back();</script>";
        } else {
            if($pw_one !== $pw_two) {
                echo "<script>alert('비밀번호가 일치하지 않습니다.'); history.back();</script>";

            } else {
        $sql = "
            INSERT INTO user_data
                (realname, username, password, salt, email, author, auth_detail, cast, active, created)
            VALUES(
                '{$realname}',
                '{$username}',
                '{$password}',
                '{$salt}',
                '{$email}',
                '{$author}',
                '{$auth_detail}',
                '{$cast}',
                '{$active}',
                NOW()
        )";
            }
            }
    }
    // $sql = "
    //     INSERT INTO user_data
    //         (username, password, salt, email, created)
    //     VALUES(
    //         '{$username}',
    //         '{$password}',
    //         '{$salt}',
    //         '{$email}',
    //         NOW()
    // )";
$result = mysqli_query($conn, $sql);
if($result === false){
    echo '저장실패. 관리자에게 문의해주세요';
    error_log(mysqli_error($conn));
}
else{
    echo("<script>alert('회원가입이 완료되었습니다.');location.href='admin_index.php';</script>");
}
echo $sql;


?>