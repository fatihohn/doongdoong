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
            <h3>연재물 만들기</h3>
        </center>
        <?php    
           include 'bbdd_db_conn.php';   
                
                $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal'";
                $resultAuthor = $conn->query($authorSql);
                
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
 
 
                $URL = "./admin_thumbsList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin인 경우
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <form class="createForm" action="admin_create_thumbs_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">에디터 아이디: </label><?=$username?>
                    <input class="createGrid2"  type="hidden" name="username" value="<?=$username?>" required />
                    
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">연재 작가</label>
                    <!-- select로 구성 -->
                    <!-- <input class="createGrid2" type="" name="author" value="<?=$author?>" required /> -->
                    <select id="authorCat" name="author" required>
                    <option></option>
                    <?php
                        if ($resultAuthor->num_rows > 0) {
                            while($rowAuthor = $resultAuthor->fetch_assoc()){
                                echo "<option value='";
                                echo $rowAuthor['author'];
                                echo "'>";
                                echo $rowAuthor['author'];
                                echo "</option>";

                            }
                        }

                    ?>

                    </select>
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">연재물 제목</label>
                <input class="createGrid2" id="category" name="category" placeholder="연재물 제목" required />
                <div class="createGrid3" id="catConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">연재물 대표 이미지</label>
                <input class="createGrid2" type="file" name="img"  required />
                
            </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">연재물 설명</label>
                <textarea class="createGrid2" name="cat_detail" placeholder="연재물 설명" rows="10" cols="20" required></textarea>
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
                <label class="createGrid1">연재 상태</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                    <input class="publish_btn" type="radio" id="now_btn"name="publish" value="now" checked>
                    <label for="now_btn">발행중</label><br>
                    <input class="publish_btn" type="radio" id="past_btn"name="publish" value="past">
                    <label for="past_btn">완결</label><br>
                
                    
                </div>
                
                </div>
            </p>

  



            <p>
                <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
            </p>
        </form>
                <?php
                 } 
                 
                 else {
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
</body>

</html>