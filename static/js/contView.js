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

            contImgs[cia].title = "";





            contImgs[cia].parentElement.style.textIndent = "0";
            contImgs[cia].style.maxWidth = "100%";
            contImgs[cia].style.height = "auto";

            function showNextImg(imgClassNext) {
                let imgClassNextInt = parseInt(imgClassNext);
                let nextImgSrc;
                if (imgClassNext == contImgs.length) {
                    nextImgSrc = null;
                } else {
                    // nextImgSrc = contImgs[imgClassNext + 1].src;
                    nextImgSrc = contImgs[imgClassNextInt + 1].src;
                }
                if (nextImgSrc !== null) {
                    document.getElementById("img_slide").style.backgroundImage =
                        'url(' +
                        nextImgSrc +
                        ')';
                    // document.getElementById("img_slide").className = imgClassNextInt + 1;
                    document.getElementById("img_slide").className = imgClassNextInt + 1;
                    // document.getElementById("img_slide_next").className = imgClassNextInt + 1;
                    document.getElementById("img_slide_next").className = imgClassNextInt + 1;
                    // document.getElementById("img_slide_prev").className = imgClassNextInt + 1;
                    document.getElementById("img_slide_prev").className = imgClassNextInt + 1;
                }
            }

            function showPrevImg(imgClassPrev) {
                let prevImgSrc;
                if (imgClassPrev == 0) {
                    prevImgSrc = null;
                } else {
                    prevImgSrc = contImgs[imgClassPrev - 1].src;
                }
                if (prevImgSrc !== null) {
                    document.getElementById("img_slide").style.backgroundImage =
                        'url(' +
                        prevImgSrc +
                        ')';
                    document.getElementById("img_slide").className = imgClassPrev - 1;
                    document.getElementById("img_slide_next").className = imgClassPrev - 1;
                    document.getElementById("img_slide_prev").className = imgClassPrev - 1;
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
                    imgSlide.style.maxHeight = "100vh";
                    imgSlide.style.backgroundImage =
                        'url(' +
                        imgSrc +
                        ')';
                    if (window.innerWidth > 801) {
                        imgSlide.style.backgroundPosition = 'center center';
                    } else {
                        imgSlide.style.backgroundPosition = 'center center';
                    }
                    imgSlide.style.backgroundColor = 'black';
                    imgSlide.style.backgroundSize = 'contain';
                    imgSlide.style.backgroundRepeat = 'no-repeat';
                    // imgSlide.style.backgroundAttachment = 'fixed';
                    imgSlide.style.zIndex = '9990';
                    imgSlide.style.position = 'fixed';
                    // imgSlide.style.display = 'flex';
                    imgSlide.style.top = '0';
                    imgSlide.style.bottom = '0';
                    imgSlide.style.left = '0';
                    imgSlide.style.right = '0';
                    imgSlide.style.transition = '0.5s';
                    imgSlide.style.animation = 'expand 0.5s ease-in-out';

                    document.body.style.overflowY = 'hidden';
                    setTimeout(
                        document.body.appendChild(imgSlide), 500
                    );


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
                    imgSlideBtnNext.style.top = "calc(50% - 30px)";
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
                        //     showNextImg(this.className);
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
                    imgSlideBtnPrev.style.top = "calc(50% - 30px)";
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
                    //         showPrevImg(this.className);
                    //     }


                    var imgSlideBtnEsc = document.createElement("div");

                    imgSlideBtnEsc.id = "img_slide_esc";
                    imgSlideBtnEsc.style.width = "calc(100% - 200px)";
                    imgSlideBtnEsc.style.height = "80%";
                    imgSlideBtnEsc.style.margin = "auto";
                    imgSlideBtnEsc.style.position = "relative";
                    imgSlideBtnEsc.style.cursor = "pointer";
                    imgSlideBtnEsc.title = "닫기";



                    imgSlide.appendChild(imgSlideBtnEsc);
                    imgSlide.appendChild(imgSlideBtnNext);
                    imgSlide.appendChild(imgSlideBtnPrev);


                    let imgSlideNext = document.getElementById("img_slide_next");
                    let imgSlidePrev = document.getElementById("img_slide_prev");
                    document.getElementById("img_slide_next").onclick = function() {
                        showNextImg(this.className);
                    }
                    document.getElementById("img_slide_prev").onclick = function() {
                        showPrevImg(this.className);
                    }
                    document.onkeydown = function(keyDown) {
                            switch (keyDown.keyCode) {
                                case 37:
                                    // str = 'Left Key pressed!'; 
                                    if (imgSlideNext && imgSlidePrev) {
                                        // projects_contentsList(mPrev);
                                        showPrevImg(imgSlidePrev.className);

                                    }
                                    // console.log("Left Key Pressed!")
                                    break;
                                case 39:
                                    // str = 'Right Key pressed!'; 
                                    if (imgSlideNext && imgSlidePrev) {
                                        // projects_contentsList(mNext);
                                        showNextImg(imgSlideNext.className);

                                    }
                                    // console.log("Right Key Pressed!")
                                    break;
                                case 27:
                                    // str = 'Esc Key pressed!'; 
                                    if (imgSlideNext && imgSlidePrev) {
                                        // imgSlide.remove();
                                        if (typeof imgSlide.remove === 'function') {
                                            imgSlide.remove();
                                        } else {
                                            imgSlide.parentNode.removeChild(imgSlide);
                                        }
                                        document.body.style.overflowY = 'auto';

                                    }


                                    // console.log("Esc Key Pressed!")
                                    break;
                            }
                        }
                        // imgSlideBtnNext.addEventListener("click", showNextImg(this.class));
                        // imgSlideBtnPrev.addEventListener("click", showPrevImg(this.class));

                    imgSlideBtnEsc.onclick = function() {
                        if (typeof imgSlide.remove === 'function') {
                            imgSlide.remove();
                        } else {
                            imgSlide.parentNode.removeChild(imgSlide);
                        }
                        document.body.style.overflowY = 'auto';
                    };


                }
                // let cia;
                // for(cia=0; cia < contImgAll.length; cia++) {

                // if (contImgs[cia].title === " ") {
                    if (introTitle) {

                    } else {
                        // if(window.innerWidth > 801) {
                        if (window.innerWidth > 1) {
                            contImgs[cia].addEventListener("click", function() {
                                showImgWindow(this.src, this.className);
                            });
                            contImgs[cia].style.cursor = "pointer";
                            contImgs[cia].className = cia;

                        }
                    }
                // }



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

            // if(window.innerWidth < 801) {
            //     document.getElementById("img_slide").style.backgroundPosition = "center top";

            // }


            // if(document.getElementById("img_slide_next") && document.getElementById("img_slide_prev")) {
            //     document.getElementById("img_slide_next").addEventListener("click", function() {
            //         showNextImg(this.className)
            //     });
            //     document.getElementById("img_slide_prev").addEventListener("click", function() {
            //         showPrevImg(this.className)
            //     });
            //     // imgSlideBtnNext.onclick = function() {
            //     //     showNextImg(this.className);
            //     // }
            //     // imgSlideBtnPrev.onclick = function() {
            //     //     showPrevImg(this.className);
            //     // }
            // }



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


    