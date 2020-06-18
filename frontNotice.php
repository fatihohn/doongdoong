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
                            <a href="/bbdd/">
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
        <?php
include 'bbdd_db_conn.php';



?>


<div class="view_wrap">
    <div class="view_wrap_line">

       <div class = 'view_category'>'둥둥' 지난호</div>
        <div class = 'view_author'>
            
        </div>
        <ul class = 'view_contList'>
            <?php 
            // $sql = "SELECT * FROM notice WHERE category = 'notice' AND display='on' ORDER BY id DESC";
            $sql = "SELECT * FROM zin WHERE publish = 'ready' AND display='on' ORDER BY id DESC";
            $result = $conn->query($sql) or die($conn->error);
            
            if($result->num_rows >0){
                while($rows = $result->fetch_assoc()) {
                    $created_dateTime = $rows['created'];
                    $created_date = explode(" ", $created_dateTime)[0];
                    echo "
                    <li class='cont_li'>
                    <a class = 'frontCont' id = '";
                    echo $rows['id'];
                    echo "'";
                    echo " onclick = 'frontNoticeSlctShow(this.id)'>
                    <div class='cont_li_title'>
                    <p>";
                 
                    echo $rows['title'];
                    echo '</p>
                    </div>
                    <div class="li_created">
                    <span>';
                    // echo $rows['created'];
                    echo $created_date;
                    echo '</span>
                    </div>
                    
                    </a>
                    </li>';
                }
            }
            
            ?>
        </ul>
                   
    </div>
</div>


        </div>
    </div>
</section>


        <footer id="bbdd_ft">
          
            <?php include "footer.php";?>
        </footer>
        
    </div>
    <nav id="bbdd_nav">
        <?php include "nav.php"; ?>
    </nav>
    <div id="body_bg"></div>
    <?php include "jsGroup.php"; ?>
    <?php include "admin_jsGroup.php"; ?>



</body>
</html>




















    

