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

$sql = "SELECT * FROM contents WHERE id = $q ";
// $sql = "SELECT * FROM contents WHERE id = $q AND display='on' OR (id = $q AND display='ok')";
// $sql = "SELECT * FROM contents WHERE id = $q AND display='on' AND category='$catCategory' OR (display='ok' AND category='$catCategory')";
$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);
$contCategory = $rows['category'];

$sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory'";
// $sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory' AND display = 'on' OR ( category = '$contCategory' AND display = 'ok')";
// $sqlCatCategory = "SELECT * FROM thumbs WHERE category = '$contCategory' AND display = 'on' AND publish = 'now'";
$resultCatCategory = $conn->query($sqlCatCategory) or die($conn->error);
$rowCatCategory = mysqli_fetch_assoc($resultCatCategory);
$catCategory = $rowCatCategory['category'];
// $catCategoryZin = $rowCatCategory['zin'];
$catCategoryId = $rowCatCategory['id'];



$adminCast = "admin";
$editorCast = "editor";
$authorCast = "author";

$uname = $_SESSION['username'];

// $sql = "SELECT * FROM zin ORDER BY id DESC";






// $sqlIdMax = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
// // $sqlIdMax = "SELECT id FROM contents WHERE display='on' AND category='$catCategory' OR (display='ok' AND category='$catCategory') ORDER BY sess*1 DESC LIMIT 1";
// // $sqlIdMax = "SELECT MAX(id) FROM contents WHERE display='on' AND category='$catCategory' OR (display='ok' AND category='$catCategory')";
// $resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
// $rowsIdMax = mysqli_fetch_assoc($resultIdMax);
// $idMax = $rowsIdMax['id'];

// $sqlIdMin = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
// // $sqlIdMin = "SELECT id FROM contents WHERE display='on' AND category='$catCategory' OR (display='ok' AND category='$catCategory') ORDER BY sess*1 ASC LIMIT 1";
// // $sqlIdMin = "SELECT MIN(id) FROM contents WHERE display='on' AND category='$catCategory' OR (display='ok' AND category='$catCategory')";
// $resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
// $rowsIdMin = mysqli_fetch_assoc($resultIdMin);
// $idMin = $rowsIdMin['id'];

// $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
// $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";

// if($q < $idMax && $q > $idMin) {
//     $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
//     $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
// } else if($q == $idMax && $q > $idMin) {
//     // $sqlNext = "";
//     $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
// } else if($q == $idMin && $q < $idMax) {
//     // $sqlPrev = "";
//     $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
// } else if($q ==$idMin && $q == $idMax) {
//     // $sqlNext = "";
//     // $sqlPrev = "";
//     $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
//     $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
// }


if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다.");
                            history.back();
                            </script>
    <?php   }
            //cast: admin인 경우
            else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {
                
                // $sql = "SELECT * FROM contents ORDER BY id DESC";
                $sqlIdMax = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                $sqlIdMin = "SELECT id FROM contents WHERE category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                $resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
$rowsIdMax = mysqli_fetch_assoc($resultIdMax);
$idMax = $rowsIdMax['id'];

$resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
$rowsIdMin = mysqli_fetch_assoc($resultIdMin);
$idMin = $rowsIdMin['id'];


                if($qVal < $idMax && $qVal > $idMin) {
                // if($q < $idMax && $q > $idMin) {
                    $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' ORDER BY sess*1 ASC LIMIT 1";
                    $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' ORDER BY sess*1 DESC LIMIT 1";
                } else if($qVal == $idMax && $qVal > $idMin) {
                // } else if($q == $idMax && $q > $idMin) {
                    // $sqlNext = "";
                    $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
                } else if($qVal == $idMin && $qVal < $idMax) {
                // } else if($q == $idMin && $q < $idMax) {
                    // $sqlPrev = "";
                    $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
                } else if($qVal ==$idMin && $qVal == $idMax) {
                // } else if($q ==$idMin && $q == $idMax) {
                    // $sqlNext = "";
                    // $sqlPrev = "";
                    $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
                    $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
                }
                
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']==$authorCast) {
                
                // $sql = "SELECT * FROM contents WHERE display='on' OR display='ok' OR username='$uname' ORDER BY id DESC";
                $sqlIdMax = "SELECT id FROM contents WHERE category='$catCategory' AND display='on' OR (category='$catCategory' AND display='ok') OR (category='$catCategory' AND username='$uname') ORDER BY sess*1 DESC LIMIT 1";
                $sqlIdMin = "SELECT id FROM contents WHERE category='$catCategory' AND display='on' OR (category='$catCategory' AND display='ok') OR (category='$catCategory' AND username='$uname') ORDER BY sess*1 ASC LIMIT 1";
                $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 ASC LIMIT 1";
                $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 DESC LIMIT 1";
                $resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
$rowsIdMax = mysqli_fetch_assoc($resultIdMax);
$idMax = $rowsIdMax['id'];

$resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
$rowsIdMin = mysqli_fetch_assoc($resultIdMin);
$idMin = $rowsIdMin['id'];
                
                if($qVal < $idMax && $qVal > $idMin) {
                // if($q < $idMax && $q > $idMin) {
                    $sqlNext = "SELECT * FROM contents WHERE id > $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 ASC LIMIT 1";
                    $sqlPrev = "SELECT * FROM contents WHERE id < $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname') ORDER BY sess*1 DESC LIMIT 1";
                    
                } else if($qVal == $idMax && $qVal > $idMin) {
                // } else if($q == $idMax && $q > $idMin) {
                    // $sqlNext = "";
                    $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname')";
                    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
                } else if($qVal == $idMin && $qVal < $idMax) {
                // } else if($q == $idMin && $q < $idMax) {
                    // $sqlPrev = "";
                    $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname')";
                    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory'";
                } else if($qVal == $idMin && $qVal == $idMax) {
                // } else if($q == $idMin && $q == $idMax) {
                    // $sqlNext = "";
                    // $sqlPrev = "";
                    $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id > $q AND category='$catCategory' AND display='ok') OR (id > $q AND category='$catCategory' AND username='$uname')";
                    $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' AND display='on' OR (id < $q AND category='$catCategory' AND display='ok') OR (id < $q AND category='$catCategory' AND username='$uname')";
                    // $sqlNext = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
                    // $sqlPrev = "SELECT * FROM contents WHERE id = $q AND category='$catCategory' ";
                }
            
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']!==$authorCast) {
                
               
                ?>              <script>
                alert("권한이 없습니다.");
                history.back();
                </script>
                <?php
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
// } else if( $idNext==null) {
} else if($qVal == $idMax && $qVal !== $idMin || $idNext==null) {
    $idNext = $noCont;
// } else if($idPrev==null) {
} else if($qVal == $idMin && $qVal !== $idMax || $idPrev==null) {
    $idPrev = $noCont;
} else if($qVal == $idMin && $qVal == $idMax ) {
    $idNext = $noCont;
    $idPrev = $noCont;
} else if ($idNext==null && $idPrev==null) {
    $idNext = $noCont;
    $idPrev = $noCont;
}
// if($q < $idMax && $q > $idMin) {
//     $idNext = $rowsNext['id'];
//     $idPrev = $rowsPrev['id'];
// // } else if( $idNext==null) {
// } else if($q == $idMax && $q !== $idMin || $idNext==null) {
//     $idNext = $noCont;
// // } else if($idPrev==null) {
// } else if($q == $idMin && $q !== $idMax || $idPrev==null) {
//     $idPrev = $noCont;
// } else if($q == $idMin && $q == $idMax ) {
//     $idNext = $noCont;
//     $idPrev = $noCont;
// } else if ($idNext==null && $idPrev==null) {
//     $idNext = $noCont;
//     $idPrev = $noCont;
// }

// // } else {
// //         $idNext = $noCont;
// //         $idPrev = $noCont;

// // }
// if($q < $idMax && $q > $idMin) {
// // if($qVal < $idMax && $qVal > $idMin) {
//     $idNext = $rowsNext['id'];
//     $idPrev = $rowsPrev['id'];
// } else if($idNext==null) {
// // } else if($qVal == $idMax && $qVal !== $idMin || $idNext==null) {
//     $idNext = $noCont;
// } else if($idPrev==null) {
// // } else if($qVal == $idMin && $qVal !== $idMax || $idPrev==null) {
//     $idPrev = $noCont;
// } else {
//         $idNext = $noCont;
//         $idPrev = $noCont;
// }



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
            <?php echo $rows['sess']?>회


           




        </div>
        <div class = 'view_cont_title'>
            <?php echo $rows['title']?>
        </div>
        <div class = 'gg-batang view_cont_content'>
            <?php echo $rows['content']?>

            <div class='view_author'>
                글_<?php echo $rows['author']?>
                <div class = 'cs_box_front'>
                <!-- <button class="view_btn1" onclick="location.href='./admin_modify_cont.php'">수정</button> -->
                <button class="front_btn" name="<?=$rows['id']?>" onclick="contModi(this.name)">수정</button>
                <button class="front_btn" name="<?=$rows['id']?>" onclick="contDel(this.name)">삭제</button>
                <!-- <div class="front_btn" name="<?=$rows['id']?>" onclick="contModi(this.name)">수정</div>
                <div class="front_btn" name="<?=$rows['id']?>" onclick="contDel(this.name)">삭제</div> -->
                </div>
            </div>

            <div class = 'view_btn'>
                
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