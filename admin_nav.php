<?php 
include "bbdd_db_conn.php";

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// //연재중 연재물(category) 목록


$publishNow = "now";
$displayOn = "on";
$displayOk = "ok";
$id = "id";
$author = "author";
// $sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$sqlZinNow = "SELECT * FROM zin WHERE publish=? AND display = ? ORDER BY ? DESC LIMIT 1";

$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlZinNow)) {
                echo "sqlZinNow error";
        } else {
                mysqli_stmt_bind_param($stmt, "ssi", $publishNow, $displayOn, $id);
                mysqli_stmt_execute($stmt);
                $resultZinNow = mysqli_stmt_get_result($stmt);
                $rowZinNow = mysqli_fetch_assoc($resultZinNow);
                // mysqli_stmt_close();
        }

// $resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
// $rowZinNow = $resultZinNow->fetch_assoc();

$zinTitle = $rowZinNow['title'];

//연재중 연재물(category) 목록
// $sqlCatNow = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY author DESC";
$sqlCatNow = "SELECT * FROM thumbs WHERE display = ? ORDER BY ? DESC";

$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatNow)) {
                echo "sqlCatNow error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $displayOn, $author);
                mysqli_stmt_execute($stmt);
                $resultCatNow = mysqli_stmt_get_result($stmt);
        }
// $resultCatNow = $conn->query($sqlCatNow) or die($conn->error);



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

    // while($rowCatNow = $resultCatNow->fetch_assoc()) {
    while($rowCatNow = mysqli_fetch_assoc($resultCatNow)) {
        $sess = "sess";
        $catTitle = $rowCatNow['category'];
        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        // $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= '$zinTitle' AND category = '$catTitle' ORDER BY sess DESC LIMIT 2";
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = ?  AND zin= ? AND category = ? ORDER BY ? DESC LIMIT 2";
        $stmt = mysqli_stmt_init($conn);
	        if (!mysqli_stmt_prepare($stmt, $sqlRowCatNowCont)) {
	        		echo "sqlRowCatNowCont error";
	        } else {
			mysqli_stmt_bind_param($stmt, "ssss", $displayOn, $zinTitle, $catTitle, $sess);
			mysqli_stmt_execute($stmt);
			$resultCatNowCont = mysqli_stmt_get_result($stmt);
            $rowCatNowCont = ${"rowCatNow".$catTitle};
			// mysqli_stmt_close();
	}
        // $resultCatNowCont = $conn->query($sqlRowCatNowCont) or die($conn->error);
        // $rowCatNowCont = ${"rowCatNow".$catTitle};
       
        // $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display=? AND zin=? AND category = ? ORDER BY ? DESC LIMIT 1";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatOfNowCont)) {
                echo "sqlCatOfNowCont error";
        } else {
        mysqli_stmt_bind_param($stmt, "ssss", $displayOn, $zinTitle, $catTitle, $id);
        mysqli_stmt_execute($stmt);
        $resultCatOfNowCont = mysqli_stmt_get_result($stmt);
        $rowCatOfNowCont = mysqli_fetch_assoc($resultCatOfNowCont);
        // mysqli_stmt_close();
}
        // $resultCatOfNowCont = $conn->query($sqlCatOfNowCont) or die($conn->error);
        // $rowCatOfNowCont = $resultCatOfNowCont->fetch_assoc();
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
// $sqlCatPast = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY author DESC";
$sqlCatPast = "SELECT * FROM thumbs WHERE display = ? ORDER BY ? DESC";

$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatPast)) {
                echo "sqlCatPast error";
        } else {
        mysqli_stmt_bind_param($stmt, "ss", $displayOn, $author);
        mysqli_stmt_execute($stmt);
        $resultCatPast = mysqli_stmt_get_result($stmt);
        // mysqli_stmt_close();
}


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
    // while($rowCatPast = $resultCatPast->fetch_assoc()) {
    while($rowCatPast = mysqli_fetch_assoc($resultCatPast)) {
       
        $catTitlePast = $rowCatPast['category'];
        // $sqlContPast = "SELECT * FROM contents WHERE zin!='$zinTitle' AND category='$catTitlePast' AND display='on'";
        $sqlContPast = "SELECT * FROM contents WHERE zin!=? AND category=? AND display=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContPast)) {
                echo "sqlContPast error";
        } else {
        mysqli_stmt_bind_param($stmt, "sss", $zinTitle, $catTitlePast, $displayOn);
        mysqli_stmt_execute($stmt);
        $resultContPast = mysqli_stmt_get_result($stmt);
        // mysqli_stmt_close();
}
        // $resultContPast = $conn->query($sqlContPast) or die($conn->error);
        
                
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
// $sqlCatOk = "SELECT * FROM thumbs WHERE display = 'ok' OR display = 'on' ORDER BY author DESC";
$sqlCatOk = "SELECT * FROM thumbs WHERE display = ? OR display = ? ORDER BY ? DESC";
$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatOk)) {
                echo "sqlCatOk error";
        } else {
        mysqli_stmt_bind_param($stmt, "sss", $displayOk, $displayOn, $author);
        mysqli_stmt_execute($stmt);
        $resultCatOk = mysqli_stmt_get_result($stmt);
        // mysqli_stmt_close();
}
// $resultCatOk = $conn->query($sqlCatOk) or die($conn->error);




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
    // while($rowCatOk = $resultCatOk->fetch_assoc()) {
    while($rowCatOk = mysqli_fetch_assoc($resultCatOk)) {
       
        $catTitleOk = $rowCatOk['category'];
        // $sqlContOk = "SELECT * FROM contents WHERE zin!='$zinTitle' AND category='$catTitleOk' AND display='on' OR display='ok'";
        $sqlContOk = "SELECT * FROM contents WHERE zin!=? AND category=? AND display=? OR display=?";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContOk)) {
                echo "sqlContOk error";
        } else {
        mysqli_stmt_bind_param($stmt, "ssss", $zinTitle, $catTitleOk, $displayOn, $displayOk);
        mysqli_stmt_execute($stmt);
        $resultContOk = mysqli_stmt_get_result($stmt);
        // mysqli_stmt_close();
}
        
        
        
        $resultContOk = $conn->query($sqlContOk) or die($conn->error);
       
                
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