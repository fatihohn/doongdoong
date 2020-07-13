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



                // $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal'";
                // $resultAuthor = $conn->query($authorSql);

                $q = intval($_GET['id']);
                $query = "SELECT * FROM notice WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                $author = $rows['author'];
                $username = $rows['username'];
                $category = $rows['category'];
                $title = $rows['title'];
                $content = $rows['content'];
                $display = $rows['display'];

                $adminCast = "admin";
                $editorCast = "editor";
                $authorCast = "author";


                // if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast){
                //     $authCatSql = "SELECT * FROM thumbs";
                //     $resultAuthCat = $conn->query($authCatSql);    
                //      } else if ($_SESSION['cast']==$authorCast) {
                //      $authCatSql = "SELECT * FROM thumbs WHERE `author` = '$author'";
                //      $resultAuthCat = $conn->query($authCatSql);    
                     
                //     } else {
                     ?>              
                     <!-- <script>
                     alert("권한이 없습니다.");
                     location.replace("<?php echo $URL?>");
             </script> -->
         <?php   
        //  }

// $zinSql = "SELECT * FROM zin WHERE `display` = 'on' OR `display`='ok'";
//            $resultZin = $conn->query($zinSql);     



                session_start();
 
 
                $URL = "./admin_notiList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor인 경우 || 작가 본인
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast || $_SESSION['username']==$username) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <center>
            <h3>공지 수정</h3>
        </center>
        <form class="createForm" action="admin_modify_noti_action.php" method="POST" enctype="multipart/form-data">
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
                <label class="createGrid1">구분</label>
                <!-- <textarea class="createGrid2" name="display" placeholder="작가소개" rows="10" cols="20"required></textarea> -->
                <div class="createGrid2">

                        <input class='category_btn' type='radio' id='notice_btn' name='category' value='notice'>
                        <label for='notice_btn'>공지</label><br>
                        <input class='category_btn' type='radio' id='intro_btn' name='category' value='intro'>
                        <label for='intro_btn'>웹진 소개</label><br>
                      
                    
                </div>
                
                </div>
            </p>

            

            <p>
                <div class="createInput">
                <label class="createGrid1">제목</label>
                <input class="createGrid2" name="title" value="<?=$title?>"  required/>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">내용</label>
                <div class="admin_editor">

                    <textarea name="ir1" id="ir1"><?=$content?></textarea>
                </div>
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
                <input type="hidden" name="id" value="<?=$q?>">
                <input type="submit" onclick="submitContents(this);">
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
    
    <?php include "admin_jsGroup.php";?>

    <script type="text/javascript">
var aAdditionalFontSet = [["경기천년바탕", "경기천년바탕"], ["경기천년제목", "경기천년제목"]];


    let oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1",
    //  sSkinURI: "se2/SmartEditor2Skin.html",
     sSkinURI: "SmartEditor2Skin_noti_modify.html",
     htParams: {
        SE2M_FontName: {
			htMainFont: {'id': '경기천년바탕','name': '경기천년바탕','size': '1.05rem','url': '','cssUrl': ''} // 기본 글꼴 설정
		},
     },
     fCreator: "createSEditor2"
    });

    // ‘저장’ 버튼을 누르는 등 저장을 위한 액션을 했을 때 submitContents가 호출된다고 가정한다.
    function submitContents(elClickedObj) {
     // 에디터의 내용이 textarea에 적용된다.
    //  oEditors.getById["ir1"].exec("LOAD_CONTENTS_FIELD", []);
     oEditors.getById["ir1"].exec("UPDATE_CONTENTS_FIELD", []);

     // 에디터의 내용에 대한 값 검증은 이곳에서
     // document.getElementById("ir1").value를 이용해서 처리한다.

     try {
         elClickedObj.form.submit();
     } catch(e) {}
    }

</script>
    <script>
        //공개설정
        function displaySet() {
        let display = document.querySelectorAll(".display_btn");
        let displayVal = "<?=$display?>";
        let a;
        for(a=0; a < display.length; a++) {
            if(display[a].value == displayVal) {
                display[a].checked = true;
            }
        }
    }
    displaySet();


    //구분 설정
    function notiCatSet() {
        let notiCat = document.querySelectorAll(".category_btn");
        let notiCatVal = "<?=$category?>";
        let g;
        for(g=0; g < notiCat.length; g++) {
            if(notiCat[g].value == notiCatVal) {
                notiCat[g].checked = true;
            }
        }
    }
    notiCatSet();


                    </script>
<script>
    admin_frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
</script>

</div>

</body>

</html>