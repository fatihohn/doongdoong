<?php 
include "bbdd_db_conn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// //연재중 연재물(category) 목록

// $sqlCatNow = "SELECT * FROM thumbs WHERE publish='now' AND display='on' ORDER BY author DESC";
// $resultCatNow = $conn->query($sqlCatNow) or die($conn->error);

$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();

$zinTitle = $rowZinNow['title'];
// $zinTitle = mysqli_real_escape_string($conn, $zinTitle);

//연재중 연재물(category) 목록
// $sqlCatNow = "SELECT * FROM thumbs WHERE publish='now' AND zin= '$zinTitle' AND display = 'on' ORDER BY author DESC";
$sqlCatNow = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY author DESC";
// $sqlCatNow = "SELECT * FROM thumbs WHERE zin= '$zinTitle' AND display = 'on' ORDER BY author DESC";
$resultCatNow = $conn->query($sqlCatNow) or die($conn->error);



?>

<div id="bbdd_nav_wrap">
            <div id="bbdd_nav_area">
                <div class="nav_contain">
                    <div class="nav_top">
                        <div class="close">
                            <a>
                                <img src="static/img/close.png" alt="닫기">
                            </a>
                        </div>
                    </div>
                    <ul class="nav_main">
                        <li class="nav_main_list">
                            <a class="gg-title" class='txt cat' onclick = 'frontIntroShow(this.id)'>
                                변방의 북소리 '둥둥' 소개
                            </a>
                        </li>
                        <li class="nav_main_list">
                            <a class="gg-title" class='txt cat' onclick = 'frontNoticeShow(this.id)'>
                                공지사항
                            </a>
                        </li>
                        
<?php


//연재중 연재물 리스트
if ($resultCatNow->num_rows > 0) {
    // output data of each row
    echo '<li class="nav_main_list">';
    echo '<a href = "./" class="gg-batang nav_zin_title" >';
       
    echo $rowZinNow['title'];
    echo '</a>';



    echo "<ul class='nav_sub'>";

    while($rowCatNow = $resultCatNow->fetch_assoc()) {
 
        $catTitle = $rowCatNow['category'];
        // $catTitle = mysqli_real_escape_string($conn, $catTitle);

        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        // $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= '$zinTitle' AND category = '$catTitle' ORDER BY sess DESC LIMIT 2";
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= ? AND category = ? ORDER BY sess DESC LIMIT 2";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlRowCatNowCont)) {
                // echo "sqlRowCatNowCont error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
                mysqli_stmt_execute($stmt);
                $resultCatNowCont = mysqli_stmt_get_result($stmt);
        }
        
        
        // $resultCatNowCont = $conn->query($sqlRowCatNowCont) or die($conn->error);
        $rowCatNowCont = ${"rowCatNow".$catTitle};
       
        // $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin=? AND category = ? ORDER BY id DESC LIMIT 1";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatOfNowCont)) {
                // echo "sqlCatOfNowCont error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
                mysqli_stmt_execute($stmt);
                $resultCatOfNowCont = mysqli_stmt_get_result($stmt);
        }



        // $resultCatOfNowCont = $conn->query($sqlCatOfNowCont) or die($conn->error);
        $rowCatOfNowCont = $resultCatOfNowCont->fetch_assoc();
        $catId = $rowCatOfNowCont['id'];
        if ($resultCatNowCont->num_rows >0) {
        echo '
        <li class="nav_sub_list">
                                        <a id="';
        echo $rowCatNow['id'];
        echo '"name="';
        echo $catId;
        echo '" onclick="frontCatShow(this.id, this.name)">
                                            <span class="nav_cale">';
        echo $rowCatNow['author'];
        echo '</span>
                                            <p>';
        echo $rowCatNow['category'];
        echo '</p>
                                        </a>
                                    </li>
        ';
        }


    }
    echo "</ul></li>";
}

// //지난호 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE publish='past' AND display='on' ORDER BY author DESC";
// $resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


// $sqlCatPast = "SELECT * FROM thumbs WHERE zin != '$zinTitle' AND display = 'on' ORDER BY author DESC";
$sqlCatPast = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY author DESC";
$resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


//지난호 연재물별 게시물 리스트
if ($resultCatPast->num_rows >= 1) {
    // echo "
    // <li class = 'nav_main_list'>
    // <a class = 'gg-title' href = '#'>
    // 지난호 연재물
    // </a>
    // <ul class = 'nav_sub'>
    // ";
    // output data of each row


    echo "
                    <li id = 'standing_wrap_nav' class = 'nav_main_list'>
                    <a class = 'gg-title' href = '#'>
                    변방의 북소리
                    </a>
                    <ul class = 'nav_sub'>
                    ";

    while($rowCatPast = $resultCatPast->fetch_assoc()) {
        // echo "{$rowCatPast['category']}";
        // $sqlRowCatPastCont = ${"sqlContPast".$rowCatPast['category']};
        // $resultCatPastCont = ${"resultContPast".$rowCatPast['category']};
        // $sqlRowCatPastCont = "SELECT * FROM contents WHERE display = 'on' AND category = '{$rowCatPast['category']}' ORDER BY sess DESC LIMIT 3";
        // $resultCatPastCont = $conn->query($sqlRowCatPastCont) or die($conn->error);
        // $rowCatPastCont = ${"rowCatPast".$rowCatPast['category']};
        $catTitlePast = $rowCatPast['category'];
        // $catTitlePast = mysqli_real_escape_string($conn, $catTitlePast);

        // $sqlContPast = "SELECT * FROM contents WHERE zin!='$zinTitle' AND category='$catTitlePast' AND display='on'";
        $sqlContPast = "SELECT * FROM contents WHERE zin!=? AND category=? AND display='on'";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContPast)) {
                // echo "sqlContPast error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitlePast);
                mysqli_stmt_execute($stmt);
                $resultContPast = mysqli_stmt_get_result($stmt);
        }
        
        
        // $resultContPast = $conn->query($sqlContPast) or die($conn->error);
        
                
                if ($resultContPast->num_rows > 0) {
                    // echo "
                    // <li class = 'nav_main_list'>
                    // <a class = 'gg-title' href = '#'>
                    // 변방의 북소리
                    // </a>
                    // <ul class = 'nav_sub'>
                    // ";

                echo '
                <li class = "nav_sub_list standing_cat_nav">
                    <a id="';
                echo $rowCatPast['id'];
                echo '" name="';
                echo $catId;
                echo '" onclick="frontAllCatShow(this.id, this.name)">
                        <p>';
                echo $rowCatPast['category'];
                echo '</p>
                    </a>
                </li>        
                ';
                
        //         echo "</ul>
        // </li>
    
    // ";
                }


    }
    echo "</ul>
        </li>
    
    ";
}

?>
                          
                        </li>
                        
                    </ul>
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