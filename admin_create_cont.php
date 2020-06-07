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
                <h3>게시물 작성</h3>
            </center>
        
        <?php    
           include 'bbdd_db_conn.php';   

           
           $URL = "./admin_contList.php";


           


           $uname = $_SESSION['username'];
           $query = "SELECT * FROM user_data WHERE username= '$uname'";
           $result = $conn->query($query);
           $rows = mysqli_fetch_assoc($result);
           
           $username = $rows['username'];
           
           $author = $rows['author'];
           
           
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
 
 
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin||editor||author인 경우
                else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast || $_SESSION['cast']==$authorCast) {
                // else if($_SESSION['username']==$username || $_SESSION['cast']==$admin) {
        ?>
        <form class="createForm" action="admin_create_cont_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">작성자: </label>
                    
                    <?php
                        if($_SESSION['cast']==$adminCast) {
                            
                            $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal' ";
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
                            $authorSql = "SELECT * FROM user_data WHERE `cast` != 'normal' AND `cast` != 'admin'";
                           
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

            <p>
                <div class="createInput">
                <label class="createGrid1">연재물</label>
                <select name="category" id="authCat" required>

                    <!-- <input class="createGrid2" name="category" placeholder="연재물" required /> -->
                    <option></option>
                    <?php
                        if ($resultAuthCat->num_rows > 0) {
                            while($rowAuthCat = $resultAuthCat->fetch_assoc()){
                                echo "<option value=";
                                echo '"'.$rowAuthCat['category'].'"';
                                echo ">[";
                                echo $rowAuthCat['author'];
                                echo "] ";
                                echo $rowAuthCat['category'];
                                echo "</option>";
                                
                            }
                        }
                        
                        ?>
                
            </select>
            
        </div>
    </p>
    <p>
        <div class="createInput">
            <!-- <label class="createGrid1">
                
            회차
        </label> -->
        <div id="authCatConf"></div>
             <!-- <script>
                 let authCatTitle = document.getElementById("authCatConf").innerHTML;
             </script> -->
                <!-- <select class="createGrid2" name="sess" id="sessCat" required>
                    </select> -->

                    <!-- <input class="createGrid2" name="sess" placeholder="회차" required /> -->
                    
                    <!-- <option></option> -->
                    
                        

                        
                        <!-- // $sessSql = "SELECT * FROM contents WHERE `category` = '' AND `display`='on' OR `display`='ok'";
                        // $resultSess = $conn->query($sessSql);    
                        // if ($resultAuthCat->num_rows > 0) {
                        //     while($rowAuthCat = $resultAuthCat->fetch_assoc()){
                        //         echo "<option value='";
                        //         echo $rowAuthCat['category'];
                        //         echo "'>";
                        //         echo $rowAuthCat['category'];
                        //         echo "</option>";
                                
                        //     }
                        // } -->
                        
                        
                
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
                                echo "<option value=";
                                echo '"'.$rowZin['title'].'"';
                                echo ">[";
                                echo $rowZin['publish'];
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

                    <?php
                        if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {

                            echo "
                        <input class='display_btn' type='radio' id='on_btn'name='display' value='on'>
                        <label for='on_btn'>외부공개</label><br>
                        <input class='display_btn' type='radio' id='ok_btn'name='display' value='ok' checked>
                        <label for='ok_btn'>내부공개</label><br>
                        <input class='display_btn' type='radio' id='off_btn'name='display' value='off'>
                        <label for='off_btn'>비공개</label><br>";
                        } else if($_SESSION['cast']==$authorCast) {
                            echo "
                        
                        <input class='display_btn' type='radio' id='ok_btn'name='display' value='ok' checked>
                        <label for='ok_btn'>내부공개</label><br>
                        <input class='display_btn' type='radio' id='off_btn'name='display' value='off'>
                        <label for='off_btn'>비공개</label><br>";
                        }




                    ?>
                    
                </div>
                
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">메모</label><br>
                <textarea class="createGrid2" name="memo" placeholder="메모" rows="10" cols="20" ></textarea>
                </div>
            </p>
            

  



            <p>
                <input type="submit" onclick="submitContents(this);">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>
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
    let oEditors = [];
    nhn.husky.EZCreator.createInIFrame({
     oAppRef: oEditors,
     elPlaceHolder: "ir1",
    //  sSkinURI: "se2/SmartEditor2Skin.html",
     sSkinURI: "SmartEditor2Skin.html",
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
</body>

</html>
