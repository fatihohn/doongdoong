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
        let a;
        for (a = 0; a < contImgs.length; a++) {
            contImgs[a].parentElement.style.textIndent = "0";
            contImgs[a].style.maxWidth = "100%";
            contImgs[a].style.height = "auto";


            function showNextImg(nextImgClass) {
                // let nextImgSrc = contImgs[nextImgClass + 1].src;
                let nextImgSrc = contImgs[nextImgClass + 1].src;
                if (nextImgSrc !== null) {
                    imgSlide.style.backgroundImage =
                        'url(' +
                        nextImgSrc +
                        ')';
                }
            }

            function showPrevImg(prevImgClass) {
                let prevImgSrc = contImgs[prevImgClass - 1].src;
                if (prevImgSrc !== null) {
                    imgSlide.style.backgroundImage =
                        'url(' +
                        prevImgSrc +
                        ')';
                }
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

        function viewImgClick() {
            let contImgAll = document.querySelectorAll(".view_cont_content img");
            let introTitle = document.getElementById("intro_title");

            function showImgWindow(imgurl, imgClassName) {
                // let imgSrc = "https://doongdoong.org/se2/upload/" + imgurl;
                let imgSrc = imgurl;
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

                imgSlideBtnNext.addEventListener("click", showNextImg(this.class));

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

                imgSlideBtnPrev.addEventListener("click", showPrevImg(this.class));

                // document.body.appendChild(imgSlideBtnNext);
                imgSlide.appendChild(imgSlideBtnNext);
                imgSlide.appendChild(imgSlideBtnPrev);

                imgSlide.onclick = function() {
                    imgSlide.remove();
                    // imgSlideBtnNext.remove();
                    // imgSlideBtnPrev.remove();
                };


            }
            let cia;
            for (cia = 0; cia < contImgAll.length; cia++) {

                if (contImgAll[cia].title) {
                    if (introTitle) {

                    } else {
                        if (window.innerWidth > 801) {
                            contImgAll[cia].addEventListener("click", function() {
                                showImgWindow(this.src, this.className);
                                // showImgWindow(this.src, this.className, this.className + 1, this.className -1);

                            });
                            contImgAll[cia].style.cursor = "pointer";
                            contImgAll[cia].className = cia;





                        }
                    }
                }
            }
        }
        viewImgClick();




        let contP = document.querySelectorAll(".view_cont_content p");
        let b;
        for (b = 0; b < contP.length; b++) {
            let contPStyleOrigin = contP[b].getAttribute("style");
            if (contPStyleOrigin == null) {
                contP[b].style.textAlign = "left";
            } else {

            }
        }