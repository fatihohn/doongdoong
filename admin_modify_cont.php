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
                $query = "SELECT * FROM contents WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                $author = $rows['author'];
                $username = $rows['username'];
                $category = $rows['category'];
                $sess = $rows['sess'];
                $zin = $rows['zin'];
                $title = $rows['title'];
                $content = $rows['content'];
                $display = $rows['display'];
                $memo = $rows['memo'];

                $adminCast = "admin";
                $editorCast = "editor";
                $authorCast = "author";


                if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast){
                    $authCatSql = "SELECT * FROM thumbs";
                    $resultAuthCat = $conn->query($authCatSql);    
                     } else if ($_SESSION['cast']==$authorCast) {
                     $authCatSql = "SELECT * FROM thumbs WHERE `author` = '$author'";
                     $resultAuthCat = $conn->query($authCatSql);    
                     
                    } else {
                     ?>              <script>
                     alert("권한이 없습니다.");
                     location.replace("<?php echo $URL?>");
             </script>
         <?php   }

$zinSql = "SELECT * FROM zin WHERE `display` = 'on' OR `display`='ok'";
           $resultZin = $conn->query($zinSql);     



                session_start();
 
 
                $URL = "./admin_contList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor인 경우 || 작가 본인
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast || $_SESSION['author']==$author || $_SESSION['username']==$username) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <center>
            <h3>게시물 수정</h3>
        </center>
        <form class="createForm" action="admin_modify_cont_action.php" method="POST" enctype="multipart/form-data">
        <p >
                <div class="createInput">
                    <label class="createGrid1">작성자: </label>
                    
                    <?php
                    if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
                        // echo "
                        // <select name='author' id='contAuthor'>
                        // <option value='";
                        // echo $author;
                        // echo "'>";
                        // echo $author;
                        // echo "</option>
                        // <option value='";
                        // echo $_SESSION['author'];
                        // echo "'>";
                        // echo $_SESSION['author'];
                        // echo "</option>
                        // </select>
                        
                        // ";
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
                    } else {
                        echo "
                        <input class='createGrid2' type='hidden' name='author' value='";
                        echo $author;
                        echo "' required />
                        ";
                        echo $author;
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
            <p >
                <div class="createInput">
                    <label class="createGrid1">연재물: </label><?=$category?>
                    <input class="createGrid2"  type="hidden" name="category" value="<?=$category?>" required />
                    
                </div>
                
            
                </p>
            <p>
                <div class="createInput" >
                    <!-- 회차 -->
                    <label class='createGrid1'>회차</label>
                    <select class="createGrid2" name="sess" id="sessCat" required>

                    <?php
                    // $sessOnSql = "SELECT * FROM contents WHERE `category` = '$category' AND `display`='on' ORDER BY sess*1 DESC LIMIT 1 ";
                    $sessOnSql = "SELECT * FROM contents WHERE `category` = ? AND `display`='on' ORDER BY sess*1 DESC LIMIT 1 ";

                    $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sessOnSql)) {
                                // echo "sessOnSql error";
                        } else {
                                mysqli_stmt_bind_param($stmt, "s", $category);
                                mysqli_stmt_execute($stmt);
                                $resultSessOn = mysqli_stmt_get_result($stmt);
                        }

                    // $resultSessOn = $conn->query($sessOnSql);    
                    $rowSessOn = $resultSessOn->fetch_assoc();
                    $sessOnLatest = intval($rowSessOn['sess']);
                
                
                    // $sessSql = "SELECT * FROM contents WHERE `category` = '$category' AND `display`='on' OR `display`='ok' ORDER BY sess*1 DESC LIMIT 1 ";
                    $sessSql = "SELECT * FROM contents WHERE `category` = ? AND `display`='on' OR `display`='ok' ORDER BY sess*1 DESC LIMIT 1 ";
                    
                    $stmt = mysqli_stmt_init($conn);
                        if (!mysqli_stmt_prepare($stmt, $sessSql)) {
                                // echo "sessSql error";
                        } else {
                                mysqli_stmt_bind_param($stmt, "s", $category);
                                mysqli_stmt_execute($stmt);
                                $resultSess = mysqli_stmt_get_result($stmt);
                        }
                    
                    // $resultSess = $conn->query($sessSql);    
                    $rowSess = $resultSess->fetch_assoc();
                    $sessAll = intval($rowSess['sess']);
                    $sessOkLatest = intval($rowSess['sess']);

                    if($sess-1 < 0) {
                        echo "
                        <option class='sess_slct' value='1'>1회</option>
                        <option class='sess_slct' value='2'>2회</option>
                        <option class='sess_slct' value='3'>3회</option>
                        <option class='sess_slct' value='4'>4회</option>
                        <option class='sess_slct' value='5'>5회</option>
                        <option class='sess_slct' value='6'>6회</option>
                        <option class='sess_slct' value='7'>7회</option>
                        <option class='sess_slct' value='8'>8회</option>
                        <option class='sess_slct' value='9'>9회</option>
                        <option class='sess_slct' value='10'>10회</option>
                        ";
                        
                    } else {
                        
                        $sessNum = 1;
                        while($sessAll+10 >= 0) {
                            echo "<option class='sess_slct' value='";
                            echo $sessNum;
                            echo "'";
                
                            // if($sessNum == $SessFrId) {
                            //     echo "selected";
                            // }
                
                            echo ">";
                            echo $sessNum;
                            echo "회</option>";
                            $sessAll = $sessAll-1;
                            $sessNum++;
                            
                        }
                        
                        
                    }		
                    echo "</select>";
                    echo " 최신 발행 회차 ";
                    echo $sessOnLatest;
                    echo "회 | ";
                    echo " 최신 내부공개 회차 ";
                    echo $sessOkLatest;
                    echo "회";
                    ?>


                <!-- <div id="authCatRem" ></div>   -->
            </div>
            </p>
            <p>
            <div class="createInput">
                <label class="createGrid1">매거진</label>
                <select name="zin" id="authZin">
                    
                    <!-- <input class="createGrid2" name="zin" placeholder="매거진" required /> -->
                    
                    <option></option>
                    <?php
                        if ($resultZin->num_rows > 0) {
                            while($rowZin = $resultZin->fetch_assoc()){
                                $zinPublishState = $rowZin['publish'];
                                if($zinPublishState == 'now') {
                                    $zinPublishState = "기획발행";
                                } else if($zinPublishState == 'standing') {
                                    $zinPublishState = "상시발행";
                                }

                                echo "<option class='zin_slct' value='";
                                echo $rowZin['title'];
                                echo "'>[";
                                // echo $rowZin['publish'];
                                echo $zinPublishState;
                                echo "] ";
                                echo $rowZin['title'];
                                echo "</option>";
                                
                            }
                        }
                        
                        ?>

                </select>

                
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
                <div class="createInput">
                <label class="createGrid1">메모</label><br>
                <textarea class="createGrid2" name="memo" value="<?=$memo?>" rows="10" cols="20" style="width: 100%;"><?=$memo?></textarea>
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
    //  sSkinURI: "SmartEditor2Skin.html",
     sSkinURI: "SmartEditor2Skin_modify.html",
     htParams: {
        SE2M_FontName: {
			htMainFont: {'id': '경기천년바탕','name': '경기천년바탕','size': '12','url': '','cssUrl': ''} // 기본 글꼴 설정
        },
        aAdditionalFontList: aAdditionalFontSet
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
        let i;
        for(i=0; i < display.length; i++) {
            if(display[i].value == displayVal) {
                display[i].checked = true;
            }
        }
    }
    displaySet();

        //발행설정
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

        //작가설정
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

        //연재물 설정
        function categorySet() {
        let category = document.querySelectorAll(".authCat_slct");
        let categoryVal = "<?=$category?>";
        let i;
        for(i=0; i < category.length; i++) {
            if(category[i].value == categoryVal) {
                category[i].selected = true;
            }
        }
    }
    categorySet();

        //회차 설정
        function sessSet() {
        let sess = document.querySelectorAll(".sess_slct");
        let sessVal = "<?=$sess?>";
        let i;
        for(i=0; i < sess.length; i++) {
            if(sess[i].value == sessVal) {
                sess[i].selected = true;
            }
        }
    }
    sessSet();

        //매거진 설정
        function zinSet() {
        let zin = document.querySelectorAll(".zin_slct");
        let zinVal = "<?=$zin?>";
        let i;
        for(i=0; i < zin.length; i++) {
            if(zin[i].value == zinVal) {
                zin[i].selected = true;
            }
        }
    }
    zinSet();



                    </script>

<script>  
    admin_frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
</script>

</div>

</body>

</html>