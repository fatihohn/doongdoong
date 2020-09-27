<!DOCTYPE html>
<html lang="ko">
<head>
    <?php include "bbdd_head.php"; ?>
  
</head>
<body>
        <?php
include 'bbdd_db_conn.php';

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
// $zin_column = $rowStandingZin['zin_column'];
// $zin_color = $rowStandingZin['zin_color'];
// $title_color = $rowStandingZin['title_color'];
// $point_color = $rowStandingZin['point_color'];
// $nav_color = $rowStandingZin['nav_color'];

$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();
$zin_column = $rowZinNow['zin_column'];
$zin_color = $rowZinNow['zin_color'];
$title_color = $rowZinNow['title_color'];
$point_color = $rowZinNow['point_color'];
$nav_color = $rowZinNow['nav_color'];

$q = intval($_GET['q']);
$qVal = $_GET['q'];


session_start();


$sql = "SELECT * FROM notice WHERE category = 'intro' AND display='on' ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);




?>
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


<div class="view_wrap">
    <div class="view_wrap_line">

        
        
        
        <div id="intro_title" class = 'view_cont_sess front_point_color'>
            <?php echo $rows['title']?>





        </div>
        <!-- <div class = 'view_cont_title'>
            <?php 
            // echo $rows['title'];
            ?>
        </div> -->
        <div class = 'gg-batang view_cont_content'>
            <?php echo $rows['content']?>


            <div class='view_author front_point_color'>
                에디터_<?php echo $rows['author']?>
               
            </div>
            <div class = 'view_btn'>
                
              
                    
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
</section>


        <footer id="bbdd_ft">
            <!-- <div id="bbdd_ft_wrap">
                <div id="bbdd_ft_area">
                    <div class="ft_con">
                        <p class="gg-title">
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
    <?php include "admin_jsGroup.php"; ?>
<script>
    document.getElementById("bbdd_sc_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.getElementById("bbdd_ft_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.querySelector("body").style.backgroundColor = "rgb(255, 255, 255)";
    frontListColor("rgb(255,255,255)", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    



</script>


</body>
</html>




















    


    

