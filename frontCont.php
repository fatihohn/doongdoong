<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "bbdd_head.php"; ?>
  
</head>
<body>
        <?php
include 'bbdd_db_conn.php';

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing' ORDER BY id DESC LIMIT 1";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$standingZinTitle = $rowStandingZin['title'];
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


$q = intval($_GET['q']);

$qVal = $_GET['q'];


session_start();


// $sql = "SELECT * FROM contents WHERE id = $q AND display='on' ";
$sql = "SELECT * FROM contents WHERE id = ? AND display='on' ";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sql)) {
    // echo "sql error";
} else {
    mysqli_stmt_bind_param($stmt, "i", $q);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
}

// $result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);
$contCategory = $rows['category'];
$sessThis = $rows['sess'];

// $sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory' AND display = 'on'";
$sqlCatCategory = "SELECT * FROM thumbs WHERE category = ? AND display = 'on'";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sqlCatCategory)) {
    // echo "sqlCatCategory error";
} else {
    mysqli_stmt_bind_param($stmt, "s", $contCategory);
    mysqli_stmt_execute($stmt);
    $resultCatCategory = mysqli_stmt_get_result($stmt);
}


    // $resultCatCategory = $conn->query($sqlCatCategory) or die($conn->error);
    $rowCatCategory = mysqli_fetch_assoc($resultCatCategory);
    $catCategory = $rowCatCategory['category'];
    $catCategoryId = $rowCatCategory['id'];

// $sqlIdMax = "SELECT id FROM contents WHERE display='on' AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
$sqlIdMax = "SELECT id FROM contents WHERE display='on' AND category=? ORDER BY sess*1 DESC LIMIT 1";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sqlIdMax)) {
    // echo "sqlIdMax error";
} else {
    mysqli_stmt_bind_param($stmt, "s", $catCategory);
    mysqli_stmt_execute($stmt);
    $resultIdMax = mysqli_stmt_get_result($stmt);
}


    // $resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
    $rowsIdMax = mysqli_fetch_assoc($resultIdMax);
    $idMax = $rowsIdMax['id'];

// $sqlIdMin = "SELECT id FROM contents WHERE display='on' AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
$sqlIdMin = "SELECT id FROM contents WHERE display='on' AND category=? ORDER BY sess*1 ASC LIMIT 1";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sqlIdMin)) {
    // echo "sqlIdMin error";
} else {
    mysqli_stmt_bind_param($stmt, "s", $catCategory);
    mysqli_stmt_execute($stmt);
    $resultIdMin = mysqli_stmt_get_result($stmt);
}


    // $resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
    $rowsIdMin = mysqli_fetch_assoc($resultIdMin);
    $idMin = $rowsIdMin['id'];

// $sqlNext = "SELECT * FROM contents WHERE id > $q AND display='on' AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
// $sqlNext = "SELECT * FROM contents WHERE id > ? AND display='on' AND category=? ORDER BY sess*1 ASC LIMIT 1";
$sqlNext = "SELECT * FROM contents WHERE sess > ? AND display='on' AND category=? ORDER BY sess*1 ASC LIMIT 1";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
    // echo "sqlNext error";
} else {
    // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
    mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
    mysqli_stmt_execute($stmt);
    $resultNext = mysqli_stmt_get_result($stmt);
}

    // $resultNext = $conn->query($sqlNext) or die($conn->error);


// $sqlPrev = "SELECT * FROM contents WHERE id < $q AND display='on' AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
// $sqlPrev = "SELECT * FROM contents WHERE id < ? AND display='on' AND category=? ORDER BY sess*1 DESC LIMIT 1";
$sqlPrev = "SELECT * FROM contents WHERE sess < ? AND display='on' AND category=? ORDER BY sess*1 DESC LIMIT 1";

$stmt = mysqli_stmt_init($conn);
if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
    // echo "sqlPrev error";
} else {
    // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
    mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
    mysqli_stmt_execute($stmt);
    $resultPrev = mysqli_stmt_get_result($stmt);
}

    // $resultPrev = $conn->query($sqlPrev) or die($conn->error);




if($q < $idMax && $q > $idMin) {
    // $sqlNext = "SELECT * FROM contents WHERE id > $q AND display='on' AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
    // $sqlNext = "SELECT * FROM contents WHERE id > ? AND display='on' AND category=? ORDER BY sess*1 ASC LIMIT 1";
    $sqlNext = "SELECT * FROM contents WHERE sess > ? AND display='on' AND category=? ORDER BY sess*1 ASC LIMIT 1";
    
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
        // echo "sqlNext error";
    } else {
    // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
    mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
    mysqli_stmt_execute($stmt);
    $resultNext = mysqli_stmt_get_result($stmt);
    }
    
        // $resultNext = $conn->query($sqlNext) or die($conn->error);


    // $sqlPrev = "SELECT * FROM contents WHERE id < $q AND display='on' AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
    // $sqlPrev = "SELECT * FROM contents WHERE id < ? AND display='on' AND category=? ORDER BY sess*1 DESC LIMIT 1";
    $sqlPrev = "SELECT * FROM contents WHERE sess < ? AND display='on' AND category=? ORDER BY sess*1 DESC LIMIT 1";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
        // echo "sqlPrev error";
    } else {
        // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
        mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
        mysqli_stmt_execute($stmt);
        $resultPrev = mysqli_stmt_get_result($stmt);
    }

        // $resultPrev = $conn->query($sqlPrev) or die($conn->error);

} else if($q == $idMax && $q > $idMin) {
    
    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory'";
    // $sqlNext = "SELECT * FROM contents WHERE id = ? AND display='on' AND category=?";
    $sqlNext = "SELECT * FROM contents WHERE sess = ? AND display='on' AND category=?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
        // echo "sqlNext error";
    } else {
    // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
    mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
    mysqli_stmt_execute($stmt);
    $resultNext = mysqli_stmt_get_result($stmt);
    }

        // $resultNext = $conn->query($sqlNext) or die($conn->error);

} else if($q == $idMin && $q < $idMax) {
    
    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory'";
    
    $sqlPrev = "SELECT * FROM contents WHERE sess = ? AND display='on' AND category=?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
        // echo "sqlPrev error";
    } else {
        // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
        mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
        mysqli_stmt_execute($stmt);
        $resultPrev = mysqli_stmt_get_result($stmt);
    }

        // $resultPrev = $conn->query($sqlPrev) or die($conn->error);

} else if($q == $idMin && $q == $idMax) {
    
    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory' ";
    // $sqlNext = "SELECT * FROM contents WHERE id = ? AND display='on' AND category=?";
    $sqlNext = "SELECT * FROM contents WHERE sess = ? AND display='on' AND category=?";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
        // echo "sqlNext error";
    } else {
    // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
    mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
    mysqli_stmt_execute($stmt);
    $resultNext = mysqli_stmt_get_result($stmt);
    }

        // $resultNext = $conn->query($sqlNext) or die($conn->error);

    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory' ";
    // $sqlPrev = "SELECT * FROM contents WHERE id = ? AND display='on' AND category=? ";
    $sqlPrev = "SELECT * FROM contents WHERE sess = ? AND display='on' AND category=? ";

    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
        // echo "sqlPrev error";
    } else {
        // mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
        mysqli_stmt_bind_param($stmt, "is", $sessThis, $catCategory);
        mysqli_stmt_execute($stmt);
        $resultPrev = mysqli_stmt_get_result($stmt);
    }

        // $resultPrev = $conn->query($sqlPrev) or die($conn->error);
}




// $resultNext = $conn->query($sqlNext) or die($conn->error);
// $resultPrev = $conn->query($sqlPrev) or die($conn->error);
$rowsNext = mysqli_fetch_assoc($resultNext);
$idNext = $rowsNext['id'];

$rowsPrev = mysqli_fetch_assoc($resultPrev);
$idPrev = $rowsPrev['id'];

$noCont = "noCont";

// if($qVal < $idMax && $qVal > $idMin) {
//     $idNext = $rowsNext['id'];
//     $idPrev = $rowsPrev['id'];
// } else if($qVal == $idMax && $qVal !== $idMin) {
//     $idNext = $noCont;
// } else if($qVal == $idMin && $qVal !== $idMax) {
//     $idPrev = $noCont;
// } else if($qVal == $idMin && $qVal == $idMax) {
//     $idNext = $noCont;
//     $idPrev = $noCont;
// }
if($q < intval($idMax) && $q > intval($idMin)) {
    $idNext = $rowsNext['id'];
    $idPrev = $rowsPrev['id'];
} else if($q == intval($idMax) && $q !== intval($idMin)) {
    $idNext = $noCont;
} else if($q == intval($idMin) && $q !== intval($idMax)) {
    $idPrev = $noCont;
} else if($q == intval($idMin) && $q == intval($idMax)) {
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

        
        
        
        <div class = 'view_cont_sess front_point_color'>
            <?php echo $rows['sess']?>회






        </div>
        <div class = 'view_cont_title'>
            <?php echo $rows['title']?>
        </div>
        <div class = 'gg-batang view_cont_content'>
            <?php echo $rows['content']?>


            <div class='view_author front_point_color'>
                글_<?php echo $rows['author']?>
            </div>
            <div class="func_btn">
                <div class="share_btn" title="공유하기">
                    <!-- <img src="static/img/share.png" alt="공유하기" style="width:40px;"> -->
                    <div class = "share_btn_img" style="width:40px;"></div>
                </div>
            </div>
            <div class = 'view_btn front_point_color'>
                
                <?php 
                
                echo "
                    <div class='view_btn_past $idPrev' id='$idPrev' name='$catCategoryId' onclick='frontContShow(this.id, this.name)'>
                    ←
                    </div>
                    <div class='view_btn_list' id='$catCategoryId' name='$catCategoryId' onclick='frontCatShow(this.id, this.name)'>
                    ≡
                    </div>
                    <div class='view_btn_next $idNext' id='$idNext' name='$catCategoryId' onclick='frontContShow(this.id, this.name)'>
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
    
    frontListColor("rgb(255,255,255)", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    


</script>


</body>
</html>




















    


    

