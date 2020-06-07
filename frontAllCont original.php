<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "bbdd_head.php"; ?>
  
</head>
<body>
        <?php
include 'bbdd_db_conn.php';
$q = intval($_GET['q']);
$qVal = $_GET['q'];

session_start();

$sql = "SELECT * FROM contents WHERE id = $q AND display='on' ";
$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);
$contCategory = $rows['category'];

$sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory' AND display = 'on'";
$resultCatCategory = $conn->query($sqlCatCategory) or die($conn->error);
$rowCatCategory = mysqli_fetch_assoc($resultCatCategory);
$catCategory = $rowCatCategory['category'];
$catCategoryId = $rowCatCategory['id'];

$sqlIdMax = "SELECT id FROM contents WHERE display='on' AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
$resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
$rowsIdMax = mysqli_fetch_assoc($resultIdMax);
$idMax = $rowsIdMax['id'];

$sqlIdMin = "SELECT id FROM contents WHERE display='on' AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";

$resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
$rowsIdMin = mysqli_fetch_assoc($resultIdMin);
$idMin = $rowsIdMin['id'];

$sqlNext = "SELECT * FROM contents WHERE id > $q AND display='on' AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
$sqlPrev = "SELECT * FROM contents WHERE id < $q AND display='on' AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";

if($q < $idMax && $q > $idMin) {
    $sqlNext = "SELECT * FROM contents WHERE id > $q AND display='on' AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
    $sqlPrev = "SELECT * FROM contents WHERE id < $q AND display='on' AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
} else if($q == $idMax && $q > $idMin) {
    
    $sqlNext = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory'";
} else if($q == $idMin && $q < $idMax) {
    
    $sqlPrev = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory'";
} else if($q ==$idMin && $q == $idMax) {
    
    $sqlNext = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory' ";
    $sqlPrev = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory' ";
}




$resultNext = $conn->query($sqlNext) or die($conn->error);
$rowsNext = mysqli_fetch_assoc($resultNext);
$idNext = $rowsNext['id'];

$resultPrev = $conn->query($sqlPrev) or die($conn->error);
$rowsPrev = mysqli_fetch_assoc($resultPrev);
$idPrev = $rowsPrev['id'];

$noCont = "noCont";

if($qVal < $idMax && $qVal > $idMin) {
    $idNext = $rowsNext['id'];
    $idPrev = $rowsPrev['id'];
} else if($qVal == $idMax && $qVal !== $idMin) {
    $idNext = $noCont;
} else if($qVal == $idMin && $qVal !== $idMax) {
    $idPrev = $noCont;
} else if($qVal == $idMin && $qVal == $idMax) {
    $idNext = $noCont;
    $idPrev = $noCont;
}



?>
    <div id="bbdd_body">
        <header id="bbdd_hd">
            <div id="bbdd_hd_wrap">
                <div id="bbdd_hd_area" style="transform: translate3d(0px, 0px, 0px); position: fixed; top: 0px;">
                    <div class="hd_contain">
                        <div class="hd_zin gg-batang">
                          
                                <?php 
                                
                                echo $rows['zin'];
                                ?>
                        </div>
                        <div class="hd_logo">
                            <a href="./">
                            <img src="static/img/logo.png" alt="변방둥둥">
                            </a>
                        </div>
                        <div class="hd_menu">
                            <a>
                                <img src="static/img/menu-bar.png" alt="메뉴바">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">


<div class="view_wrap">
    <div class="view_wrap_line">

        
        
        
        <div class = 'view_cont_sess'>
            <?php echo $rows['sess']?>회







        </div>
        <div class = 'view_cont_title'>
            <?php echo $rows['title']?>
        </div>
        <div class = 'gg-batang view_cont_content'>
            <?php echo $rows['content']?>

            <div class='view_author'>
                글_<?php echo $rows['author']?>
            </div>

            <div class = 'view_btn'>
                
                <?php 
                
                echo "
                    <div class='view_btn_past $idPrev' id='$idPrev' name='$catCategoryId' onclick='frontAllContShow(this.id, this.name)'>
                    ←
                    </div>
                    <div class='view_btn_list' id='$catCategoryId' name='$catCategoryId' onclick='frontAllCatShow(this.id, this.name)'>
                    ≡
                    </div>
                    <div class='view_btn_next $idNext' id='$idNext' name='$catCategoryId' onclick='frontAllContShow(this.id, this.name)'>
                    →
                    </div>
                
                
                
                    ";
                    
                    ?>
                    
            </div>
        </div>
    </div>
</div>


        </div>
    </div>
</section>


        <footer id="bbdd_ft">
        
            <?php include "footer.php";?>
        </footer>
        
    </div>
    <nav id="bbdd_nav">
        <?php include "nav.php"; ?>
    </nav>
    <div id="body_bg"></div>
    <?php include "jsGroup.php"; ?>
<script>
    document.getElementById("bbdd_sc_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.getElementById("bbdd_ft_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.querySelector("body").style.backgroundColor = "rgb(255, 255, 255)";
    



</script>


</body>
</html>




















    


    
