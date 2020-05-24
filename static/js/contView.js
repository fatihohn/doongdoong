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