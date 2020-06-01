<?php    
           include 'bbdd_db_conn.php';   
                
                // $id = $_POST['username'];
                $q = intval($_GET['id']);
                $query0 = "SELECT * FROM user_data WHERE id= $q";
                // $query0 = "SELECT id, username, created, title, img0, img0_dir, addressinfo, contact, img1, img1_dir, autoparking, img2, img2_dir, publictrans, extmaplink FROM visit WHERE id= $q";
                $result0 = $conn->query($query0);
                $rows = mysqli_fetch_assoc($result0);

                $query1 = "DELETE FROM user_data WHERE id= $q";
                $username = $rows['username'];
                $editor = "editor";
                $admin = "admin";

                session_start();
                
 
                $URL = "./admin_userList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다. 로그인하세요.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                else if($_SESSION['cast']==$admin || $_SESSION['username']==$username) {
        
                $result = $conn->query($query1);
                echo "삭제되었습니다"
               ?> <script>
                                
                                location.replace("<?php echo $URL?>");
                        </script>
                        <?php
           } else {
                ?>

                <script>
                                alert("권한이 없습니다.");
                                // location.replace("<?php echo $URL?>");
                                history.back();
                        </script>
                        
                <?php
                }
                
        ?>

