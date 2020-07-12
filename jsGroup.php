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
            imgSrc = "https://doongdoong.org/" + str;
            window.open(imgSrc, "imgWindow", "width=1200, height=800");
        }
        let cia;
        for(cia=0; cia < contImgAll.length; cia++) {
            contImgAll[cia].addEventListener("click", function() {showImgWindow(this.title)});
        }
    </script>