<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "bbdd_head.php"; ?>
  
</head>
<body>
    <div id="bbdd_body">
        <header id="bbdd_hd">
            <!-- <div id="bbdd_hd_wrap">
                <div id="bbdd_hd_area" style="transform: translate3d(0px, 0px, 0px); position: fixed; top: 0px;">
                    <div class="hd_contain">
                        <div class="hd_logo">
                            <a href="./">
                                <img src="static/img/logo.png" alt="변방둥둥">
                            </a>
                        </div>
                        <div class="hd_menu">
                            <a>
                                <img src="static/img/menu-bar.png" alt="메뉴바">
                            </a>
                        </div>
                    </div>
                </div>
            </div> -->
            <?php include "front_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <div class="sc_contain">
                <div class="sc_list_area">
                    <ul class="sc_list_contain">
                    <!-- <ul class="sc_list_con"> -->
                        <?php include "frontList.php"; ?>
                           
                
                <!-- </ul>
                </div> -->
                
            </div>
        </div>
    </div>
</section>


        <footer id="bbdd_ft">
            <!-- <div id="bbdd_ft_wrap">
                <div id="bbdd_ft_area">
                    <div class="ft_contain">
                        <p class="gg-batang">
                            COPYRIGHT 2020 변방의북소리.
                        </p>
                    </div>
                </div>
            </div> -->

            <?php include "footer.php";?>
        </footer>
        
    </div>
    <nav id="bbdd_nav">
        <?php include "nav.php"; ?>
    </nav>
    <div id="body_bg"></div>
    
    <?php include "jsGroup.php"; ?>



</body>
</html>