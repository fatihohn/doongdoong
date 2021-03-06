<?php 
include "bbdd_db_conn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// //연재중 연재물(category) 목록


$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();

$zinTitle = $rowZinNow['title'];

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing' ORDER BY id DESC LIMIT 1";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$standingZinTitle = $rowStandingZin['title'];

//연재중 연재물(category) 목록
// $sqlCatNow = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY id DESC";
$sqlCatNow = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY created DESC";
$resultCatNow = $conn->query($sqlCatNow) or die($conn->error);



?>

<div id="bbdd_nav_wrap">
    <div id="bbdd_nav_area">
        <div class="nav_contain">
            <div class="nav_top">
                <div class="close">
                    <a class="gg-title">
                        <!-- × -->
                        <img src="static/img/close.png" alt="닫기">
                    </a>
                </div>
            </div>
            <ul class="nav_main">
                <li class="nav_main_list">
                    <a class="gg-title" class='txt cat' onclick = 'adminIntroShow(this.id)'>
                        변방의 북소리 '둥둥' 소개
                    </a>
                </li>
                <li class="nav_main_list">
                    <a class="gg-title" class='txt cat' onclick = 'adminNoticeShow(this.id)'>
                        지난 매거진 보기
                    </a>
                </li>
                        
<?php
//****지난호****//
// //지난호 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY id DESC";
$sqlCatPast = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY created DESC";
$resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


//지난호 연재물별 게시물 리스트
if ($resultCatPast->num_rows > 0) {
    echo "
                <li id = 'standing_wrap_nav' class = 'nav_main_list'>
                    <a class = 'gg-title' href = '#'>
                        둥둥
                    </a>
                    <ul class = 'nav_sub'>
                    ";

    while($rowCatPast = $resultCatPast->fetch_assoc()) {
        $catTitlePast = $rowCatPast['category'];
        // $sqlContPast = "SELECT * FROM contents WHERE zin!=? AND category=? AND display='on'";
        $sqlContPast = "SELECT * FROM contents WHERE zin=? AND category=? AND display='on'";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContPast)) {
        } else {
                // mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitlePast);
                mysqli_stmt_bind_param($stmt, "ss", $standingZinTitle, $catTitlePast);
                mysqli_stmt_execute($stmt);
                $resultContPast = mysqli_stmt_get_result($stmt);
        }

        
                
                if ($resultContPast->num_rows > 0) {

                echo '
                        <li class = "nav_sub_list standing_cat_nav">
                            <a id="';
                echo        $rowCatPast['id'];
                echo        '" name="';
                echo        $catId;
                echo        '" onclick="adminAllCatShow(this.id, this.name)">
                                <p>';
                echo                $rowCatPast['category'];
                echo '          </p>
                            </a>
                        </li>        
                ';
                }
    }
    echo "          </ul>
                </li>
    
    ";
}
//****지난호 끝****//


//****연재중****//
//연재중 연재물 리스트
if ($resultCatNow->num_rows > 0) {
    // output data of each row
    echo '      <li class="nav_main_list">';
    echo '          <a href = "./admin_index.php" class="gg-title nav_zin_title" >';
    echo                $rowZinNow['title'];
    echo '          </a>';
    echo "          <ul class='nav_sub'>";

    while($rowCatNow = $resultCatNow->fetch_assoc()) {
 
        $catTitle = $rowCatNow['category'];
        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= ? AND category = ? ORDER BY sess DESC LIMIT 2";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlRowCatNowCont)) {
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
                mysqli_stmt_execute($stmt);
                $resultCatNowCont = mysqli_stmt_get_result($stmt);
        }
        
        $rowCatNowCont = ${"rowCatNow".$catTitle};
        // $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin=? AND category = ? ORDER BY id DESC LIMIT 1";
        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin=? AND category = ? ORDER BY created DESC LIMIT 1";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatOfNowCont)) {
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
                mysqli_stmt_execute($stmt);
                $resultCatOfNowCont = mysqli_stmt_get_result($stmt);
        }
        $rowCatOfNowCont = $resultCatOfNowCont->fetch_assoc();
        $catId = $rowCatOfNowCont['id'];

        if ($resultCatNowCont->num_rows >0) {
        echo '
                        <li class="nav_sub_list">
                            <a id="';
        echo                $rowCatNow['id'];
        echo                '"name="';
        echo                $catId;
        echo                '" onclick="adminAllCatShow(this.id, this.name)">
                                <span class="nav_cale">';
        echo                        $rowCatNow['author'];
        echo '                  </span>
                                <p>';
        echo                        $rowCatNow['category'];
        echo '                  </p>
                            </a>
                        </li>
        ';
        }
    }
    echo "          </ul>
                </li>";
}
//****연재중 끝****//





//****내부공개****//
// //내부공개 연재물(category) 목록
$sqlCatOk = "SELECT * FROM thumbs WHERE display = 'ok' OR display = 'on' ORDER BY id DESC";
$resultCatOk = $conn->query($sqlCatOk) or die($conn->error);


//내부공개 연재물별 게시물 리스트
if ($resultCatOk->num_rows > 0) {
    echo "
    <li class = 'nav_main_list'>
    <a class = 'gg-title' href = '#'>
    내부공개 연재물
    </a>
    <ul class = 'nav_sub'>
    ";
    // output data of each row
    while($rowCatOk = $resultCatOk->fetch_assoc()) {
        $catTitleOk = $rowCatOk['category'];
        $sqlContOk = "SELECT * FROM contents WHERE zin!=? AND category=? AND display='on' OR display='ok'";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContOk)) {
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitleOk);
            mysqli_stmt_execute($stmt);
            $resultContOk = mysqli_stmt_get_result($stmt);
        }
        
        
        
        if ($resultContOk->num_rows >= 0) {
            
            echo '
            <li class = "nav_sub_list">
            <a id="';
            echo        $rowCatOk['id'];
            echo        '" name="';
            echo         $catId;
            echo        '" onclick="adminAllCatShow(this.id, this.name)">
            <p>';
            echo                $rowCatOk['category'];
            echo '          </p>
            </a>
            </li>        
            ';
        }
    }
    echo "          </ul>
    </li>
    
    ";
}
//****내부공개 끝****//


?>


                        
                    </ul>
                    <div class="nav_bottom">
                        <div class="portal_btn_wrap">
                            <div class="portal_btn">
                                <a href="index.php">
                                    <img src="static/img/logo.png" alt="둥둥">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>

if (document.querySelector(".standing_cat_nav")) {
    document.getElementById("standing_wrap_nav").style.display = "auto";
} else {
    document.getElementById("standing_wrap_nav").style.display = "none";
}
        </script>