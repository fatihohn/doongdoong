function fadeOut(el) {
    el.style.opacity = 1;

    (function fade() {
        if ((el.style.opacity -= .1) < 0) {
            el.style.display = "none";
        } else {
            requestAnimationFrame(fade);
        }
    })();
};

function fadeIn(el, display) {
    el.style.opacity = 0;
    el.style.display = display || "block";

    (function fade() {
        let val = parseFloat(el.style.opacity);
        if (!((val += .1) > 1)) {
            el.style.opacity = val;
            requestAnimationFrame(fade);
        }
    })();
};


function adMenuOpen() {
    document.getElementById("bbdd_body").setAttribute("class", "blur");
    // document.getElementById("body_bg").fadeIn(200);
    // document.getElementById("bbdd_ad_menu").animate({
    //     right: 0
    // }, 200);
    fadeIn(document.getElementById("body_bg"), "block");
    document.getElementById("bbdd_ad_menu").style.right = "0px";
    document.getElementById("bbdd_ad_menu").style.animation = "navIn 0.3s";
}

function adMenuClose() {
    fadeOut(document.getElementById("body_bg"));
    document.getElementById("bbdd_body").removeAttribute("class");
    document.getElementById("bbdd_ad_menu").style.right = "-100%";
    document.getElementById("bbdd_ad_menu").style.animation = "navOut 0.3s";
}
document.querySelector(".hd_ad_menu > a").addEventListener("click", adMenuOpen);
document.querySelector(".adClose > a").addEventListener("click", adMenuClose);
document.querySelector("#body_bg").addEventListener("click", adMenuClose);