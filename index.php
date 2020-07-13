<!DOCTYPE html>
<html>
<head>
  <?php include "bbdd_head.php"; 
  
  include "bbdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  $sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$zin_column = $rowStandingZin['zin_column'];
$zin_color = $rowStandingZin['zin_color'];
$title_color = $rowStandingZin['title_color'];
$point_color = $rowStandingZin['point_color'];
$nav_color = $rowStandingZin['nav_color'];

  ?>
  
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
    <div id="bbdd_body">
        <header id="bbdd_hd">
        
            <?php include "front_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <div class="sc_contain">
                <!-- <div class="sc_list_area"> -->
                    <!-- <ul class="sc_list_contain"> -->
                        <?php include "frontList.php"; ?>
                           
                
                
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

<script>
    
function frontListColor(bgColor, titleColor, pointColor, navColor) {
    var bodyBgColor = document.body.style.backgroundColor;
    var hdAreaBgColor = document.getElementById("bbdd_hd_area").style.background;
    var scAreaBgColor = document.getElementById("bbdd_sc_area").style.backgroundColor;
    var ftAreaBgColor = document.getElementById("bbdd_ft_area").style.backgroundColor;
    var navBgColor = document.getElementById("bbdd_nav").style.backgroundColor;

    bodyBgColor = bgColor;
    scAreaBgColor = bgColor;
    ftAreaBgColor = bgColor;

    hdAreaBgColor = pointColor;

    navBgColor = navColor;

    var megaTitleAll = document.querySelectorAll(".mega_title");
    var mta;
    for(mta=0; mta < megaTitleAll.length; mta++) {
        megaTitleAll[mta].style.color = titleColor;
        megaTitleAll[mta].style.borderBottom = "2px dashed" + titleColor;
        // document.a.style.color = titleColor;
    }

    var navCloseBtn = document.querySelectorAll(".close");
    var ncb;
    for(ncb=0; ncb < navCloseBtn.length; ncb++) {
        navCloseBtn[ncb].style.color = pointColor;
    }

    var navPortalBtn = document.querySelectorAll(".portal_btn");
    var npb;
    for(npb=0; npb < navPortalBtn.length; npb++) {
        navPortalBtn[npb].style.backgroundColor = pointColor;
    }

    var navMain = document.querySelectorAll(".nav_main");
    var nMn;
    for(nMn=0; nMn < navMain.length; nMn++) {
        navMain[nMn].style.border = "2px dashed" + pointColor;
    }

    var navFontColor = document.querySelectorAll(".nav_font");
    var nfc;
    for(nfc=0; nfc < navFontColor.length; nfc++) {
        navFontColor[nfc].color = pointColor;
    }
}

frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");

</script>

</body>
</html>