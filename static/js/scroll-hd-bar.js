let lastScrollTop = 0;
// element should be replaced with the actual target element on which you have applied scroll, use window in case of no target element.
window.addEventListener("scroll", function(){ // or window.addEventListener("scroll"....
   let st = window.pageYOffset || document.documentElement.scrollTop; // Credits: "https://github.com/qeremy/so/blob/master/so.dom.js#L426"
   let bdHeader = document.getElementById("bbdd_hd_area");
   let bdFooter = document.getElementById("bbdd_ft");
   if (st > lastScrollTop){
      // downscroll code
      bdHeader.style.top = "-100%";
      bdHeader.style.animation = "hdOut 0.8s";
      // bdFooter.style.display = "none";
      
      
   } else {
      // upscroll code
      // let bdHeader = document.getElementById("bbdd_hd_area");
      bdHeader.style.top = "0px";
      bdHeader.style.animation = "hdIn 0.2s";
      // bdFooter.style.display = "initial";
   }
   lastScrollTop = st <= 0 ? 0 : st; // For Mobile or negative scrolling
}, false);

