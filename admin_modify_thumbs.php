<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>



    <div id="bbdd_body">
        <header id="bbdd_hd">
           <?php include "admin_header.php"; ?>
        </header>


    <section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <!-- <div class="sc_contain">
                <div class="sc_list_area"> -->
                <div class="view_wrap">
    <div class="view_wrap_line">
        <div class="contEditor">
<?php    
           include 'bbdd_db_conn.php';   

           $sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
           $resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
           $rowStandingZin = $resultStandingZin->fetch_assoc();
           $zin_column = $rowStandingZin['zin_column'];
           $zin_color = $rowStandingZin['zin_color'];
           $title_color = $rowStandingZin['title_color'];
           $point_color = $rowStandingZin['point_color'];
           $nav_color = $rowStandingZin['nav_color'];

           

                $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal'";
                $resultAuthor = $conn->query($authorSql);

                $q = intval($_GET['id']);
                $query = "SELECT * FROM thumbs WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                $author = $rows['author'];
                $username = $rows['username'];
                $category = $rows['category'];
                $cat_detail = $rows['cat_detail'];
                $img = $rows['img'];
                $img_dir = $rows['img_dir'];
                $display = $rows['display'];
                $publish = $rows['publish'];

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
                //cast: admin||editor인 경우
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <center>
            <h3>연재물 수정</h3>
        </center>
        <form class="createForm" action="admin_modify_thumbs_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">에디터 아이디: </label><?=$_SESSION['username']?>
                    <input class="createGrid2"  type="hidden" name="username" value="<?=$_SESSION['username']?>" required />
                    
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">연재 작가</label>
                    <!-- <input class="createGrid2" type="hidden" name="author" value="<?=$author?>" required /> -->
                    <select id="authorCat" name="author" required>
                    
                    <?php
                        if ($resultAuthor->num_rows > 0) {
                            while($rowAuthor = $resultAuthor->fetch_assoc()){
                                echo "<option class='author_slct' value='";
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
                <input class="createGrid2" id="category" name="category" value="<?=$category?>" required />
                <div class="createGrid3" id="catConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">연재물 대표 이미지(최대 10MB)</label>
                <input class="createGrid2" type="file" name="img"  /> <?=$img?>
                
            </div>
            </p>
            

            <p>
                <div class="createInput">
                <label class="createGrid1">연재물 설명</label>
                <textarea class="createGrid2" name="cat_detail" value="<?=$cat_detail?>" rows="10" cols="20" ><?=$cat_detail?></textarea>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">공개 상태</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                    <input class="display_btn" type="radio" id="on_btn"name="display" value="on">
                    <label for="on_btn">외부공개</label><br>
                    <input class="display_btn" type="radio" id="ok_btn"name="display" value="ok">
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

                    <input class="publish_btn" type="radio" id="now_btn"name="publish" value="now">
                    <label for="now_btn">발행중</label><br>
                    <input class="publish_btn" type="radio" id="ready_btn"name="publish" value="ready">
                    <label for="ready_btn">완결</label><br>
                
                    
                </div>
                
                </div>
            </p>

  



            <p>
                <input type="hidden" name="id" value="<?=$q?>">
                <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
            </p>
        </form>
        
        



        <?php   } else {
                ?>

                <script>
                                alert("권한이 없습니다.");
                                // location.replace("<?php echo $URL?>");
                                history.back();
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

    <script>
        function displaySet() {
        let display = document.querySelectorAll(".display_btn");
        let displayVal = "<?=$display?>";
        let i;
        for(i=0; i < display.length; i++) {
            if(display[i].value == displayVal) {
                display[i].checked = true;
            }
        }
    }
    displaySet();

        function publishSet() {
        let publish = document.querySelectorAll(".publish_btn");
        let publishVal = "<?=$publish?>";
        let i;
        for(i=0; i < publish.length; i++) {
            if(publish[i].value == publishVal) {
                publish[i].checked = true;
            }
        }
    }
    publishSet();
        function authorSet() {
        let author = document.querySelectorAll(".author_slct");
        let authorVal = "<?=$author?>";
        let i;
        for(i=0; i < author.length; i++) {
            if(author[i].value == authorVal) {
                author[i].selected = true;
            }
        }
    }
    authorSet();



                    </script>
<?php include "admin_jsGroup.php";?>
<script>
    admin_frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
</script>
</div>

</body>

</html>