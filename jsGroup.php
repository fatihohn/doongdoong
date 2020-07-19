<!-- <script src="static/js/script.js"></script> -->
<!-- <script src="static/js/contList.js"></script> -->
<!-- <script src="static/js/historyNav.js"></script> -->
<script src="static/js/nav.js"></script>
    <script src="static/js/frontShow.js"></script>
    <script src="static/js/contView.js"></script>
    <script src="static/js/share.js"></script>
    <script>

        // if(document.getElementById("img_slide")) {
        //     var imgNumber = document.getElementById("img_slide").className;
        //     if(contImgs.length < 2) {

        //     } else if (contImgs.length >= 2 && imgNumber == 0) {
        //         var nextImgSrc = contImgs[imgNumber + 1].title;
        //         var prevImgSrc = 'noCont';
        //     } else if (contImgs.length >= 2 && imgNumber < contImgs.length) {
        //         var nextImgSrc = contImgs[imgNumber + 1].title;
        //         var prevImgSrc = contImgs[imgNumber - 1].title;
        //     } else if (contImgs.length >= 2 && imgNumber == contImgs.length) {
        //         var nextImgSrc = 'noCont';
        //         var prevImgSrc = contImgs[imgNumber - 1].title;
        //     }
        // }

        function viewImgClick() {
            let contImgAll = document.querySelectorAll(".view_cont_content img");
            let introTitle = document.getElementById("intro_title");
            function showImgWindow(imgurl, imgClassName) {
                // let imgSrc = "https://doongdoong.org/se2/upload/" + imgurl;
                let imgSrc = imgurl;
                // window.open(imgSrc, "imgWindow", "width=1200, height=800");
                let imgSlide = document.createElement("div");
                // imgSlide.className = "img_slide";
                
                // let imgNumber = document.getElementById("img_slide").className;
                imgSlide.className = imgClassName;
                imgSlide.id = "img_slide";
                imgSlide.style.width = "100%";
                imgSlide.style.height = "100%";
                imgSlide.style.backgroundImage = 
                'url(' +
                imgSrc +
                ')';
                imgSlide.style.backgroundPosition = 'center center';
                imgSlide.style.backgroundColor = 'black';
                imgSlide.style.backgroundSize = 'contain';
                imgSlide.style.backgroundRepeat = 'no-repeat';
                imgSlide.style.backgroundAttachment = 'fixed';
                imgSlide.style.zIndex = '9990';
                imgSlide.style.position = 'fixed';
                imgSlide.style.top = '0';
                imgSlide.style.left = '0';
                // imgSlide.style.cursor = 'pointer';
                
                document.body.appendChild(imgSlide);
                
                var imgSlideBtnNext = document.createElement("div");
                imgSlideBtnNext.className = "img_slide_btn";
                imgSlideBtnNext.id = "img_slide_next";
                
                imgSlideBtnNext.innerHTML = "▶";
                imgSlideBtnNext.style.width = "60px";
                imgSlideBtnNext.style.height = "60px";
                imgSlideBtnNext.style.fontSize = "3rem";
                imgSlideBtnNext.style.fontWeight = "900";
                imgSlideBtnNext.style.color = "white";
                imgSlideBtnNext.style.opacity = "0.3";
                imgSlideBtnNext.style.position = "fixed";
                imgSlideBtnNext.style.top = "50%";
                imgSlideBtnNext.style.right = "0";
                imgSlideBtnNext.style.margin = "10px";
                imgSlideBtnNext.style.zIndex = "9999";
                imgSlideBtnNext.style.cursor = "pointer";
                
                
                
                
                // if(contImgs.length < 2) {

                // } else if (contImgs.length >= 2 && imgNumber == 0) {
                //     var nextImgSrc = contImgs[imgNumber + 1].title;
                //     var prevImgSrc = 'noCont';
                // } else if (contImgs.length >= 2 && imgNumber < contImgs.length) {
                //     var nextImgSrc = contImgs[imgNumber + 1].title;
                //     var prevImgSrc = contImgs[imgNumber - 1].title;
                // } else if (contImgs.length >= 2 && imgNumber == contImgs.length) {
                //     var nextImgSrc = 'noCont';
                //     var prevImgSrc = contImgs[imgNumber - 1].title;
                // }


                imgSlideBtnNext.onmouseover = function() {
                    imgSlideBtnNext.style.opacity = "0.9";
                }
                imgSlideBtnNext.onmouseleave = function() {
                    imgSlideBtnNext.style.opacity = "0.3";
                }
                imgSlideBtnNext.onclick = function() {
                    if(nextImgSrc !== 'noCont') {
                        imgSlide.style.backgroundImage = 
                        'url(' +
                        nextImgSrc +
                        ')';
                    }
                }

                var imgSlideBtnPrev = document.createElement("div");
                imgSlideBtnPrev.className = "img_slide_btn";
                imgSlideBtnPrev.id = "img_slide_prev";

                imgSlideBtnPrev.innerHTML = "◀";
                imgSlideBtnPrev.style.width = "60px";
                imgSlideBtnPrev.style.height = "60px";
                imgSlideBtnPrev.style.fontSize = "3rem";
                imgSlideBtnPrev.style.fontWeight = "900";
                imgSlideBtnPrev.style.color = "white";
                imgSlideBtnPrev.style.opacity = "0.3";
                imgSlideBtnPrev.style.position = "fixed";
                imgSlideBtnPrev.style.top = "50%";
                imgSlideBtnPrev.style.left = "0";
                imgSlideBtnPrev.style.margin = "10px";
                imgSlideBtnPrev.style.zIndex = "9999";
                imgSlideBtnPrev.style.cursor = "pointer";
                imgSlideBtnPrev.onmouseover = function() {
                    imgSlideBtnPrev.style.opacity = "0.9";
                }
                imgSlideBtnPrev.onmouseleave = function() {
                    imgSlideBtnPrev.style.opacity = "0.3";
                }
                imgSlideBtnPrev.onclick = function() {
                    if(prevImgSrc !== null) {
                        imgSlide.style.backgroundImage = 
                        'url(' +
                        prevImgSrc +
                        ')';
                    }
                }

                // document.body.appendChild(imgSlideBtnNext);
                imgSlide.appendChild(imgSlideBtnNext);
                imgSlide.appendChild(imgSlideBtnPrev);
                
                imgSlide.onclick = function() {
                    imgSlide.remove();
                    imgSlideBtnNext.remove();
                };


            }
            let cia;
            for(cia=0; cia < contImgAll.length; cia++) {
                // if(contImgAll.length < 2) {

                // } else if (contImgAll.length >= 2 && cia == 0) {
                //     let nextImgSrc = contImgAll[cia+1].title;
                //     // let prevImgSrc = contImgAll[cia-1].title;
                //     let prevImgSrc = null;
                // } else if (contImgAll.length >= 2 && cia < contImgAll.length) {
                //     let nextImgSrc = contImgAll[cia+1].title;
                //     let prevImgSrc = contImgAll[cia-1].title;
                // } else if (contImgAll.length >= 2 && cia == contImgAll.length) {
                //     let nextImgSrc = null;
                //     let prevImgSrc = contImgAll[cia-1].title;
                // }

                if(contImgAll[cia].title) {
                    if(introTitle) {

                    } else {
                        if(window.innerWidth > 801) {
                            contImgAll[cia].addEventListener("click", function() {
                                // showImgWindow(this.title, this.className);
                                showImgWindow(this.src, this.className);

                                if(contImgs.length < 2) {

                                } else if (contImgs.length >= 2 && this.className == 0) {
                                    var nextImgSrc = contImgs[this.className + 1].title;
                                    var prevImgSrc = 'noCont';
                                } else if (contImgs.length >= 2 && this.className < contImgs.length) {
                                    var nextImgSrc = contImgs[this.className + 1].title;
                                    var prevImgSrc = contImgs[this.className - 1].title;
                                } else if (contImgs.length >= 2 && this.className == contImgs.length) {
                                    var nextImgSrc = 'noCont';
                                    var prevImgSrc = contImgs[this.className - 1].title;
                                }



                                // if(nextImgSrc !== null) {
                                //     imgSlideBtnNext.onclick = function() {
                                //         document.getElementById("img_slide").style.backgroundImage = 
                                //         'url(' +
                                //         nextImgSrc +
                                //         ')';
                                //     }
                                // };

                                // if(contImgAll.length < 2) {

                                // } else if (contImgAll.length >= 2 && this.className == 0) {
                                //     let aNext = this.className + 1;
                                //     var nextImgSrc = contImgAll[aNext].title;
                                //     // var prevImgSrc = contImgAll[a-1].title;
                                //     var prevImgSrc = null;
                                // } else if (contImgAll.length >= 2 && this.className < contImgAll.length) {
                                //     let aNext = this.className + 1;
                                //     let aPrev = this.className - 1;
                                //     var nextImgSrc = contImgAll[aNext].title;
                                //     var prevImgSrc = contImgAll[aPrev].title;
                                // } else if (contImgAll.length >= 2 && this.className == contImgAll.length) {
                                //     // let aNext = this.className + 1;
                                //     let aPrev = this.className - 1;
                                //     var nextImgSrc = null;
                                //     var prevImgSrc = contImgAll[aPrev].title;
                                // }
                            });
                            contImgAll[cia].style.cursor = "pointer";
                            contImgAll[cia].className = cia;

                            // if(nextImgSrc !== null) {
                            // imgSlideBtnNext.onclick = function() {
                            //         document.getElementById("img_slide").style.backgroundImage = 
                            //         'url(' +
                            //         nextImgSrc +
                            //         ')';
                            //     }
                            // };

                            


                        }
                    }
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