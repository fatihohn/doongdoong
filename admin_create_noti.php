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
            
                <div class="view_wrap">
    <div class="view_wrap_line">
        <div class="contEditor">
            <center>
                <h3>소개 작성</h3>
            </center>
        
        <?php    
           include 'bbdd_db_conn.php';   

           $sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
           $resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
           $rowStandingZin = $resultStandingZin->fetch_assoc();
        //    $zin_column = $rowStandingZin['zin_column'];
        //    $zin_color = $rowStandingZin['zin_color'];
        //    $title_color = $rowStandingZin['title_color'];
        //    $point_color = $rowStandingZin['point_color'];
        //    $nav_color = $rowStandingZin['nav_color'];

        $sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
        $resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
        $rowZinNow = $resultZinNow->fetch_assoc();
        $zin_column = $rowZinNow['zin_column'];
        $zin_color = $rowZinNow['zin_color'];
        $title_color = $rowZinNow['title_color'];
        $point_color = $rowZinNow['point_color'];
        $nav_color = $rowZinNow['nav_color'];
           

           
           $URL = "./admin_notiList.php";
           

           

           $uname = $_SESSION['username'];
           $query = "SELECT * FROM user_data WHERE username= '$uname'";
           $result = $conn->query($query);
           $rows = mysqli_fetch_assoc($result);
           
           $username = $rows['username'];
           
           $author = $rows['author'];
           
           
           $adminCast = "admin";
           $editorCast = "editor";
           $authorCast = "author";
           
        //    if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast){
         
           
        
                session_start();
 
 
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor||author인 경우
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <form class="createForm" action="admin_create_noti_action.php" method="POST" enctype="multipart/form-data">
            <!-- <p >
                <div class="createInput">
                    <label class="createGrid1">작성자: </label><?=$author?>
                    <input class="createGrid2" type="hidden" name="author" value="<?=$author?>" required />
                    
                </div>
                
            </p> -->
            <p >
                <div class="createInput">
                    <label class="createGrid1">작성자: </label>
                    
                    <?php
                        if($_SESSION['cast']==$adminCast ) {
                            $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal' AND `cast` != 'author'";
                            $resultAuthor = $conn->query($authorSql);
                            echo "
                            <select id='contAuthor' name='author' required>
                            
                            ";
                            
                            
                            
                        if ($resultAuthor->num_rows > 0) {
                            while($rowAuthor = $resultAuthor->fetch_assoc()){
                                echo "<option class='contAuth_slct' value='";
                                echo $rowAuthor['author'];
                                echo "'>";
                                echo $rowAuthor['author'];
                                echo "</option>";

                            }
                        }

                        echo "
                        </select>
                        ";
                        
                        } else if($_SESSION['cast']==$editorCast) {
                            $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal' AND `cast` != 'author'AND `cast` != 'admin'";
                            $resultAuthor = $conn->query($authorSql);
                            echo "
                            <select id='contAuthor' name='author' required>
                            
                            ";
                            
                            
                            
                        if ($resultAuthor->num_rows > 0) {
                            while($rowAuthor = $resultAuthor->fetch_assoc()){
                                echo "<option class='contAuth_slct' value='";
                                echo $rowAuthor['author'];
                                echo "'>";
                                echo $rowAuthor['author'];
                                echo "</option>";

                            }
                        }

                        echo "
                        </select>
                        ";
                        
                        }

                    ?>
                    <script>
                       //게시물 작가설정
        function contAuthorSet() {
        let contAuthor = document.querySelectorAll(".contAuth_slct");
        let contAuthorVal = "<?=$author?>";
        let i;
        for(i=0; i < contAuthor.length; i++) {
            if(contAuthor[i].value == contAuthorVal) {
                contAuthor[i].selected = true;
            }
        }
    }
    contAuthorSet();
                    </script>
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
                <label class="createGrid1">구분</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                        <!-- <input class='category_btn' type='radio' id='notice_btn' name='category' value='notice' >
                        <label for='notice_btn'>공지</label><br> -->
                        <input class='category_btn' type='radio' id='intro_btn' name='category' value='intro' checked>
                        <label for='intro_btn'>웹진 소개</label><br>
                      
                    
                </div>
                
                </div>
            </p>
    
            
            <p>
                <div class="createInput">
                <label class="createGrid1">제목</label>
                <input class="createGrid2" name="title" placeholder="제목" required />
                
            </div>
            </p>
       
            

            <p>
                <div class="createInput">
                <label class="createGrid1">내용</label>
                <!-- <textarea class="createGrid2" name="content" placeholder="내용" rows="10" cols="20" required></textarea> -->
                <div class="admin_editor">

                    <textarea name="ir1" id="ir1" ></textarea>
                </div>
                <!-- <textarea name="ir1" id="ir1" rows="10" cols="100"></textarea> -->
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">공개 상태</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                        <input class='display_btn' type='radio' id='on_btn'name='display' value='on'>
                        <label for='on_btn'>외부공개</label><br>
                        <input class='display_btn' type='radio' id='ok_btn'name='display' value='ok' checked>
                        <label for='ok_btn'>내부공개</label><br>
                        <input class='display_btn' type='radio' id='off_btn'name='display' value='off'>
                        <label for='off_btn'>비공개</label><br>
                    
                </div>
                
                </div>
            </p>
                      

  



            <p>
                <input type="submit" onclick="submitContents(this);">
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
<!-- <script type="text/javascript" src="se2/js/service/HuskyEZCreator.js" charset="utf-8"></script> -->
<script type="text/javascript">
var aAdditionalFontSet = [["경기천년바탕", "경기천년바탕"], ["경기천년제목", "경기천년제목"]];


    let oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1",
    //  sSkinURI: "se2/SmartEditor2Skin.html",
     sSkinURI: "SmartEditor2Skin_noti.html",
     htParams: {
        SE2M_FontName: {
            // htMainFont: {'id': '경기천년바탕','name': '경기천년바탕','size': '1.05rem','url': '','cssUrl': ''} // 기본 글꼴 설정
			htMainFont: {'id': '경기천년바탕','name': '경기천년바탕','size': '12','url': '','cssUrl': ''} // 기본 글꼴 설정
		},
     },
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
     oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script>
<script>
    admin_frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
</script>
</body>

</html>