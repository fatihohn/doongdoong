<!-- <script src="static/js/script.js"></script> -->
<!-- <script src="static/js/contList.js"></script> -->
<!-- <script src="static/js/historyNav.js"></script> -->
<script src="static/js/nav.js"></script>
    <script src="static/js/frontShow.js"></script>
    <script src="static/js/contView.js"></script>
    <script src="static/js/share.js"></script>
    <script>
        let contImgAll = document.querySelectorAll(".view_cont_content img");
        function showImgWindow(str) {
            imgSrc = "https://doongdoong.org/se2/upload/" + str;
            window.open(imgSrc, "imgWindow", "width=1200, height=800");
        }
        let cia;
        for(cia=0; cia < contImgAll.length; cia++) {
            contImgAll[cia].addEventListener("click", function() {showImgWindow(this.title)});
            contImgAll[cia].style.cursor = "pointer";
        }

        function frontListForm(NumberOfColumn) {
            let standingCatAll = document.querySelectorAll(".standing_cat");
            let stc;
            for(stc=0; stc < standingCatAll.length; stc++) {
                standingCatAll[stc].style.width = "calc((100% - 40px) / " + NumberOfColumn + ")";
            }
        }

    </script>