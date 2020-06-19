<!DOCTYPE html>
<html lang="ko">
<head>
    <?php include "admin_head.php"; ?>
  
</head>
<body>
        <?php
include 'bbdd_db_conn.php';
$q = intval($_GET['q']);
// $r = intval($_GET['r']);
$qVal = $_GET['q'];
// $rVal = $_GET['r'];

session_start();
// $sql = "SELECT * FROM contents WHERE id = $q AND display='on' AND publish='now'";
// 개발중



// $sqlCatCategory = "SELECT * FROM thumbs WHERE id = $r AND display = 'on' AND publish = 'now'";
// $resultCatCategory = $conn->query($sqlCatCategory) or die($conn->error);
// $rowCatCategory = mysqli_fetch_assoc($resultCatCategory);
// $catCategory = $rowCatCategory['category'];
// $catCategoryId = $rowCatCategory['id'];

$sql = "SELECT * FROM notice WHERE id = $q ";
// $sql = "SELECT * FROM notice WHERE id = $q AND display='on' AND category='$catCategory'";
$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);
// $contCategory = $rows['category'];

// $sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory' AND display = 'on'";
// // $sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory' AND display = 'on' AND publish = 'now'";
// $resultCatCategory = $conn->query($sqlCatCategory) or die($conn->error);
// $rowCatCategory = mysqli_fetch_assoc($resultCatCategory);
// $catCategory = $rowCatCategory['category'];
// // $catCategoryZin = $rowCatCategory['zin'];
// $catCategoryId = $rowCatCategory['id'];

$sqlIdMax = "SELECT id FROM notice WHERE display='on' AND category='notice' OR (display='ok' AND category='notice') ORDER BY id DESC LIMIT 1";
// $sqlIdMax = "SELECT MAX(id) FROM notice WHERE display='on' AND category='notice' OR (display='ok' AND category='notice')";
$resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
$rowsIdMax = mysqli_fetch_assoc($resultIdMax);
$idMax = $rowsIdMax['id'];

$sqlIdMin = "SELECT id FROM notice WHERE display='on' AND category='notice' OR (display='ok' AND category='notice') ORDER BY id ASC LIMIT 1";
// $sqlIdMin = "SELECT MIN(id) FROM notice WHERE display='on' AND category='notice' OR (display='ok' AND category='notice')";
$resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
$rowsIdMin = mysqli_fetch_assoc($resultIdMin);
$idMin = $rowsIdMin['id'];

$sqlNext = "SELECT * FROM notice WHERE id > $q AND display='on' AND category='notice' OR (display='ok' AND category='notice') ORDER BY id ASC LIMIT 1";
$sqlPrev = "SELECT * FROM notice WHERE id < $q AND display='on' AND category='notice' OR (display='ok' AND category='notice') ORDER BY id DESC LIMIT 1";

if($q < $idMax && $q > $idMin) {
    $sqlNext = "SELECT * FROM notice WHERE id > $q AND display='on' AND category='notice' OR (display='ok' AND category='notice') ORDER BY id ASC LIMIT 1";
    $sqlPrev = "SELECT * FROM notice WHERE id < $q AND display='on' AND category='notice' OR (display='ok' AND category='notice') ORDER BY id DESC LIMIT 1";
} else if($q == $idMax && $q > $idMin) {
    // $sqlNext = "";
    $sqlNext = "SELECT * FROM notice WHERE id = $q AND display='on' AND category='notice' OR (display='ok' AND category='notice')";
} else if($q == $idMin && $q < $idMax) {
    // $sqlPrev = "";
    $sqlPrev = "SELECT * FROM notice WHERE id = $q AND display='on' AND category='notice' OR (display='ok' AND category='notice')";
} else if($q ==$idMin && $q == $idMax) {
    // $sqlNext = "";
    // $sqlPrev = "";
    $sqlNext = "SELECT * FROM notice WHERE id = $q AND display='on' AND category='notice' OR (display='ok' AND category='notice') ";
    $sqlPrev = "SELECT * FROM notice WHERE id = $q AND display='on' AND category='notice' OR (display='ok' AND category='notice') ";
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
        <?php include "admin_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">


<div class="view_wrap">
    <div class="view_wrap_line">

        
        
        
        <div class = 'view_cont_sess'>
            <?php echo $rows['title']?>






        </div>
       
        <div class = 'gg-batang view_cont_content'>
            <?php echo $rows['content']?>


            <div class='view_author'>
                에디터_<?php echo $rows['author']?>
                <div class = 'cs_box_front'>
                <!-- <button class="view_btn1" onclick="location.href='./admin_modify_cont.php'">수정</button> -->
                <button class="front_btn" name="<?=$rows['id']?>" onclick="notiModi(this.name)">수정</button>
                <button class="front_btn" name="<?=$rows['id']?>" onclick="notiDel(this.name)">삭제</button>
                <!-- <div class="front_btn" name="<?=$rows['id']?>" onclick="contModi(this.name)">수정</div>
                <div class="front_btn" name="<?=$rows['id']?>" onclick="contDel(this.name)">삭제</div> -->
                </div>
            </div>
            <div class = 'view_btn'>
                
                <?php 
                
                echo "
                    <div class='view_btn_past $idPrev' id='$idPrev'  onclick='adminNoticeSlctShow(this.id)'>
                    ←
                    </div>
                    <div class='view_btn_list'   onclick='adminNoticeShow()'>
                    ≡
                    </div>
                    <div class='view_btn_next $idNext' id='$idNext'  onclick='adminNoticeSlctShow(this.id)'>
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
            <!-- <div id="bbdd_ft_wrap">
                <div id="bbdd_ft_area">
                    <div class="ft_con">
                        <p class="gg-title">
                            COPYRIGHT 2020 변방의북소리.
                        </p>
                    </div>
                </div>
            </div> -->
            <?php include "footer.php";?>
        </footer>
        
    </div>
    <nav id="bbdd_nav">
        <?php include "admin_nav.php"; ?>
    </nav>
    <div id="body_bg"></div>
    <?php include "jsGroup.php"; ?>
    <?php include "admin_jsGroup.php"; ?>
<script>
    document.getElementById("bbdd_sc_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.getElementById("bbdd_ft_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.querySelector("body").style.backgroundColor = "rgb(255, 255, 255)";
    



</script>


</body>
</html>




















    


    

