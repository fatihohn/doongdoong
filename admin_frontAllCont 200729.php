<!DOCTYPE html>
<html lang="ko">
<head>
  <?php include "admin_head.php"; ?>
  
</head>
<body>
        <?php
include 'bbdd_db_conn.php';

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing' ORDER BY id DESC LIMIT 1";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$standingZinTitle = $rowStandingZin['title'];
$zin_column = $rowStandingZin['zin_column'];
$zin_color = $rowStandingZin['zin_color'];
$title_color = $rowStandingZin['title_color'];
$point_color = $rowStandingZin['point_color'];
$nav_color = $rowStandingZin['nav_color'];




$q = intval($_GET['q']);

$qVal = $_GET['q'];


session_start();



$sql = "SELECT * FROM contents WHERE id = $q ";

$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);
$contCategory = $rows['category'];

// $sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory'";
$sqlCatCategory = "SELECT * FROM thumbs WHERE category = ?";

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



$adminCast = "admin";
$editorCast = "editor";
$authorCast = "author";

$uname = $_SESSION['username'];




if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다.");
                            history.back();
                            </script>
    <?php   }
            //cast: admin인 경우
            else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
            
                
                // $sqlIdMax = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                // $sqlIdMin = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                // $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                // $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                
                // $sqlIdMax = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                $sqlIdMax = "SELECT id FROM contents WHERE category=? ORDER BY sess*1 DESC LIMIT 1";
                
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
                


                // $sqlIdMin = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                $sqlIdMin = "SELECT id FROM contents WHERE category=? ORDER BY sess*1 ASC LIMIT 1";

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

                // $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                $sqlNext = "SELECT * FROM contents WHERE id > ? AND category=? ORDER BY sess*1 ASC LIMIT 1";
                
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                    // echo "sqlNext error";
                } else {
                    mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                    mysqli_stmt_execute($stmt);
                    $resultNext = mysqli_stmt_get_result($stmt);
                }
                
                // $resultNext = $conn->query($sqlNext) or die($conn->error);
                
                // $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                $sqlPrev = "SELECT * FROM contents WHERE id < ? AND category=? ORDER BY sess*1 DESC LIMIT 1";

                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                    // echo "sqlPrev error";
                } else {
                    mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                    mysqli_stmt_execute($stmt);
                    $resultPrev = mysqli_stmt_get_result($stmt);
                }


                // $resultPrev = $conn->query($sqlPrev) or die($conn->error);


                if($qVal < $idMax && $qVal > $idMin) {
            
                    // $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                    $sqlNext = "SELECT * FROM contents WHERE id > ? AND category=? ORDER BY sess*1 ASC LIMIT 1";
                    
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }
                    
                    // $resultNext = $conn->query($sqlNext) or die($conn->error);
                    
                    
                    
                    // $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                    $sqlPrev = "SELECT * FROM contents WHERE id < ? AND category=? ORDER BY sess*1 DESC LIMIT 1";
                    
                    $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                    // echo "sqlPrev error";
                } else {
                    mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                    mysqli_stmt_execute($stmt);
                    $resultPrev = mysqli_stmt_get_result($stmt);
                }
                    
                    // $resultPrev = $conn->query($sqlPrev) or die($conn->error);


                } else if($qVal == $idMax && $qVal > $idMin) {
              
                    
                    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
                    $sqlNext = "SELECT * FROM contents WHERE id = ? AND category=?";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }

                    // $resultNext = $conn->query($sqlNext) or die($conn->error);

                } else if($qVal == $idMin && $qVal < $idMax) {
              
                    
                    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
                    $sqlPrev = "SELECT * FROM contents WHERE id = ? AND category=?";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                        // echo "sqlPrev error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                        mysqli_stmt_execute($stmt);
                        $resultPrev = mysqli_stmt_get_result($stmt);
                    }

                // $resultPrev = $conn->query($sqlPrev) or die($conn->error);
                } else if($qVal ==$idMin && $qVal == $idMax) {
              
                    
                    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
                    $sqlNext = "SELECT * FROM contents WHERE id = ? AND category=? ";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }

                    // $resultNext = $conn->query($sqlNext) or die($conn->error);

                    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
                    $sqlPrev = "SELECT * FROM contents WHERE id = ? AND category=? ";

                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                        // echo "sqlPrev error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "is", $q, $catCategory);
                        mysqli_stmt_execute($stmt);
                        $resultPrev = mysqli_stmt_get_result($stmt);
                    }

                // $resultPrev = $conn->query($sqlPrev) or die($conn->error);
                }
                
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']==$authorCast) {
                
               
                // $sqlIdMax = "SELECT id FROM contents WHERE category='$catCategory' AND display='on' OR (category='$catCategory' AND display='ok') OR (category='$catCategory' AND username='$uname') ORDER BY sess*1 DESC LIMIT 1";
                // $sqlIdMax = "SELECT id FROM contents WHERE category=? AND display='?category=? AND display='?(category=? AND username=?) ORDER BY sess*1 DESC LIMIT 1";
                $sqlIdMax = "SELECT id FROM contents WHERE category=? AND display='on' OR (category=? AND display='ok') OR (category=? AND username=?) ORDER BY sess*1 DESC LIMIT 1";
                
                $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlIdMax)) {
                        // echo "sqlIdMax error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssss", $catCategory, $catCategory, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultIdMax = mysqli_stmt_get_result($stmt);
                    }
                
                
                // $resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
                $rowsIdMax = mysqli_fetch_assoc($resultIdMax);
                $idMax = $rowsIdMax['id'];

                // $sqlIdMin = "SELECT id FROM contents WHERE category='$catCategory' AND display='on' OR (category='$catCategory' AND display='ok') OR (category='$catCategory' AND username='$uname') ORDER BY sess*1 ASC LIMIT 1";
                // $sqlIdMin = "SELECT id FROM contents WHERE category=? AND display='?OR (category=? AND display='?OR (category=? AND username=?) ORDER BY sess*1 ASC LIMIT 1";
                $sqlIdMin = "SELECT id FROM contents WHERE category=? AND display='on' OR (category=? AND display='ok') OR (category=? AND username=?) ORDER BY sess*1 ASC LIMIT 1";
                
                $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlIdMin)) {
                        // echo "sqlIdMin error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "ssss", $catCategory, $catCategory, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultIdMin = mysqli_stmt_get_result($stmt);
                    }
                
                // $resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
                $rowsIdMin = mysqli_fetch_assoc($resultIdMin);
                $idMin = $rowsIdMin['id'];

                // $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 ASC LIMIT 1";
                $sqlNext = "SELECT * FROM contents WHERE id > ? AND category=? AND display='on' OR (id > ? AND category=? AND display='ok') OR (id > ? AND category=? AND username=?) ORDER BY sess*1 ASC LIMIT 1";
                
                $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }
                
                // $resultNext = $conn->query($sqlNext) or die($conn->error);

                // $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 DESC LIMIT 1";
                $sqlPrev = "SELECT * FROM contents WHERE id < ? AND category=? AND display='on' OR (id < ? AND category=? AND display='ok') OR (id < ? AND category=? AND username=?) ORDER BY sess*1 DESC LIMIT 1";
                
                $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                        // echo "sqlPrev error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultPrev = mysqli_stmt_get_result($stmt);
                    }
                
                // $resultPrev = $conn->query($sqlPrev) or die($conn->error);
                
                if($qVal < $idMax && $qVal > $idMin) {
               
                    
                    // $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 ASC LIMIT 1";
                    $sqlNext = "SELECT * FROM contents WHERE id > ? AND category=? AND display='on' OR (id > ? AND category=? AND display='ok') OR (id > ? AND category=? AND username=?) ORDER BY sess*1 ASC LIMIT 1";
                    
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }
                    
                    // $resultNext = $conn->query($sqlNext) or die($conn->error);
                    
                    // $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 DESC LIMIT 1";
                    $sqlPrev = "SELECT * FROM contents WHERE id < ? AND category=? AND display='on' OR (id < ? AND category=? AND display='ok') OR (id < ? AND category=? AND username=?) ORDER BY sess*1 DESC LIMIT 1";
                    
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                        // echo "sqlPrev error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultPrev = mysqli_stmt_get_result($stmt);
                    }
                    
                    // $resultPrev = $conn->query($sqlPrev) or die($conn->error);

                } else if($qVal == $idMax && $qVal > $idMin) {
        
                    
                    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname')";
                    $sqlNext = "SELECT * FROM contents WHERE id = ? AND category=? AND display='on' OR (id > ? AND category=? AND display='ok') OR (id > ? AND category=? AND username=?)";
                    
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }
                    
                    // $resultNext = $conn->query($sqlNext) or die($conn->error);
                    
                } else if($qVal == $idMin && $qVal < $idMax) {
             
                    
                    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname')";
                    $sqlPrev = "SELECT * FROM contents WHERE id = ? AND category=? AND display='on' OR (id < ? AND category=? AND display='ok') OR (id < ? AND category=? AND username=?)";
         
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                        // echo "sqlPrev error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultPrev = mysqli_stmt_get_result($stmt);
                    }

                    // $resultPrev = $conn->query($sqlPrev) or die($conn->error);
                    
                } else if($qVal == $idMin && $qVal == $idMax) {
            
                    
                    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname')";
                    $sqlNext = "SELECT * FROM contents WHERE id = ? AND category=? AND display='on' OR (id > ? AND category=? AND display='ok') OR (id > ? AND category=? AND username=?)";
                    
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlNext)) {
                        // echo "sqlNext error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultNext = mysqli_stmt_get_result($stmt);
                    }
                    
                    // $resultNext = $conn->query($sqlNext) or die($conn->error);

                    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname')";
                    $sqlPrev = "SELECT * FROM contents WHERE id = ? AND category=? AND display='on' OR (id < ? AND category=? AND display='ok') OR (id < ? AND category=? AND username=?)";
                    
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sqlPrev)) {
                        // echo "sqlPrev error";
                    } else {
                        mysqli_stmt_bind_param($stmt, "isisiss", $q, $catCategory, $q, $catCategory, $q, $catCategory, $uname);
                        mysqli_stmt_execute($stmt);
                        $resultPrev = mysqli_stmt_get_result($stmt);
                    }
                    
                    // $resultPrev = $conn->query($sqlPrev) or die($conn->error);
                    
                }
            
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']!==$authorCast) {
                
               
                ?>              <script>
                alert("권한이 없습니다.");
                history.back();
                </script>
                <?php
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
// // } else if( $idNext==null) {
// } else if($qVal == $idMax && $qVal !== $idMin || $idNext==null) {
//     $idNext = $noCont;
// // } else if($idPrev==null) {
// } else if($qVal == $idMin && $qVal !== $idMax || $idPrev==null) {
//     $idPrev = $noCont;
// } else if($qVal == $idMin && $qVal == $idMax ) {
//     $idNext = $noCont;
//     $idPrev = $noCont;
// } else if ($idNext==null && $idPrev==null) {
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
        <?php include "admin_header.php"; ?>
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
                <div class = 'cs_box_front'>
                
                <button class="front_btn" name="<?=$rows['id']?>" onclick="contModi(this.name)">수정</button>
                <button class="front_btn" name="<?=$rows['id']?>" onclick="contDel(this.name)">삭제</button>
                </div>
            </div>

            <div class = 'view_btn front_point_color'>
                
                <?php 
                
                echo "
                    <div class='view_btn_past $idPrev' id='$idPrev' name='$catCategoryId' onclick='adminAllContShow(this.id)'>
                    ←
                    </div>
                    <div class='view_btn_list' id='$catCategoryId' name='$catCategoryId' onclick='adminAllCatShow(this.id, this.name)'>
                    ≡
                    </div>
                    <div class='view_btn_next $idNext' id='$idNext' name='$catCategoryId' onclick='adminAllContShow(this.id)'>
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
        <?php include "admin_nav.php"; ?>
    </nav>
    <div id="body_bg"></div>
    <?php include "jsGroup.php"; ?>
    <?php include "admin_jsGroup.php"; ?>
<script>
    document.getElementById("bbdd_sc_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.getElementById("bbdd_ft_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.querySelector("body").style.backgroundColor = "rgb(255, 255, 255)";
    
    frontListColor("rgb(255,255,255)", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    


</script>


</body>
</html>