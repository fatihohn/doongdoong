<?php
include "bbdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sqlZinNow)) {
                } else {
                    mysqli_stmt_execute($stmt);
                    $resultZinNow = mysqli_stmt_get_result($stmt);
                }
$rowZinNow = $resultZinNow->fetch_assoc();
$zinTitle = $rowZinNow['title'];
$zinDetail = $rowZinNow['zin_detail'];


$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$zin_Column = $rowStandingZin['zin_column'];


//****과월호****//
//과월호 SQL
        
//과월호 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY id DESC";
$sqlCatPast = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY created DESC";
$resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


//과월호 연재물별 게시물 리스트
if ($resultCatPast->num_rows >= 1) {
    // output data of each row
    echo "
            <div class = 'sc_mega_area'>
                <div class = 'sc_mega_contain'>
                    <div id = 'standing_wrap' class = 'mega_title'>
                        <h2 class = 'gg-batang'>
                            <a href='admin_frontIntro.php'>
                                둥둥
                            </a>
                        </h2>
                    </div>
                    <ul class = 'mega_list'>
            ";
    while($rowCatPast = $resultCatPast->fetch_assoc()) {
        $sqlRowCatPastCont = ${"sqlContPast".$rowCatPast['category']};
        $resultCatPastCont = ${"resultContPast".$rowCatPast['category']};
        $rowCatPastCat = $rowCatPast['category'];

        // $sqlRowCatPastCont = "SELECT * FROM contents WHERE display = 'on' AND category = ? ORDER BY sess*1 DESC LIMIT 3";
        $sqlRowCatPastCont = "SELECT * FROM contents WHERE display = 'on' AND category = ? ORDER BY sess*1 DESC LIMIT 1";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlRowCatPastCont)) {
        } else {
                mysqli_stmt_bind_param($stmt, "s", $rowCatPastCat);
                mysqli_stmt_execute($stmt);
                $resultCatPastCont = mysqli_stmt_get_result($stmt);
        }


        //  $rowCatPastCont = ${"rowCatPast".$rowCatPast['category']};
        $rowCatPastCont = $resultCatPastCont->fetch_assoc();
        $latestCatPastCont = $rowCatPastCont['created'];
        
        $catTitlePast = $rowCatPast['category'];
        $sqlContPast = "SELECT * FROM contents WHERE zin!=? AND category=? AND display='on'";
      
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContPast)) {
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitlePast);
                mysqli_stmt_execute($stmt);
                $resultContPast = mysqli_stmt_get_result($stmt);
        }

       
        if ($resultContPast->num_rows > 0) {
            
            

        echo "
                        <li class='mega_box standing_cat'>
                            <a  id='{$rowCatPast["id"]}' class='txt cat' name='$catId' onclick = 'adminAllCatShow(this.id, this.name)'>";
        echo "                  <div class='mega_box_sub' style='background-image:url(";
        echo                    '"';
        echo                    $rowCatPast['img_dir'];
        echo                    '");';
        echo                    "'>";
        
        echo '   
                                    <div class="mega_list_wrap">
                                        <div class="mega_list_title ';
                                        //new indicator//
                                        $twoWeeksAgo = date("Y-m-d h:i:s", strtotime('-2 week'));
                                        // echo $latestCatPastCont." ";
                                        // echo $twoWeeksAgo." ";

                                        if($latestCatPastCont > $twoWeeksAgo) {
                                            echo "new";
                                        }
                                        //new indicator end//
        echo                        '">
                                            <h2 class="gg-bold">';
        echo                                    $rowCatPast['category'];
        echo '                              </h2>
                                        </div>
                                        <div class="mega_list_auther">
                                            <p>';
        echo                                    $rowCatPast['author'];
        echo '                              </p>
                                        </div>
                                    </div>
        ';
        echo '
                                </div>
                            </a>
                        </li>
        ';
    } 
}
echo "              </ul>";
echo "          </div>
            </div>";
};

//****과월호 끝****//


//****이번호****//
echo "<div class='sc_list_area'>
        <ul class='sc_list_contain'>";

//이번호 연재물(category) 목록
// $sqlCatNow = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY id DESC";
$sqlCatNow = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY created DESC";
$resultCatNow = $conn->query($sqlCatNow) or die($conn->error);




//이번호 연재물별 게시물 리스트
if ($resultCatNow->num_rows > 0) {
    echo "
            <div class = 'mega_title'>
                <h2 id='zinTitle' class = 'gg-batang zin_title'>";
    echo            $zinTitle;
    echo "      </h2>
                <div id='zinDetail' class='zin_detail'>";
    echo            $zinDetail;
    echo "      </div>
            </div>
    
    ";
    // output data of each row
    while($rowCatNow = $resultCatNow->fetch_assoc()) {
        $catTitle = $rowCatNow['category'];

        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= ? AND category = ? ORDER BY sess*1 DESC LIMIT 2";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlRowCatNowCont)) {
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
                mysqli_stmt_execute($stmt);
                $resultCatNowCont = mysqli_stmt_get_result($stmt);
        }
        $rowCatNowCont = ${"rowCatNow".$catTitle};
        
        
        // $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY created DESC LIMIT 1";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCatOfNowCont)) {
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitle);
                mysqli_stmt_execute($stmt);
                $resultCatOfNowCont = mysqli_stmt_get_result($stmt);
        }

        $rowCatOfNowCont = $resultCatOfNowCont->fetch_assoc();
        $catId = $rowCatOfNowCont['id'];
        
        if($resultCatNowCont->num_rows > 0) {
        echo "  <div class='category'>";     
        echo "      <div class='category_list'>";
        echo "
                        <a id='{$rowCatNow["id"]}' class='cat frontCat' name='$catId' onclick='adminAllCatShow(this.id, this.name)' >";
        echo "              <div class='cat_img' style=background-image:url(";
        echo '"';
        echo $rowCatNow['img_dir'];
        echo '");';
        echo "'>";
        echo '
                                <div class="cat_title">
                                    <h2 class="gg-bold">';
        echo                            $rowCatNow['category'];
        echo '                      </h2>
                                    <div class="cat_author">
                                        <p>';
        echo                                $rowCatNow['author'];
        echo '                          </p>
                                    </div>
                                </div>';

        echo '              </div>';

        echo ' 
                        </a>
                        <ul class="cat_list">
                                            ';


            while($rowCatNowCont = $resultCatNowCont->fetch_assoc()) {
                echo "
                            <li class='cat_li ";
                            //new indicator//
                            $latestCatNowCont = $rowCatNowCont['created'];
                            $twoWeeksAgo = date("Y-m-d h:i:s", strtotime('-2 week'));
                            // echo $latestCatNowCont." ";
                            // echo $twoWeeksAgo." ";

                            if($latestCatNowCont > $twoWeeksAgo) {
                                echo "new";
                            }
                            //new indicator end//
                echo "'>
                                <a  id = '{$rowCatNowCont['id']}' class = 'cont frontCont' name = '$catId' onclick = 'adminAllContShow(this.id, this.name)'>
                                    <div class='li_number'>
                                        <p>";
                echo                        $rowCatNowCont['sess'];
                echo '                      회
                                        </p>
                                    </div>
                                    <div class="li_title">
                                        <p>';
                echo                        $rowCatNowCont['title'];
                echo '                  </p>
                                    </div>
                                </a>
                            </li>';

            }
            echo '      </ul>
                    </div>';
            echo '</div>';
        }
    
    
    
    
    }
};
    echo "</ul>";
    echo "        </div>";
//****이번호 끝****//

        








//내부공개 SQL
        
//내부공개 연재물(category) 목록
// $sqlCatOk = "SELECT * FROM thumbs WHERE  display = 'ok' OR display = 'on' ORDER BY id DESC";
if($_SESSION['cast'] == "normal") {
    $sqlCatOk = "SELECT * FROM thumbs WHERE display = 'on' ORDER BY created DESC";
} else {
    $sqlCatOk = "SELECT * FROM thumbs WHERE  display = 'ok' OR display = 'on' ORDER BY created DESC";
}
$resultCatOk = $conn->query($sqlCatOk) or die($conn->error);


//내부공개 연재물별 게시물 리스트
if ($resultCatOk->num_rows > 0) {
    
        echo "
        <div class = 'sc_mega_area'>
            <div class = 'sc_mega_contain'>
                <div class = 'mega_title domestic_title'>
                    <h2 class = 'gg-batang'>내부공개 연재물</h2>
                </div>
                <ul class = 'mega_list'>
    ";
        

    // output data of each row
    while($rowCatOk = $resultCatOk->fetch_assoc()) {
        $sqlRowCatOkCont = ${"sqlContOk".$rowCatOk['category']};
        $resultCatOkCont = ${"resultContOk".$rowCatOk['category']};
        $rowCatOkCat = $rowCatOk['category'];

        // $sqlRowCatOkCont = "SELECT * FROM contents WHERE display = 'on' OR display = 'ok' AND category = ? ORDER BY sess*1 DESC LIMIT 3";
        // $sqlRowCatOkCont = "SELECT * FROM contents WHERE display = 'on' OR display = 'ok' AND category = ? ORDER BY sess*1 DESC LIMIT 1";
        $sqlRowCatOkCont = "SELECT * FROM contents WHERE display != 'off' AND category = ? ORDER BY sess*1 DESC LIMIT 1";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlRowCatOkCont)) {
        } else {
                mysqli_stmt_bind_param($stmt, "s", $rowCatOkCat);
                mysqli_stmt_execute($stmt);
                $resultCatOkCont = mysqli_stmt_get_result($stmt);
        }

        // $rowCatOkCont = ${"rowCatOk".$rowCatOk['category']};
        $rowCatOkCont = $resultCatOkCont->fetch_assoc();
        // $latestCatOkCont = $rowCatOkCont['created'];
        
        $catTitleOk = $rowCatOk['category'];
        
        $sqlContOk = "SELECT * FROM contents WHERE category=? AND display='on' OR display='ok'";

        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContOk)) {
        } else {
                mysqli_stmt_bind_param($stmt, "s", $catTitleOk);
                mysqli_stmt_execute($stmt);
                $resultContOk = mysqli_stmt_get_result($stmt);
        }

       
        if ($resultContOk->num_rows >= 0) {


        echo "
                    <li class='mega_box'>
                        <a  id='{$rowCatOk["id"]}' class='txt cat' name='$catId' onclick = 'adminAllCatShow(this.id, this.name)'>";
        echo "              <div class='mega_box_sub' style='background-image:url(";
        echo                '"';
        echo                $rowCatOk['img_dir'];
        echo                '");';
        echo                "'>";
        
        echo '   
                                <div class="mega_list_wrap">
                                    <div class="mega_list_title ';
                                    //new indicator//
                                    $latestCatOkCont = $rowCatOkCont['created'];
                                    $twoWeeksAgo = date("Y-m-d h:i:s", strtotime('-2 week'));
                                    // echo $latestCatOkCont." ";
                                    // echo $twoWeeksAgo." ";

                                    if($latestCatOkCont > $twoWeeksAgo) {
                                        echo "new";
                                    }
                                    //new indicator end//
        echo '">
                                        <h2 class="gg-bold">';
        echo                                $rowCatOk['category'];
        echo '                          </h2>
                                    </div>
                                    <div class="mega_list_auther">
                                        <p>';
        echo                                $rowCatOk['author'];
        echo '                          </p>
                                    </div>
                                </div>
        ';
        echo '
                            </div>
                        </a>
                    </li>
        ';
        } 
    }
    echo "      </ul>";
    echo "  </div>
        </div>
    ";
};


    
?>
<script>
// if (document.getElementById("zinTitle")) {
//     function showZinDetail() {
        
//         let detailStatus = document.getElementById("zinDetail").style.display;
//         if(detailStatus == "none"){
//                 document.getElementById("zinDetail").style.display = "initial";
//                 document.getElementById("zinTitle").style.paddingBottom = "15px";
                
//         } else {
//                 document.getElementById("zinDetail").style.display = "none";
//                 document.getElementById("zinTitle").style.paddingBottom = "0px";

//         }
//         }
//     }
//     document.getElementById("zinDetail").style.display = "none";
//     document.getElementById("zinTitle").addEventListener("click", showZinDetail);


if (document.querySelector(".standing_cat")) {
    document.getElementById("standing_wrap").style.display = "auto";
} else {
    document.getElementById("standing_wrap").style.display = "none";
}


function frontListForm(NumberOfColumn) {
            let standingCatAll = document.querySelectorAll(".standing_cat");
            let stc;
            for(stc=0; stc < standingCatAll.length; stc++) {
                if(window.innerWidth > 801) {
                    standingCatAll[stc].style.width = "calc((100% - 40px) / " + NumberOfColumn + ")";
                } else if(window.innerWidth <= 801 && window.innerWidth > 481) {
                    standingCatAll[stc].style.width = "calc(100% - 60px)";
                } else {
                    standingCatAll[stc].style.width = "calc(100% - 30px)";
                }
            }
        }

    frontListForm(<?php echo $zin_Column; ?>);
window.addEventListener("resize", function() {
    frontListForm(<?php echo $zin_Column; ?>);
});
        
</script>
