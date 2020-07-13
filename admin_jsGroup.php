<!-- <script src="static/js/script.js"></script> -->
<!-- <script src="static/js/nav.js"></script> -->
    <!-- <script src="static/js/contList.js"></script> -->
    <!-- <script src="static/js/frontShow.js"></script> -->
    <!-- <script src="static/js/contView.js"></script> -->
    <!-- <script src="static/js/historyNav.js"></script> -->
    <!-- <script src="static/js/admin_menuClick.js"></script> -->
    <script src="static/js/admin_delete.js"></script>
    <script src="static/js/admin_modify.js"></script>
    <script src="static/js/admin_check.js"></script>
    <script src="static/js/admin_show.js"></script>
    <script src="static/js/admin_str_replace.js"></script>
    <script src="static/js/searchInput.js"></script>
    <script src="static/js/sortTable.js"></script>
    <script src="static/js/paginator.js"></script>
    
    <!-- <script>
        function thumbsToTop(str) {
            location.href = './admin_modify_thumbs_toTop.php?id=' + str;
        }
    </script> -->
    
    
    <!-- <script src="static/js/browser_detect.js"></script> -->
    <!-- <script src="admin_menu.js"></script> -->
    <script type="text/javascript" src="se2/js/service/HuskyEZCreator.js" charset="utf-8"></script>

<script>
    function admin_frontListColor(bgColor, titleColor, pointColor, navColor) {
    let bodyBgColor = document.body.style.backgroundColor;
    let hdAreaBgColor = document.getElementById("bbdd_hd_area").style.background;
    let scAreaBgColor = document.getElementById("bbdd_sc_area").style.backgroundColor;
    let ftAreaBgColor = document.getElementById("bbdd_ft_area").style.backgroundColor;
    let navBgColor = document.getElementById("bbdd_nav").style.backgroundColor;


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
            navFontColor[nfc].style.color = pointColor + "!important";
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
            frontContColor[fcc].style.color = titleColor;
        }
    }

    var frontTitleColor = document.querySelectorAll(".front_title_color");
    if(frontTitleColor) {
        var fcc;
        for(fcc=0; fcc < frontTitleColor.length; fcc++) {
            frontTitleColor[fcc].style.color = titleColor;
        }
    }

    var frontPointColor = document.querySelectorAll(".front_point_color");
    if(frontPointColor) {
        var fpc;
        for(fpc=0; fpc < frontPointColor.length; fpc++) {
            frontPointColor[fpc].style.color = pointColor;
        }
    }
}
</script>