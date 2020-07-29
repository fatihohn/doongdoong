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
            <center>
                <h3>필진 수정</h3>
            </center>
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


                
                $q = intval($_GET['id']);
                $query = "SELECT * FROM user_data WHERE id= $q";
                $result = $conn->query($query);
                $rows = mysqli_fetch_assoc($result);
                $realname = $rows['realname'];
                $username = $rows['username'];
                $created = $rows['created'];
                $author = $rows['author'];
                $auth_detail = $rows['auth_detail'];
                $cast = $rows['cast'];
                $email = $rows['email'];
                $active = $rows['active'];

                $adminCast = "admin";
                $editorCast = "editor";
                $authorCast = "author";

                session_start();
 
 
                $URL = "./admin_userList.php";
 
                if(!isset($_SESSION['username'])) {
        ?>              <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
        <?php   }
                //cast: admin인 경우
                else if($_SESSION['cast']==$adminCast) {
        ?>
        
        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">이름</label>
                    <input class="createGrid2" id="realname" type="text" name="realname" value="<?=$realname?>"  />
                    
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디</label>
                    <input class="createGrid2" id="username" type="text" name="username" value="<?=$username?>"  />
                    <div class="createGrid3" id="userConf"></div>
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정</label>
                <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호 수정"  />
                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정 확인</label>
                <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 수정 확인"  />
                <div class="createGrid3" id="pwConf"></div>
                <div>
                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
        
                            * 8자 이상 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                            <br>
                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                            <br>
                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                        </p>
        
                    </div> 
                </div>    
            </p>
            

            <p>
                <div class="createInput">
                <label class="createGrid1">이메일</label>
                <textarea class="createGrid2" type="email" name="email" placeholder="이메일" value="<?=$email?>" ><?=$email?></textarea>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">필명</label>
                <input class="createGrid2" id="author" name="author" placeholder="필명" value="<?=$author?>"  />
                <div class="createGrid3" id="authorConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">작가소개</label>
                <textarea class="createGrid2" name="auth_detail" placeholder="작가소개" rows="10" cols="20" value="<?=$auth_detail?>" ><?=$auth_detail?></textarea>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">필진 등급</label>
                
                <div class="createGrid2">

                    <input class="cast_btn" type="radio" id="admin_btn"name="cast" value="admin">
                    <label for="admin_btn">Admin</label><br>
                    <input class="cast_btn" type="radio" id="editor_btn"name="cast" value="editor">
                    <label for="editor_btn">Editor</label><br>
                    <input class="cast_btn" type="radio" id="author_btn"name="cast" value="author">
                    <label for="author_btn">Author</label><br>
                    <input class="cast_btn" type="radio" id="normal_btn"name="cast" value="normal">
                    <label for="normal_btn">Normal</label><br>
                </div>
                    

                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1"></label>
                <input class="createGrid2" type="hidden" name="active" value="<?=$active?>"  />
                </div>    
            </p>



            <p>
            <input type="hidden" name="id" value="<?=$q?>">    
            <input type="submit">
            <button name="cancel"><a href = "javascript:history.back()">취소</a></button>

            </p>
        </form>
        
        
        
        <?php   }
                //cast: author인 경우 본인 정보 수정
                else if($_SESSION['username'] == $username && $_SESSION['cast'] == $authorCast) {
                   
        ?>
        
        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
            <p >
                <div class="createInput">
                    <label class="createGrid1">이름</label>
                    <input class="createGrid2" id="realname" type="hidden" name="realname" value="<?=$realname?>"  />
                    <?=$realname?>
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디</label>
                    <input class="createGrid2" id="username" type="hidden" name="username" value="<?=$username?>"  />
                    <?=$username?>
                    <div class="createGrid3" id="userConf"></div>
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정</label>
                <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호 수정"  />
                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정 확인</label>
                <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 수정 확인"  />
                <div class="createGrid3" id="pwConf"></div>
                <div>
                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
        
                            * 8자 이상 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                            <br>
                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                            <br>
                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                        </p>
        
                    </div> 
                </div>    
            </p>
            

            <p>
                <div class="createInput">
                <label class="createGrid1">이메일</label>
                <textarea class="createGrid2" name="email" placeholder="이메일" value="<?=$email?>" ><?=$email?></textarea>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">필명</label>
                <input class="createGrid2" id="author" name="author" placeholder="필명" value="<?=$author?>"  />
                <div class="createGrid3" id="authorConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">작가소개</label>
                <textarea class="createGrid2" name="auth_detail" placeholder="작가소개" rows="10" cols="20" value="<?=$auth_detail?>" ><?=$auth_detail?></textarea>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">필진 등급</label>
                
                <div class="createGrid2">


                    <input class="cast_btn" type="radio" id="author_btn"name="cast" value="author">
                    <label for="author_btn">Author</label><br>
                </div>
                    

                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1"></label>
                <input class="createGrid2" type="hidden" name="active" value="<?=$active?>"  />
                </div>    
            </p>



            <p>
            <input type="hidden" name="id" value="<?=$q?>">    
            <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>

            </p>
        </form>
        
        
        <?php   }
                //cast: editor인 경우 admin, editor 제외 수정 가능
                else if($_SESSION['cast'] == $editorCast && $_SESSION['username'] !== $username && $cast !== $adminCast) {
                    if($cast == $editorCast) {
                       ?>
                        <script>
                                alert("권한이 없습니다.");
                                location.replace("<?php echo $URL?>");
                        </script>
                        <?php
                    }
        ?>
        
        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
        <p >
                <div class="createInput">
                    <label class="createGrid1">이름</label>
                    <input class="createGrid2" id="realname" type="hidden" name="realname" value="<?=$realname?>"  />
                    <?=$realname?>
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디</label>
                    <input class="createGrid2" id="username" type="hidden" name="username" value="<?=$username?>"  />
                    <?=$username?>
                    <div class="createGrid3" id="userConf"></div>
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">가입일시</label>
                    <input class="createGrid2" id="created" type="hidden" name="created" value="<?=$created?>"  />
                    <?=$created?>
                    <div class="createGrid3" id="userConf"></div>
                </div>
                
            </p>


            <p>
                <div class="createInput">
                <label class="createGrid1">이메일</label><?=$email?>
                <input class="createGrid2" name="email" type="hidden" value="<?=$email?>" />
                </div>
            </p> 
            <p>
                <div class="createInput">
                <label class="createGrid1">필명</label>
                <input class="createGrid2" id="author" name="author" placeholder="필명" value="<?=$author?>"  />
                <div class="createGrid3" id="authorConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">작가소개</label>
                <textarea class="createGrid2" name="auth_detail" placeholder="작가소개" rows="10" cols="20" value="<?=$auth_detail?>" ><?=$auth_detail?></textarea>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">필진 등급</label>
                
                <div class="createGrid2">

                    <input class="cast_btn" type="radio" id="editor_btn"name="cast" value="editor">
                    <label for="editor_btn">Editor</label><br>
                    <input class="cast_btn" type="radio" id="author_btn"name="cast" value="author">
                    <label for="author_btn">Author</label><br>
                    <input class="cast_btn" type="radio" id="normal_btn"name="cast" value="normal">
                    <label for="normal_btn">Normal</label><br>
                </div>
                    

                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1"></label>
                <input class="createGrid2" type="hidden" name="active" value="<?=$active?>"  />
                </div>    
            </p>



            <p>
            <input type="hidden" name="id" value="<?=$q?>">    
            <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>

            </p>
        </form>



        <?php   }
                //cast: editor 본인
                else if($_SESSION['cast'] == $editorCast && $_SESSION['username'] == $username && $cast !== $adminCast) {
        ?>
        
        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
        <p >
                <div class="createInput">
                    <label class="createGrid1">이름</label>
                    <input class="createGrid2" id="realname" type="hidden" name="realname" value="<?=$realname?>"  />
                    <?=$realname?>
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디</label>
                    <input class="createGrid2" id="username" type="hidden" name="username" value="<?=$username?>"  />
                    <?=$username?>
                    <div class="createGrid3" id="userConf"></div>
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정</label>
                <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호 수정"  />
                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정 확인</label>
                <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 수정 확인"  />
                <div class="createGrid3" id="pwConf"></div>
                <div>
                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
        
                            * 8자 이상 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                            <br>
                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                            <br>
                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                        </p>
        
                    </div> 
                </div>    
            </p>
            

            <p>
                <div class="createInput">
                <label class="createGrid1">이메일</label>
                <textarea class="createGrid2" name="email" placeholder="이메일" value="<?=$email?>" ><?=$email?></textarea>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">필명</label>
                <input class="createGrid2" id="author" name="author" placeholder="필명" value="<?=$author?>"  />
                <div class="createGrid3" id="authorConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">작가소개</label>
                <textarea class="createGrid2" name="auth_detail" placeholder="작가소개" rows="10" cols="20" value="<?=$auth_detail?>" ><?=$auth_detail?></textarea>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">필진 등급</label>
                
                <div class="createGrid2">

                    <input class="cast_btn" type="radio" id="editor_btn"name="cast" value="editor">
                    <label for="editor_btn">Editor</label><br>
                    <input class="cast_btn" type="radio" id="author_btn"name="cast" value="author">
                    <label for="author_btn">Author</label><br>
                    <input class="cast_btn" type="radio" id="normal_btn"name="cast" value="normal">
                    <label for="normal_btn">Normal</label><br>
                </div>
                    

                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1"></label>
                <input class="createGrid2" type="hidden" name="active" value="<?=$active?>"  />
                </div>    
            </p>



            <p>
            <input type="hidden" name="id" value="<?=$q?>">    
            <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()">취소</a></button>

            </p>
        </form>


        <?php   }
                //cast: normal인 경우 본인 정보 수정만 가능
                else if($_SESSION['username'] == $username && $_SESSION['cast'] !== $adminCast && $_SESSION['cast'] !== $editorCast && $_SESSION['cast'] !== $authorCast) {
        ?>
        
        <form class="createForm" action="admin_modify_user_action.php" method="POST" enctype="multipart/form-data">
        <p >
                <div class="createInput">
                    <label class="createGrid1">이름</label>
                    <input class="createGrid2" id="realname" type="hidden" name="realname" value="<?=$realname?>"  />
                    <?=$realname?>
                </div>
                
            </p>
            <p >
                <div class="createInput">
                    <label class="createGrid1">아이디</label>
                    <input class="createGrid2" id="username" type="hidden" name="username" value="<?=$username?>"  />
                    <?=$username?>
                    <div class="createGrid3" id="userConf"></div>
                </div>
                
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정</label>
                <input class="createGrid2" type="password" id="pwOne" name="password" placeholder="비밀번호 수정"  />
                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">비밀번호 수정 확인</label>
                <input class="createGrid2" type="password" id="pwTwo" name="password_conf" placeholder="비밀번호 수정 확인"  />
                <div class="createGrid3" id="pwConf"></div>
                <div>
                        <p style="font-size:0.8rem; margin-top:10px; margin-left:30px">
        
                            * 8자 이상 영문(대소문자)+숫자+특수문자 중 2종류 이상을 조합하여 사용할 수 있습니다.
                            <br>
                            * 아이디와 중복되는 패스워드는 사용이 불가능 합니다.
                            <br>
                            * 동일한 숫자 또는 문자를 3번이상 연속으로 사용할 수 없습니다.
                        </p>
        
                    </div> 
                </div>    
            </p>
            

            <p>
                <div class="createInput">
                <label class="createGrid1">이메일</label>
                <textarea class="createGrid2" name="email" placeholder="이메일" value="<?=$email?>" ><?=$email?></textarea>
                </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">필명</label>
                <input class="createGrid2" id="author" name="author" placeholder="필명" value="<?=$author?>"  />
                <div class="createGrid3" id="authorConf"></div>    
            </div>
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1">작가소개</label>
                <textarea class="createGrid2" name="auth_detail" placeholder="작가소개" rows="10" cols="20" value="<?=$auth_detail?>" ><?=$auth_detail?></textarea>
                </div>
            </p>

            <p>
                <div class="createInput">
                <label class="createGrid1">필진 등급</label>
                
                <div class="createGrid2">

                    
                    <input class="cast_btn" type="radio" id="normal_btn"name="cast" value="normal">
                    <label for="normal_btn">Normal</label><br>
                </div>
                    

                </div>    
            </p>
            <p>
                <div class="createInput">
                <label class="createGrid1"></label>
                <input class="createGrid2" type="hidden" name="active" value="<?=$active?>"  />
                </div>    
            </p>



            <p>
            <input type="hidden" name="id" value="<?=$q?>">    
            <input type="submit">
                <button name="cancel"><a href = "javascript:history.back()" class="cancel_btn">취소</a></button>

            </p>
        </form>







        <?php   } else {
                ?>

                <script>
                                alert("권한이 없습니다.");
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
                        function castSet() {
                        let cast = document.querySelectorAll(".cast_btn");
                        let castVal = "<?=$cast?>";
                        let i;
                        for(i=0; i < cast.length; i++) {
                            if(cast[i].value == castVal) {
                                cast[i].checked = true;
                            }
                        }
                    }
                    castSet();
                    </script>
<?php include "admin_jsGroup.php";?>
<script>
    admin_frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
</script>
</div>

</body>

</html>