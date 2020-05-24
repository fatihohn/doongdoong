<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "admin_head.php"; ?>
  
</head>
<body>
    <!-- <div id="bbdd_body">
        <header id="bbdd_hd">
           <?php 
        //    include "admin_header.php"; 
        ?>
        </header> -->

<!-- <article class="adArticle  adminMenu"> -->
<?php 
        // include 'admin_article.php'; 
        ?>

    <!-- </article> -->

    <div id="bbdd_body">
        <header id="bbdd_hd">
           <?php include "admin_header.php"; ?>
        </header>
        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <!-- <div class="sc_contain">
                <div class="sc_list_area"> -->
                    <!-- <ul class="sc_list_contain"> -->
                    <!-- <ul class="sc_list_con"> -->
                    <div class="view_wrap">
    <div class="view_wrap_line">
        <div class="admin_table">
            
<?php
include 'bbdd_db_conn.php';   
session_start();
$URL = "./admin_index.php";
            if(!isset($_SESSION['username'])) {
            // if($_SESSION['cast']=="normal" || $_SESSION['cast']=="author") {
    ?>              <script>
                            alert("권한이 없습니다.");
                            location.replace("<?php echo $URL?>");
                    </script>

    <?php  
          
            }
            else {
        ?>
            <div>
                <center>
                    <h2>연재물 목록</h2>
                </center>
            </div>

            <div id="adCsList">
                <div class="cs_box">
                    <button class="view_btn1" onclick="location.href='./admin_create_thumbs.php'">연재물 만들기</button>
                    <select name="searchSlct" id="searchSlct">
                        <option value="0">번호</option>
                        <option value="1">연재 작가</option>
                        <option value="2">연재물 제목</option>
                        <option value="3">공개상태</option>
                        <option value="4">연재상태</option>
                    </select>
                    <input type="text" class="searchInput" id="searchInput" onkeyup="searchInput(this.name)" placeholder="검색">
                
                <script>
                    function searchSet() {
                    let searchSlct = document.getElementById("searchSlct").value;
                    let searchInpt = document.getElementById("searchInput");
                    searchInpt.setAttribute("name", searchSlct);
                    }

                    document.getElementById("searchSlct").addEventListener("change", searchSet);
                    // searchSet();

                </script>
                </div>
                <div id="includeTable">
                <table class="cs_table sortTable thumbs_table">
                <?php include 'admin_thumbsSelect.php'; ?>
                </table>
                </div>
                <div id="tableBox"></div>

                <?php
            }
            ?>
<br>
<br>
            </div>

        </div>
                           
                
                <!-- </ul>
                </div> -->
                
            </div>
            </div>
        </div>
    
</section>


        <footer id="bbdd_ft">
            <!-- <div id="bbdd_ft_wrap">
                <div id="bbdd_ft_area">
                    <div class="ft_contain">
                        <p class="gg-batang">
                            COPYRIGHT 2020 변방의북소리.
                        </p>
                    </div>
                </div>
            </div> -->

            <?php include "admin_footer.php";?>
        </footer>
        
    </div>
    <nav id="bbdd_nav">
        <?php include "admin_nav.php"; ?>
    </nav>

    
    <div id="body_bg"></div>
    
    
</div>
<?php include "jsGroup.php"; ?>
<?php include "admin_jsGroup.php"; ?>
<!-- <script>
    let displayOn = document.querySelectorAll(".on");
    let i;
    for (i=0; i < displayOn.length; i++) {
        let dpOn = displayOn[i].innerHTML.replace("on", "외부발행");
        displayOn[i].innerHTML = dpOn;
    }
    let displayOk = document.querySelectorAll(".ok");
    let j;
    for (j=0; j < displayOk.length; j++) {
        let dpOk = displayOk[j].innerHTML.replace("ok", "내부공개");
        displayOk[j].innerHTML = dpOk;
    }
    let displayOff = document.querySelectorAll(".off");
    let k;
    for (k=0; k < displayOff.length; k++) {
        let dpOff = displayOff[k].innerHTML.replace("off", "비공개");
        displayOff[k].innerHTML = dpOff;
    }
</script> -->

</body>
</html>