<!-- <script src="static/js/script.js"></script> -->
<!-- <script src="static/js/contList.js"></script> -->
<!-- <script src="static/js/historyNav.js"></script> -->
<script src="static/js/nav.js"></script>
    <script src="static/js/frontShow.js"></script>
    <script src="static/js/contView.js"></script>
    <script src="static/js/share.js"></script>
    <script>
        function viewImgClick() {
            let contImgAll = document.querySelectorAll(".view_cont_content img");
            let introTitle = document.getElementById("intro_title");
            function showImgWindow(str) {
                let imgSrc = "https://doongdoong.org/se2/upload/" + str;
                // window.open(imgSrc, "imgWindow", "width=1200, height=800");
                let imgSlide = document.createElement("div");
                imgSlide.className = "img_slide";
                // imgSlide.style.width = "100vw";
                // imgSlide.style.height = "100vh";
                imgSlide.style.width = "100%";
                imgSlide.style.height = "100%";
                // document.body.style.width = "100vw";
                // document.body.style.height = "100vh";
                imgSlide.style.backgroundImage = 
                'url(' +
                imgSrc +
                ')';
                imgSlide.style.backgroundPosition = 'center center';
                imgSlide.style.backgroundColor = 'black';
                imgSlide.style.backgroundSize = 'contain';
                imgSlide.style.backgroundRepeat = 'no-repeat';
                imgSlide.style.backgroundAttachment = 'fixed';
                imgSlide.style.zIndex = '9999';
                imgSlide.style.position = 'fixed';
                imgSlide.style.top = '0';
                imgSlide.style.left = '0';

                document.body.appendChild(imgSlide);

                imgSlide.onclick = function() {
                    imgSlide.remove();
                };


            }
            let cia;
            for(cia=0; cia < contImgAll.length; cia++) {
                if(contImgAll[cia].title) {
                    if(introTitle) {

                    } else {
                        contImgAll[cia].addEventListener("click", function() {showImgWindow(this.title)});
                        contImgAll[cia].style.cursor = "pointer";
                    }
                    // if(contImgAll[cia].src == "https://doongdoong.org/se2/upload/" + contImgAll[cia].title) {
                    // }
                }
            }
        }
        viewImgClick();

        // function frontListForm(NumberOfColumn) {
        //     let standingCatAll = document.querySelectorAll(".standing_cat");
        //     let stc;
        //     for(stc=0; stc < standingCatAll.length; stc++) {
        //         standingCatAll[stc].style.width = "calc((100% - 40px) / " + NumberOfColumn + ")";
        //     }
        // }






function frontListColor(bgColor, titleColor, pointColor, navColor) {
    let bodyBgColor = document.body.style.backgroundColor;
    let hdAreaBgColor = document.getElementById("bbdd_hd_area").style.background;
    let scAreaBgColor = document.getElementById("bbdd_sc_area").style.backgroundColor;
    let ftAreaBgColor = document.getElementById("bbdd_ft_area").style.backgroundColor;
    let navBgColor = document.getElementById("bbdd_nav").style.backgroundColor;

    // bodyBgColor = bgColor;
    // scAreaBgColor = bgColor;
    // ftAreaBgColor = bgColor;

    // hdAreaBgColor = pointColor;

    // navBgColor = navColor;
    document.body.style.backgroundColor = bgColor;
    document.getElementById("bbdd_sc_area").style.backgroundColor = bgColor;
    document.getElementById("bbdd_ft_area").style.backgroundColor = bgColor;

    document.getElementById("bbdd_hd_area").style.background = pointColor;

    document.getElementById("bbdd_nav").style.backgroundColor = navColor;

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