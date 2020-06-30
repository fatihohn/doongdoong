function shareBtnClick() {
    // let shareBtn = document.getElementById("share_btn");
    let shareBtn = document.querySelectorAll(".share_btn");
    function shareThings() {
        let urlBox = document.createElement('input');
        let currentUrl = window.location.href;

        document.body.appendChild(urlBox);
        urlBox.value = currentUrl;
        urlBox.select();
        document.execCommand('copy');
        document.body.removeChild(urlBox);
        alert("링크가 복사되었습니다.")
    }
    let sb;
    for(sb=0; sb < shareBtn.length; sb++) {
        if(shareBtn) {
            shareBtn[sb].addEventListener("click", shareThings);
        }
    }
}
shareBtnClick();