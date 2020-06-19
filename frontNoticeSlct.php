<!DOCTYPE html>
<html lang="ko">
<head>
    <?php include "bbdd_head.php"; ?>
  
</head>
<body>
        <?php
include 'bbdd_db_conn.php';
$q = intval($_GET['q']);
// $r = intval($_GET['r']);
$qVal = $_GET['q'];
// $rVal = $_GET['r'];

session_start();


$sql = "SELECT * FROM zin WHERE id = $q ";
$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);
$zinTitle = $rows['title'];


$sqlIdMax = "SELECT id FROM zin WHERE display='on' AND publish='ready' ORDER BY id DESC LIMIT 1";
$resultIdMax = $conn->query($sqlIdMax) or die($conn->error);
$rowsIdMax = mysqli_fetch_assoc($resultIdMax);
$idMax = $rowsIdMax['id'];

$sqlIdMin = "SELECT id FROM zin WHERE display='on' AND publish='ready' ORDER BY id ASC LIMIT 1";
$resultIdMin = $conn->query($sqlIdMin) or die($conn->error);
$rowsIdMin = mysqli_fetch_assoc($resultIdMin);
$idMin = $rowsIdMin['id'];

$sqlNext = "SELECT * FROM zin WHERE id > $q AND display='on' AND publish='ready' ORDER BY id ASC LIMIT 1";
$sqlPrev = "SELECT * FROM zin WHERE id < $q AND display='on' AND publish='ready' ORDER BY id DESC LIMIT 1";

if($q < $idMax && $q > $idMin) {
    $sqlNext = "SELECT * FROM zin WHERE id > $q AND display='on' AND publish='ready' ORDER BY id ASC LIMIT 1";
    $sqlPrev = "SELECT * FROM zin WHERE id < $q AND display='on' AND publish='ready' ORDER BY id DESC LIMIT 1";
} else if($q == $idMax && $q > $idMin) {
    $sqlNext = "SELECT * FROM zin WHERE id = $q AND display='on' AND publish='ready'";
} else if($q == $idMin && $q < $idMax) {
    $sqlPrev = "SELECT * FROM zin WHERE id = $q AND display='on' AND publish='ready'";
} else if($q ==$idMin && $q == $idMax) {
    $sqlNext = "SELECT * FROM zin WHERE id = $q AND display='on' AND publish='ready' ";
    $sqlPrev = "SELECT * FROM zin WHERE id = $q AND display='on' AND publish='ready' ";
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
        <?php include "front_header.php"; ?>
    </header>

        
    <section id="bbdd_sc">
        <div id="bbdd_sc_wrap">
            <div id="bbdd_sc_area">
                <div class="view_wrap">
                    <div class="view_wrap_line">
                        <div class = 'gg-batang view_cont_content'>
                            <!-- <?php// echo $rows['content']?> -->
<?php
$sqlCat = "SELECT * FROM thumbs WHERE display = 'on'";
$resultCat = $conn->query($sqlCat) or die($conn->error);

if($resultCat->num_rows > 0) {
    while($rowCat = $resultCat->fetch_assoc()) {
        $catTitle = $rowCat['category'];
        $sqlCatZinCont = "SELECT * FROM contents WHERE display = 'on' AND zin = '$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        $resultCatZinCont = $conn->query($sqlCatZinCont) or die($conn->error);
        // $stmt = mysqli_stmt_init($conn);
        // if (!mysqli_stmt_prepare($stmt, $sqlZinCont)) {
        //         // echo "sqlZinCont error";
        // } else {
        //         mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
        //         mysqli_stmt_execute($stmt);
        //         $resultCatZinCont = mysqli_stmt_get_result($stmt);
        // }
        
        $rowCatZinCont = $resultCatZinCont->fetch_assoc();


        echo $zinTitle;
        if($resultCatZinCont->num_rows > 0) {
            echo "
                    <div class='category'>
                        <div class='category_list'>
                            <a id='{$rowCat["id"]}' class='cat frontCat' onclick='frontCatShow(this.id)' >";
            echo "              <div class='cat_img' style=background-image:url(";
            echo '"';
            echo $rowCat['img_dir'];
            echo '");';
            echo "'>";
            echo '
                                    <div class="cat_title">
                                        <h2 class="gg-bold">';
            echo                            $rowCat['category'];
            echo '                      </h2>
                                        <div class="cat_author">
                                            <p>';
            echo                                $rowCat['author'];
            echo '                          </p>
                                        </div>
                                    </div>
                                </div>                              
                            </a>
                            <ul class="cat_list">
                                                ';
    
    
         
                echo '      </ul>
                        </div>
                    </div>
                
                ';
            }
    }
}
?>


                            
                            <div class = 'view_btn'>
                <?php 
                echo "
                                <div class='view_btn_past $idPrev' id='$idPrev'  onclick='frontNoticeSlctShow(this.id)'>
                                ←
                                </div>
                                <div class='view_btn_list'   onclick='frontNoticeShow()'>
                                ≡
                                </div>
                                <div class='view_btn_next $idNext' id='$idNext'  onclick='frontNoticeSlctShow(this.id)'>
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
    <?php include "admin_jsGroup.php"; ?>
<script>
    document.getElementById("bbdd_sc_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.getElementById("bbdd_ft_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.querySelector("body").style.backgroundColor = "rgb(255, 255, 255)";
    



</script>


</body>
</html>




















    


    

