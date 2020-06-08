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
                
                // $id = $_POST['username'];
                $q = intval($_GET['id']);
                $query = "SELECT * FROM zin WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                $author = $rows['author'];
                $username = $rows['username'];
                $title = $rows['title'];
                $zin_detail = $rows['zin_detail'];
                $display = $rows['display'];
                $publish = $rows['publish'];

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
        <center>
            <h3>매거진 수정</h3>
        </center>
        <form class="createForm" action="admin_modify_zin_action.php" method="POST" enctype="multipart/form-data">
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
                <input class="createGrid2" id="zin_title" name="title" value="<?=$title?>" required />
                <div class="createGrid3" id="zinTitleConf"></div>  
                <div>
                <p>
                * 따옴표('), 큰따옴표(")는 사용할 수 없습니다.
                ** 7글자 이내.
                </p>
                </div>   
            </div>
            </p>
       
            

            <p>
                <div class="createInput">
                <label class="createGrid1">매거진 설명</label>
                <textarea class="createGrid2" name="zin_detail" value="<?=$zin_detail?>" rows="10" cols="20" ><?=$zin_detail?></textarea>
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
                <label class="createGrid1">현재 발행중</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                    <input class="publish_btn" type="radio" id="now_btn"name="publish" value="now">
                    <label for="now_btn">예</label><br>
                    <input class="publish_btn" type="radio" id="ready_btn"name="publish" value="ready">
                    <label for="ready_btn">아니오</label><br>
                
                    
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



                    </script>
<?php include "admin_jsGroup.php";?>

</div>

</body>

</html>