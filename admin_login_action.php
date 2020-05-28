<?php
 
        session_start();
        include 'bbdd_db_conn.php';
        
        //입력 받은 id와 password
        // $username=$_POST['username'];
        
        // $querySalt = "SELECT salt FROM user_data WHERE username='$username'";
        // $resultSalt = $conn->query($querySalt);
        // $salt = mysqli_fetch_assoc($resultSalt)['salt'];
        
        
        $querySalt = "SELECT salt FROM user_data WHERE username=?";
        
        if ($stmt = $conn->prepare($querySalt)) {
                $username=$_POST['username'];
                $stmt->bind_param("s", $username);
                $stmt->execute();
                if (!$stmt->errno) {
                        echo mysqli_error($conn);
                        echo "stmt error";
                }

                $stmt->bind_result($resultSalt);

                $stmt->fetch();
                $rowSalt[] = $resultSalt;
                $salt = $rowSalt['salt'];
                $stmt->close();
                // $conn->close();

        }



        // $resultSalt = $conn->query($querySalt);
        // $salt = mysqli_fetch_assoc($resultSalt)['salt'];





        // $querySalt = "SELECT salt FROM user_data WHERE username = ?";
        // // $resultSalt = $conn->query($querySalt);
        
        // $stmt = $mysqli->prepare($querySalt);
        // $stmt->bind_param("s", $username);
        // // $stmt = $mysqli->prepare("SELECT salt FROM user_data WHERE username = ?");
        // // $stmt->bind_param("s", $_POST['username']);
        // $stmt->execute();
        // $resultSalt = $stmt->get_result();
        // $rowsalt = $resultSalt->fetch_assoc();
        // $salt = $rowSalt['salt'];
        // // $salt = mysqli_fetch_assoc($resultSalt)['salt'];
        // // if($resultSalt->num_rows === 0) exit('No rows');
        // // while($rowSalt = $resultSalt->fetch_assoc()) {
        // // $salt[] = $rowSalt['salt'];
        // // }
        // var_export($salt);
        // $stmt->close();


        $password=$_POST['password'];
        
        $pwSalt = $password.$salt;
        $password = base64_encode(hash('sha512', $pwSalt, true));
 
        //아이디가 있는지 검사
        $query = "SELECT * FROM user_data WHERE username='$username'";
        $result = $conn->query($query);
        // $rowUser = $result->fetch_assoc();
        // $author = $rowUser['author'];
 
 
        //아이디가 있다면 비밀번호 검사
        if(mysqli_num_rows($result)==1) {
 
                $row=mysqli_fetch_assoc($result);
                $cast = $row['cast'];
                $author = $row['author'];
                //비밀번호가 맞다면 세션 생성
                if($row['password']==$password){
                        $_SESSION['username']=$username;
                        $_SESSION['cast']=$cast;
                        $_SESSION['author']=$author;
                        if(isset($_SESSION['username'])){
?>      
<script>
                        alert("<?=$username;" ";$cast;?>님 로그인 되었습니다.");
                        location.replace("./admin_index.php");
</script>
<?php
                        }
                        else{
                                echo "session fail";
                        }
                }
 
                else {
?>             
<script>
                        alert("비밀번호가 잘못되었습니다.");
                        history.back();
</script>
<?php
                }
 
        }
 
                else{
?>              
<script>
                        alert("아이디가 잘못되었습니다.");
                        history.back();
</script>
<?php
                    }
 
 
?>
