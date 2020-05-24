let adMenu = document.querySelectorAll(".adminMenu");
let adMenuLi = document.querySelector(".adArticle");
// let adMenuLi = document.querySelector(".adminMenuLi");
let adMenuLiDis = adMenuLi.style.display;

let mL;
for(mL = 0; mL < adMenu.length; mL++) {
adMenu[mL].onclick = function() {
    if(adMenuLiDis == "none") {
    adMenuLi.style.display = "initial";
    adMenuLiDis = "initial";
} else if(adMenuLiDis !=="none") {
    adMenuLi.style.display = "none";
    adMenuLiDis = "none";
} else {
    adMenuLi.style.display = "initial";
    adMenuLiDis = "initial";
    }
}
}
function initAdMenu () {
    adMenuLi.style.display = "none";
    adMenuLiDis = "none";
}

initAdMenu();