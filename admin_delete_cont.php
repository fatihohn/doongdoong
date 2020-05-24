<?php    
           include 'bbdd_db_conn.php';   
                
                // $id = $_POST['username'];
                $q = intval($_GET['id']);
                $query0 = "SELECT * FROM contents WHERE id= $q";
                // $query0 = "SELECT id, username, created, title, img0, img0_dir, addressinfo, contact, img1, img1_dir, autoparking, img2, img2_dir, publictrans, extmaplink FROM visit WHERE id= $q";
                $result0 = $conn->query($query0);
                $rows = mysqli_fetch_assoc($result0);

                $query1 = "DELETE FROM contents WHERE id= $q";
                $username = $rows['username'];
                $editor = "editor";
                $admin = "admin";

                session_start();
                
 
                $URL = "./admin_contList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다. 로그인하세요.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                else if($_SESSION['cast']==$admin || $_SESSION['cast']==$editor || $_SESSION['username']==$username) {
        
                $result = $conn->query($query1);
                //이미지 삭제
                
                // $c_date = explode(" ", $rows['created'])[0];
                // $c_time = explode(" ", $rows['created'])[1];

                // $c_year = explode("-", $c_date)[0];
                // $c_month = explode("-", $c_date)[1];
                // $c_day = explode("-", $c_date)[2];

                // $c_hour = explode(":", $c_time)[0];
                // $c_min = explode(":", $c_time)[1];
                // $c_sec = explode(":", $c_time)[2];

                // $c_arr = array($c_year, $c_month, $c_day, $c_hour, $c_min, $c_sec);
                // $c_dateTime = implode("", $c_arr);    
                // // $imgFiles = preg_grep('~^[$c_dateTime]-.*\.php$~', scandir(admin . "templates/default/"));
                // $imgFiles = glob("se2/upload/$c_dateTime*.{jpg,jpeg,gif,png}", GLOB_BRACE);
                
                // $contNo = $q;
                $contNo = intval($rows['no']);
                $imgFiles = glob("se2/upload/c$contNo*.{jpg,jpeg,gif,png,bmp}", GLOB_BRACE);
                
                if(isset($imgFiles)) {
                        for ($imgNo = 0; $imgNo <= count($imgFiles); $imgNo++ ) {
                                unlink($imgFiles[$imgNo]);
                        }
                }
                echo $c_arr;
                echo $q;
                echo $contNo;
                echo $imgFiles;
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

