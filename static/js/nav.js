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


function navOpen() {
    document.getElementById("bbdd_body").setAttribute("class", "blur");
    // document.getElementById("body_bg").fadeIn(200);
    // document.getElementById("bbdd_nav").animate({
    //     right: 0
    // }, 200);
    fadeIn(document.getElementById("body_bg"), "block");
    document.getElementById("bbdd_nav").style.right = "0px";
    document.getElementById("bbdd_nav").style.animation = "navIn 0.3s";
}

function navClose() {
    fadeOut(document.getElementById("body_bg"));
    document.getElementById("bbdd_body").removeAttribute("class");
    document.getElementById("bbdd_nav").style.right = "-100%";
    document.getElementById("bbdd_nav").style.animation = "navOut 0.3s";
}
document.querySelector(".hd_menu > a").addEventListener("click", navOpen);
document.querySelector(".close > a").addEventListener("click", navClose);
document.querySelector("#body_bg").addEventListener("click", navClose);