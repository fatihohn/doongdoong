<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "admin_head.php"; ?>
  
</head>
<body>
   

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

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
// $zin_column = $rowStandingZin['zin_column'];
// $zin_color = $rowStandingZin['zin_color'];
// $title_color = $rowStandingZin['title_color'];
// $point_color = $rowStandingZin['point_color'];
// $nav_color = $rowStandingZin['nav_color'];

$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();
$zin_column = $rowZinNow['zin_column'];
$zin_color = $rowZinNow['zin_color'];
$title_color = $rowZinNow['title_color'];
$point_color = $rowZinNow['point_color'];
$nav_color = $rowZinNow['nav_color'];


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
                    <h2>게시물 목록</h2>
                </center>
            </div>

            <div id="adCsList">
                <div class="cs_box">
                    <button class="view_btn1" onclick="location.href='./admin_create_cont.php'">게시물 작성</button>
                    
                    <select name="searchSlct" id="searchSlct">
                        <option value="0">번호</option>
                        <option value="1">작가</option>
                        <option value="2">연재물</option>
                        <option value="3">회차</option>
                        <option value="4">매거진</option>
                        <option value="5">제목</option>
                        <option value="7">공개상태</option>
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
                <table class="cs_table sortTable cont_table">
                <?php include 'admin_contSelect.php'; ?>
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
    
    <?php include "jsGroup.php"; ?>
    <?php include "admin_jsGroup.php"; ?>
    <script>
        
    
        admin_frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
        
        </script>
</div>

</body>
</html>