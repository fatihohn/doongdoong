<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
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
        ?>
        
    <section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <div class="sc_contain">
                <div class="sc_list_area">

        <div class="adLogInProcess">
    
            <div class='ad_logInLogo' onclick='location.href="./admin_login.php"'>
            <img src='static/img/editor_logo.png' alt='변방둥둥'>      
            </div>

            <br>
            
            <div align='center'>
        <span>로그인</span>
 
        <form method='post' action='admin_login_action.php'>
        <!-- <form method='get' action='login_action.php'> -->
                <p>ID: <input name="username" type="text" required></p>
                <p>PW: <input name="password" type="password" required></p>
                <input type="submit" value="로그인">
        </form>
        <br />
        <button id="join" onclick="location.href='./admin_create_user.php'">회원가입</button>
 
        </div>
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


