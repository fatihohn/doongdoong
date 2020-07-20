        // let contImgs = document.querySelectorAll(".view_cont_content img");

        // contImgs.foreach(b => {
        //     b.parent('p').style.textIndent = "0";
        // });

        // let a;
        // for(a = 0, a < contImgs.length, a++) {
        //     contImgs[a].parentNode.style.textIndent = "0";
        // }
        // }
        // imgIndent();

        
        let contImgs = document.querySelectorAll(".view_cont_content img");

        

        let cia;
        for (cia = 0; cia < contImgs.length; cia++) {
            contImgs[cia].parentElement.style.textIndent = "0";
            contImgs[cia].style.maxWidth = "100%";
            contImgs[cia].style.height = "auto";

            function showNextImg(imgClass) {
                let nextImgSrc;
                if(imgClass + 1 > contImgs.length) {
                    nextImgSrc = null;
                } else {
                    nextImgSrc = contImgs[imgClass + 1].src;
                }
                if (nextImgSrc !== null) {
                    document.getElementById("img_slide").style.backgroundImage =
                        'url(' +
                        nextImgSrc +
                        ')';
                        document.getElementById("img_slide").className = imgClass + 1;
                        document.getElementById("img_slide_next").className = imgClass + 1;
                        document.getElementById("img_slide_prev").className = imgClass + 1;
                }
            }
            function showPrevImg(imgClass) {
                let prevImgSrc;
                if(imgClass - 1 < 0) {
                    prevImgSrc = null;
                } else {
                    prevImgSrc = contImgs[imgClass - 1].src;
                }
                if (prevImgSrc !== null) {
                    document.getElementById("img_slide").style.backgroundImage =
                        'url(' +
                        prevImgSrc +
                        ')';
                    document.getElementById("img_slide").className = imgClass - 1;
                    document.getElementById("img_slide_next").className = imgClass - 1;
                    document.getElementById("img_slide_prev").className = imgClass - 1;
                }
            }


            function viewImgClick() {
                // let contImgAll = document.querySelectorAll(".view_cont_content img");
                let introTitle = document.getElementById("intro_title");
                function showImgWindow(imgUrl, imgClassName) {
                    // let imgSrc = "https://doongdoong.org/se2/upload/" + imgurl;
                    let imgSrc = imgUrl;
                    let imgSlide = document.createElement("div");
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
                    
                    document.body.appendChild(imgSlide);
                    
    
                    // if(contImgs.length < 2) {
    
                    // } else if (contImgs.length >= 2 && imgClassName == 0) {
                    //     var nextImgSrc = contImgs[nextImgNumber].src;
                    //     var prevImgSrc = 'noCont';
                    // } else if (contImgs.length >= 2 && imgClassName < contImgs.length) {
                    //     var nextImgSrc = contImgs[nextImgNumber].src;
                    //     var prevImgSrc = contImgs[prevImgNumber].src;
                    // } else if (contImgs.length >= 2 && imgClassName == contImgs.length) {
                    //     var nextImgSrc = 'noCont';
                    //     var prevImgSrc = contImgs[prevImgNumber].src;
                    // }
    
    
    
    
    
    
                    var imgSlideBtnNext = document.createElement("div");
                    // imgSlideBtnNext.className = "img_slide_btn";
                    imgSlideBtnNext.className = imgClassName;
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
                    imgSlideBtnNext.style.textAlign = "center";
    
    
                    // let nextImgNumber = imgSlideBtnNext.className + 1;
                    // if(nextImgNumber <= contImgs.length) {
                    //     let nextImgSrc = contImgs[nextImgNumber].src;
                    // }
                    
                    
                    
                    
    
    
                    imgSlideBtnNext.onmouseover = function() {
                        imgSlideBtnNext.style.opacity = "0.9";
                    }
                    imgSlideBtnNext.onmouseleave = function() {
                        imgSlideBtnNext.style.opacity = "0.3";
                    }
                    // imgSlideBtnNext.onclick = function() {
                        
                    //     showNextImg(this.class);
                    // }
    
                    
                    var imgSlideBtnPrev = document.createElement("div");
                    // imgSlideBtnPrev.className = "img_slide_btn";
                    imgSlideBtnPrev.className = imgClassName;
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
                    imgSlideBtnPrev.style.textAlign = "center";
                    
                    
                    // let prevImgNumber = imgSlideBtnPrev.className - 1;
                    // if(prevImgNumber >= 0) {
                        //     let prevImgSrc = contImgs[prevImgNumber].src;
                        // }
                        
                        
                        
                        imgSlideBtnPrev.onmouseover = function() {
                            imgSlideBtnPrev.style.opacity = "0.9";
                        }
                        imgSlideBtnPrev.onmouseleave = function() {
                            imgSlideBtnPrev.style.opacity = "0.3";
                        }
                        // imgSlideBtnPrev.onclick = function(imgClassName) {
                            //     if(prevImgSrc !== null) {
                                //         imgSlide.style.backgroundImage = 
                                //         'url(' +
                                //         prevImgSrc +
                                //         ')';
                                //     }
                                // }
                                
                                // imgSlideBtnPrev.onclick = function() {
                                    
                                    //     showPrevImg(this.class);
                                    // }
                                    
                                    
                    imgSlide.appendChild(imgSlideBtnNext);
                    imgSlide.appendChild(imgSlideBtnPrev);

                    // imgSlideBtnNext.addEventListener("click", showNextImg(this.class));
                    // imgSlideBtnPrev.addEventListener("click", showPrevImg(this.class));
                    
                    // imgSlide.onclick = function() {
                    //     imgSlide.remove();
                    // };
    
    
                }
                // let cia;
                // for(cia=0; cia < contImgAll.length; cia++) {
    
                    if(contImgs[cia].title) {
                        if(introTitle) {
    
                        } else {
                            if(window.innerWidth > 801) {
                                contImgs[cia].addEventListener("click", function() {
                                    showImgWindow(this.src, this.className);
                                    
                                });
                                contImgs[cia].style.cursor = "pointer";
                                contImgs[cia].className = cia;
    
    
                                
    
    
                            }
                        }
                    }

                    
            
                    // function showPrevImg(imgClass) {
                    //     let prevImgSrc = contImgs[imgClass - 1].src;
                    //     if (prevImgSrc !== null) {
                    //         imgSlide.style.backgroundImage =
                    //             'url(' +
                    //             prevImgSrc +
                    //             ')';
                    //     }
                    // }
                    // }
                    
            }
            viewImgClick();
            
            if(document.getElementById("img_slide_next") && document.getElementById("img_slide_prev")) {
                document.getElementById("img_slide_next").addEventListener("click", showNextImg(this.className));
                document.getElementById("img_slide_prev").addEventListener("click", showPrevImg(this.className));
                // imgSlideBtnNext.onclick = function() {
                //     showNextImg(this.className);
                // }
                // imgSlideBtnPrev.onclick = function() {
                //     showPrevImg(this.className);
                // }
            }



            // contImgs[a].classname = a;

            // if(contImgs.length < 2) {

            // } else if (contImgs.length >= 2 && a == 0) {
            //     let aNext = this.className + 1;
            //     var nextImgSrc = contImgs[aNext].title;
            //     // var prevImgSrc = contImgs[a-1].title;
            //     var prevImgSrc = null;
            // } else if (contImgs.length >= 2 && a < contImgs.length) {
            //     let aNext = this.className + 1;
            //     let aPrev = this.className - 1;
            //     var nextImgSrc = contImgs[aNext].title;
            //     var prevImgSrc = contImgs[aPrev].title;
            // } else if (contImgs.length >= 2 && a == contImgs.length) {
            //     // let aNext = this.className + 1;
            //     let aPrev = this.className - 1;
            //     var nextImgSrc = null;
            //     var prevImgSrc = contImgs[aPrev].title;
            // }




        }






        let contP = document.querySelectorAll(".view_cont_content p");
        let b;
        for (b = 0; b < contP.length; b++) {
            let contPStyleOrigin = contP[b].getAttribute("style");
            if (contPStyleOrigin == null) {
                contP[b].style.textAlign = "left";
            } else {

            }
        }