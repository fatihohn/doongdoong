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
for(a = 0; a < contImgs.length; a++) {
    contImgs[a].parentElement.style.textIndent = "0";
    contImgs[a].style.maxWidth = "100%";
    contImgs[a].style.height = "auto";
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

if(document.getElementById("img_slide")) {
    var imgNumber = document.getElementById("img_slide").className;
}

let contP = document.querySelectorAll(".view_cont_content p");
let b;
for(b=0; b < contP.length; b++) {
let contPStyleOrigin = contP[b].getAttribute("style");
if(contPStyleOrigin == null) {
    contP[b].style.textAlign = "left";
} else {

}
}