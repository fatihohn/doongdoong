<div id="bbdd_hd_wrap">
                <div id="bbdd_hd_area" style="transform: translate3d(0px, 0px, 0px); position: fixed; top: 0px;">
                    <div class="hd_contain">
                        <div class="hd_logo">
                            <a href="/admin_index.php">
                                <img src="static/img/editor_logo.png" alt="변방의북소리 웹진 둥둥 에디터">
                                <!-- <div class="ad_tag">
                                관리자
                                </div> -->
                            </a>
                        </div>


                        <div class="hd_ad_logIn">
                            <a>
                                <!-- <img src="static/img/menu-bar.png" alt="관리자 메뉴"> -->
                                <!-- [로그인] -->
                                <?php
        include 'bbdd_db_conn.php';
        // $query = "select * from user_data order by id desc";
        // $result = $conn->query($query);
        // $total = mysqli_num_rows($result);
        
        session_start();
        
        if (isset($_SESSION['username'])) {
            ?> <div onclick="location.href='./admin_logout.php'">
            <?php
            // echo $_SESSION['username'];
            echo $_SESSION['author'];
            echo " ";
            
            if($_SESSION['cast'] == 'admin') {
                echo "관리자";
            } else if($_SESSION['cast'] == 'editor') {
                echo "에디터";
            } else if($_SESSION['cast'] == 'author') {
                echo "작가";
            }
            // echo $_SESSION['cast'];
            
            ?>님 [LogOut]</div>
            <!-- <button onclick="location.href='./admin_logout.php'">로그아웃</button> -->
            
            <?php
        } else {
            ?> <div onclick="location.href='./admin_login.php'"><h4>[LogIn]</h4></div>
    <!-- ?> <button onclick="location.href='./admin_login.php'">로그인</button> -->
    
    <?php   }
    ?>  
                            </a>
                        </div>
                        <div class="hd_ad_menu adminMenu">
                            <a>
                                <!-- <img src="static/img/menu-bar.png" alt="관리자 메뉴"> -->
                                [관리자 메뉴]
                            </a>
                        </div>
                        <article class="adArticle  adminMenu">
                        <?php 
        include 'admin_article.php'; 
        ?>
        </article>
                        <div class="hd_menu">
                            <a>
                                <img src="static/img/menu-bar.png" alt="메뉴바">
                            </a>
                        </div>


                    </div>
                </div>
            </div>