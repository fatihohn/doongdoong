<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>

       <?php

include 'bbdd_db_conn.php';
session_start();

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$zin_column = $rowStandingZin['zin_column'];
$zin_color = $rowStandingZin['zin_color'];
$title_color = $rowStandingZin['title_color'];
$point_color = $rowStandingZin['point_color'];
$nav_color = $rowStandingZin['nav_color'];



if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다. 로그인하세요.");
                            
                    </script>

    <?php  
    echo "<section id='bbdd_sc'>
    <div id='bbdd_sc_wrap'>
        <div id='bbdd_sc_area'>
            <div class='sc_contain'>
                <div class='sc_list_area'>
    
    
        <div>";
            echo "<a><div class = 'ad_logIn' onclick='";
            echo 'location.href="./admin_login.php"';
            echo "'>
            <img src='static/img/editor_logo.png' alt='둥둥 에디터'><h4>LogIn</h4></a>";    
            // include "admin_editor_index.php";
     echo "</div>
     </div>
     </div>
     </div>
     </div>
        </section>";
            }
            else {
                if($_SESSION['cast'] == "normal") {
                    ?>
                    <script>
                        location.replace("./index.php");
                    </script>
                    <?php
                } else {
                    echo "<div id='bbdd_body'>
                            <header id='bbdd_hd'>";
                               include 'admin_header.php'; 
                    echo    "</header>";
                    
                                include "admin_editor_index.php";
                }

}


        
            ?>
   

    <?php include "admin_jsGroup.php";?>

    <script>
        function frontListColor(bgColor, titleColor, pointColor, navColor) {
    let bodyBg = document.body;
    let hdAreaBg = document.getElementById("bbdd_hd_area");
    let scAreaBg = document.getElementById("bbdd_sc_area");
    let ftAreaBg = document.getElementById("bbdd_ft_area");
    let navBg = document.getElementById("bbdd_nav");

    // bodyBgColor = bgColor;
    // scAreaBgColor = bgColor;
    // ftAreaBgColor = bgColor;

    // hdAreaBgColor = pointColor;

    // navBgColor = navColor;
    if(bodyBg) {
        document.body.style.backgroundColor = bgColor;
    }
    if(scAreaBg) {
        document.getElementById("bbdd_sc_area").style.backgroundColor = bgColor;
    }
    if(ftAreaBg) {
        document.getElementById("bbdd_ft_area").style.backgroundColor = bgColor;
    }
    if(hdAreaBg) {
        document.getElementById("bbdd_hd_area").style.background = pointColor;
    }
    if(navBg) {
        document.getElementById("bbdd_nav").style.backgroundColor = navColor;
    }


    var navFontColor = document.querySelectorAll(".nav_font_color");
    if(navFontColor) {
        var nfc;
        for(nfc=0; nfc < navFontColor.length; nfc++) {
            navFontColor[nfc].color = pointColor + "!important";
        }
    }
    
    var aTagAll = document.querySelectorAll("a");
    if(aTagAll) {
        var ata;
        for(ata=0; ata < aTagAll.length; ata++) {
            aTagAll[ata].style.color = titleColor;
            // aTagAll[ata].style.textDecoration = "none";
        }
    }

    var navCloseBtn = document.querySelectorAll(".close");
    if(navCloseBtn) {
        var ncb;
        for(ncb=0; ncb < navCloseBtn.length; ncb++) {
            navCloseBtn[ncb].style.color = pointColor;
        }
    }

    var navPortalBtn = document.querySelectorAll(".portal_btn");
    if(navPortalBtn) {
        var npb;
        for(npb=0; npb < navPortalBtn.length; npb++) {
            navPortalBtn[npb].style.backgroundColor = pointColor;
        }
    }


    var navMain = document.querySelectorAll(".nav_main");
    if(navMain) {
        var nMn;
        for(nMn=0; nMn < navMain.length; nMn++) {
            navMain[nMn].style.border = "2px dashed" + pointColor;
        }
    }



    var megaTitleAll = document.querySelectorAll(".mega_title");
    if(megaTitleAll) {
        var mta;
        for(mta=0; mta < megaTitleAll.length; mta++) {
            megaTitleAll[mta].style.color = titleColor;
            megaTitleAll[mta].style.borderBottom = "2px dashed" + titleColor;
        }
    }





    var frontContColor = document.querySelectorAll(".frontCont");
    if(frontContColor) {
        var fcc;
        for(fcc=0; fcc < frontContColor.length; fcc++) {
            frontContColor[fcc].color = titleColor;
        }
    }

    var frontTitleColor = document.querySelectorAll(".front_title_color");
    if(frontTitleColor) {
        var fcc;
        for(fcc=0; fcc < frontTitleColor.length; fcc++) {
            frontTitleColor[fcc].color = titleColor;
        }
    }

    var frontPointColor = document.querySelectorAll(".front_point_color");
    if(frontPointColor) {
        var fpc;
        for(fpc=0; fpc < frontPointColor.length; fpc++) {
            frontPointColor[fpc].color = pointColor;
        }
    }
}

frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    </script>

</body>

</html>