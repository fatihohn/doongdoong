<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
    <header>
        <?php include 'admin_header.php'; ?>
</header>
        
 
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <!-- <div class="sc_contain">
                <div class="sc_list_area"> -->
                <div class="view_wrap">
    <div class="view_wrap_line">
        <div class="contEditor">
        <center>
            <h3>매거진 만들기</h3>
        </center>
        <?php    
           include 'bbdd_db_conn.php';   

           $sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
           $resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
           $rowStandingZin = $resultStandingZin->fetch_assoc();
           $standing_zin_column = $rowStandingZin['zin_column'];
           $standing_zin_color = $rowStandingZin['zin_color'];
           $standing_title_color = $rowStandingZin['title_color'];
           $standing_point_color = $rowStandingZin['point_color'];
           $standing_nav_color = $rowStandingZin['nav_color'];



                
                $uname = $_SESSION['username'];
                $query = "SELECT * FROM user_data WHERE username= '$uname'";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
           
                $username = $rows['username'];
             
                $author = $rows['author'];
              

                $adminCast = "admin";
                $editorCast = "editor";
                $authorCast = "author";

                session_start();
 
 
                $URL = "./admin_zinList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor인 경우
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <form class="createForm" action="admin_create_zin_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">작성자: </label><?=$author?>
                    <input class="createGrid2" type="hidden" name="author" value="<?=$author?>" required />
                    
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디: </label><?=$username?>
                    <input class="createGrid2"  type="hidden" name="username" value="<?=$username?>" required />
                    
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 제목</label>
                <input class="createGrid2" id="zin_title" name="title" placeholder="매거진 제목" required />
                <div class="createGrid3" id="zinTitleConf"></div>   
                <div>
                <p>
                * 따옴표('), 큰따옴표(")는 사용할 수 없습니다.<br>
                ** 한글 20글자 이내, 영문 24글자 이내 (띄어쓰기 포함)
                </p>
                </div> 
            </div>
            </p>
       
            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 표지</label>
                <input class="createGrid2" type="file" name="img"  required />
                
            </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 설명</label>
                <textarea class="createGrid2" name="zin_detail" placeholder="매거진 설명" rows="10" cols="20" required></textarea>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 발행일</label>
                <input class="createGrid2" name="date" type="date" value="0000-00-00" required/>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 배경색</label>
                <input class="createGrid2" name="zin_color" type="color" value="#ffffff"/>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 타이틀 폰트 색</label>
                <input class="createGrid2" name="title_color" type="color" value="#ffffff"/>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 포인트 색</label>
                <input class="createGrid2" name="point_color" type="color" value="#ffffff"/>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 메뉴 색</label>
                <input class="createGrid2" name="nav_color" type="color" value="#ffffff"/>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">공개 상태</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                    <input class="display_btn" type="radio" id="on_btn"name="display" value="on">
                    <label for="on_btn">외부공개</label><br>
                    <input class="display_btn" type="radio" id="ok_btn"name="display" value="ok" checked>
                    <label for="ok_btn">내부공개</label><br>
                    <input class="display_btn" type="radio" id="off_btn"name="display" value="off">
                    <label for="off_btn">비공개</label><br>
                    
                </div>
                
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">발행상태</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                    <input class="publish_btn" type="radio" id="standing_btn"name="publish" value="standing">
                    <label for="standing_btn">상시발행</label><br>
                    <input class="publish_btn" type="radio" id="now_btn"name="publish" value="now">
                    <label for="now_btn">기획발행</label><br>
                    <input class="publish_btn" type="radio" id="ready_btn"name="publish" value="ready" checked>
                    <label for="ready_btn">발행 대기</label><br>
                
                    
                </div>
                
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">상시 발행시 매거진 포맷</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                    <input class="zin_column_btn" type="radio" id="two_btn"name="zin_column" value="2">
                    <label for="two_btn">2줄</label><br>
                    <input class="zin_column_btn" type="radio" id="three_btn"name="zin_column" value="3">
                    <label for="three_btn">3줄</label><br>
                    <input class="zin_column_btn" type="radio" id="four_btn"name="zin_column" value="4" checked>
                    <label for="four_btn">4줄</label><br>
                    <input class="zin_column_btn" type="radio" id="five_btn"name="zin_column" value="5.3">
                    <label for="five_btn">5줄</label><br>
                
                    
                </div>
                
                </div>
            </p>

  



            <p>
                <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()"  class="cancel_btn">취소</a></button>
            </p>
        </form>
                <?php
                 } else {
                 ?>
<script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
                        
                <?php
                }
                
        ?>


        </div>
        </div>
        </div>
        </div>
        </div>
    </section>
    <footer>
        <?php include 'admin_footer.php'; ?>

    </footer>
 

<?php include "admin_jsGroup.php";?>
<script>
    admin_frontListColor("<?php echo $standing_zin_color; ?>", "<?php echo $standing_title_color; ?>", "<?php echo $standing_point_color; ?>", "<?php echo $standing_nav_color; ?>"); 
</script>
</body>

</html>


