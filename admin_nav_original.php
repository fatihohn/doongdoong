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
                    <!-- <strong>
                    관리자 모드
                    </strong> -->
                        <div class="close">
                            <a>
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
                                공지사항
                            </a>
                        </li>
                        
<?php


//연재중 연재물 리스트
if ($resultCatNow->num_rows > 0) {
    // output data of each row
    echo '<li class="nav_main_list">';
    echo '<a href = "./admin_index.php" class="gg-batang nav_zin_title" >';
       
    echo $rowZinNow['title'];
    echo '</a>';



    echo "<ul class='nav_sub'>";

    while($rowCatNow = $resultCatNow->fetch_assoc()) {
 
        $catTitle = $rowCatNow['category'];
        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= '$zinTitle' AND category = '$catTitle' ORDER BY sess DESC LIMIT 2";
        $resultCatNowCont = $conn->query($sqlRowCatNowCont) or die($conn->error);
        $rowCatNowCont = ${"rowCatNow".$catTitle};
       
        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        $resultCatOfNowCont = $conn->query($sqlCatOfNowCont) or die($conn->error);
        $rowCatOfNowCont = $resultCatOfNowCont->fetch_assoc();
        $catId = $rowCatOfNowCont['id'];

        if ($resultCatNowCont->num_rows >0) {
        echo '
        <li class="nav_sub_list">
                                        <a id="';
        echo $rowCatNow['id'];
        echo '"name="';
        echo $catId;
        echo '" onclick="adminAllCatShow(this.id, this.name)">
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
if ($resultCatPast->num_rows > 0) {
    echo "
    <li class = 'nav_main_list'>
    <a class = 'gg-title' href = '#'>
    지난호 연재물
    </a>
    <ul class = 'nav_sub'>
    ";
    // output data of each row
    while($rowCatPast = $resultCatPast->fetch_assoc()) {
        // echo "{$rowCatPast['category']}";
        // $sqlRowCatPastCont = ${"sqlContPast".$rowCatPast['category']};
        // $resultCatPastCont = ${"resultContPast".$rowCatPast['category']};
        // $sqlRowCatPastCont = "SELECT * FROM contents WHERE display = 'on' AND category = '{$rowCatPast['category']}' ORDER BY sess DESC LIMIT 3";
        // $resultCatPastCont = $conn->query($sqlRowCatPastCont) or die($conn->error);
        // $rowCatPastCont = ${"rowCatPast".$rowCatPast['category']};
        $catTitlePast = $rowCatPast['category'];
        $sqlContPast = "SELECT * FROM contents WHERE zin!='$zinTitle' AND category='$catTitlePast' AND display='on'";
        $resultContPast = $conn->query($sqlContPast) or die($conn->error);
        // $rowContPast = $resultContPast->fetch_assoc();
        // if ($resultContPast->num_rows > 0) {
            
            //     while($rowContPast = $resultContPast->fetch_assoc()) {
                //         echo '
                //         <li class = "nav_sub_list">
                //             <a id="';
                //         echo $rowCatPast['id'];
                //         echo '" name="';
                //         echo $catId;
                //         echo '" onclick="adminPastCatShow(this.id, this.name)">
                //                 <p>';
                //         echo $rowCatPast['category'];
                //         echo '</p>
                //             </a>
                //         </li>        
                //         ';
                //     }
                // }
                
                if ($resultContPast->num_rows > 0) {

                echo '
                <li class = "nav_sub_list">
                    <a id="';
                echo $rowCatPast['id'];
                echo '" name="';
                echo $catId;
                echo '" onclick="adminAllCatShow(this.id, this.name)">
                        <p>';
                echo $rowCatPast['category'];
                echo '</p>
                    </a>
                </li>        
                ';
                }


    }
    echo "</ul>
        </li>
    
    ";
}



// //내부공개 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE publish='past' AND display='on' ORDER BY author DESC";
// $resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


// $sqlCatPast = "SELECT * FROM thumbs WHERE zin != '$zinTitle' AND display = 'on' ORDER BY author DESC";
$sqlCatOk = "SELECT * FROM thumbs WHERE display = 'ok' OR display = 'on' ORDER BY author DESC";
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
        // echo "{$rowCatOk['category']}";
        // $sqlRowCatOkCont = ${"sqlContPast".$rowCatOk['category']};
        // $resultCatPastCont = ${"resultContPast".$rowCatOk['category']};
        // $sqlRowCatOkCont = "SELECT * FROM contents WHERE display = 'on' AND category = '{$rowCatOk['category']}' ORDER BY sess DESC LIMIT 3";
        // $resultCatPastCont = $conn->query($sqlRowCatOkCont) or die($conn->error);
        // $rowCatOkCont = ${"rowCatOk".$rowCatOk['category']};
        $catTitleOk = $rowCatOk['category'];
        $sqlContOk = "SELECT * FROM contents WHERE zin!='$zinTitle' AND category='$catTitleOk' AND display='on' OR display='ok'";
        $resultContOk = $conn->query($sqlContOk) or die($conn->error);
        // $rowContPast = $resultContOk->fetch_assoc();
        // if ($resultContOk->num_rows > 0) {
            
            //     while($rowContPast = $resultContOk->fetch_assoc()) {
                //         echo '
                //         <li class = "nav_sub_list">
                //             <a id="';
                //         echo $rowCatOk['id'];
                //         echo '" name="';
                //         echo $catId;
                //         echo '" onclick="adminPastCatShow(this.id, this.name)">
                //                 <p>';
                //         echo $rowCatOk['category'];
                //         echo '</p>
                //             </a>
                //         </li>        
                //         ';
                //     }
                // }
                
                if ($resultContOk->num_rows >= 0) {

                echo '
                <li class = "nav_sub_list">
                    <a id="';
                echo $rowCatOk['id'];
                echo '" name="';
                echo $catId;
                echo '" onclick="adminAllCatShow(this.id, this.name)">
                        <p>';
                echo $rowCatOk['category'];
                echo '</p>
                    </a>
                </li>        
                ';
                }


    }
    echo "</ul>
        </li>
    
    ";
}

?>


                        
                    </ul>
                </div>
            </div>
        </div>