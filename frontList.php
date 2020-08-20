<?php
include "bbdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



// echo "<div class='sc_list_area'>    
//         <ul class='sc_list_contain'>";



$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();

$zinTitle = $rowZinNow['title'];
$zinDetail = $rowZinNow['zin_detail'];
// $zinColumn = $rowZinNow['zin_column'];

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing' ORDER BY id DESC LIMIT 1";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$standingZinTitle = $rowStandingZin['title'];
$zin_column = $rowStandingZin['zin_column'];
$zin_color = $rowStandingZin['zin_color'];
$title_color = $rowStandingZin['title_color'];
$point_color = $rowStandingZin['point_color'];
$nav_color = $rowStandingZin['nav_color'];



//****상설매거진****//
//상설매거진 SQL
        
//상설매거진 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY id DESC";
$sqlCatPast = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY created DESC";
$resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


//상설매거진 연재물별 게시물 리스트
if ($resultCatPast->num_rows >= 1) {
    

    echo "
    <div class = 'sc_mega_area'>
        <div class = 'sc_mega_contain'>
            <div id = 'standing_wrap' class = 'mega_title'>
                <h2 class = 'gg-batang front_title_color'>
                    <a href='./frontIntro.php'>
                    ";
    echo               $standingZinTitle;
    echo           "
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
                // echo "sqlRowCatPastCont error";
        } else {
                mysqli_stmt_bind_param($stmt, "s", $rowCatPastCat);
                mysqli_stmt_execute($stmt);
                $resultCatPastCont = mysqli_stmt_get_result($stmt);
        }



        // $rowCatPastCont = ${"rowCatPast".$rowCatPast['category']};
        $rowCatPastCont = $resultCatPastCont->fetch_assoc();
        $latestCatPastCont = $rowCapPastCont['created'];
        
        $catTitlePast = $rowCatPast['category'];
        $sqlContPast = "SELECT * FROM contents WHERE zin!=? AND category=? AND display='on'";
        
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlContPast)) {
                // echo "sqlContPast error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $catTitlePast);
                mysqli_stmt_execute($stmt);
                $resultContPast = mysqli_stmt_get_result($stmt);
        }
        
        
       
        if ($resultContPast->num_rows > 0) {
            $rowContPast = $resultContPast->fetch_assoc();

        echo "
        <li class='mega_box standing_cat'>
        <a  id='{$rowCatPast["id"]}' class='txt cat' name='$catId' onclick = 'frontAllCatShow(this.id, this.name)'>";
        echo "      <div class='mega_box_sub' style='background-image:url(";
        echo '"';
        echo    $rowCatPast['img_dir'];
        echo    '");';
        echo    "'>";
        
        echo '   
        <div class="mega_list_wrap">
        
        <div class="mega_list_title';

        //new indicator//
        $twoWeeksAgo = date("Y-m-d h:i:sa", strtotime('-2 week'));
        echo $latestCatPastCont."<br>";
        echo $twoWeeksAgo."<br>";
        if(strtotime($latestCatPastCont) > $twoWeeksAgo) {
            echo "new";
        }
        //new indicator end//

        echo '">
                        <h2 class="gg-bold">';
        echo $rowCatPast['category'];
        echo '</h2>
        </div>
        <div class="mega_list_auther">
        <p>';
        echo $rowCatPast['author'];
        echo '</p>
        </div>
        </div>
        ';
        
        
        
        echo '
        </div>
        </a>
        </li>
        
        ';
//         echo "</ul>";

// echo "</div>
// </div>";
} 

}
echo "</ul>";

echo "</div>
</div>";
    
    
};
// echo "</ul>";

// echo "</div>
// </div>";
//****과월호 끝****//








//****이번호 연재물(category) 목록****//
// $sqlCatNow = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY id DESC";
$sqlCatNow = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY created DESC";
// $sqlCatNow = "SELECT * FROM thumbs WHERE zin= '$zinTitle' AND display = 'on' ORDER BY author DESC";
// $sqlCatNow = "SELECT * FROM thumbs WHERE publish='now' AND zin= '$zinTitle' AND display = 'on' ORDER BY author DESC";
$resultCatNow = $conn->query($sqlCatNow) or die($conn->error);
// $rowCatNow = $resultCatNow->fetch_assoc();


//이번호 연재물별 게시물 리스트
echo "<div class='sc_list_area'>    
        <ul class='sc_list_contain'>";
if ($resultCatNow->num_rows > 0) {
    // echo "
    //     <div class = 'mega_title'>
    //         <h2 class = 'gg-batang zin_title' title=";
    // echo '"'.$zinDetail.'"';
    // echo">";
    // echo $zinTitle;
    // echo "</h2>
    //     </div>";
    echo "
        <div class = 'mega_title'>
            <h2 id='zinTitle' class = 'gg-batang zin_title front_title_color'>";
    echo        $zinTitle;
    echo"   </h2>
    
        <div id='zinDetail' class='zin_detail front_title_color'>";
    echo    $zinDetail;
    echo "  </div>
        </div>
    
    ";


    // output data of each row
    while($rowCatNow = $resultCatNow->fetch_assoc()) {
        // echo "{$rowCatNow['category']}";
        $catTitle = $rowCatNow['category'];
        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        // $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= '$zinTitle' AND category = '$catTitle' ORDER BY sess*1 DESC LIMIT 2";
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= ? AND category = ? ORDER BY sess*1 DESC LIMIT 2";
        
        
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
        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin=? AND category = ? ORDER BY created DESC LIMIT 1";
        // $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin=? AND category = ? ORDER BY id DESC LIMIT 1";
        

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
        
        if($resultCatNowCont->num_rows >0) {
        echo "
                <div class='category'>
                    <div class='category_list'>
                        <a id='{$rowCatNow["id"]}' class='cat frontCat' name='$catId' onclick='frontCatShow(this.id, this.name)' >";
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
                                </div>
                            </div>                              
                        </a>
                        <ul class="cat_list">
                                            ';


        // if($resultCatNowCont->num_rows > 0) {
            while($rowCatNowCont = $resultCatNowCont->fetch_assoc()) {
                echo "
                            <li class='cat_li'>
                                <a  id = '{$rowCatNowCont['id']}' class = 'cont frontCont' name = '$catId' onclick = 'frontContShow(this.id, this.name)'>
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
                    </div>
                </div>
            
            ';
        }
    
    
    
    
    }

};

echo "  </ul>
    </div>";
    //****이번호 끝****//

    







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
    frontListForm(<?php echo $zin_column; ?>);
window.addEventListener("resize", function() {
    frontListForm(<?php echo $zin_column; ?>);
});

// function frontListColor(bgColor, titleColor, pointColor, navColor) {
//     var bodyBgColor = document.body.style.backgroundColor;
//     var hdAreaBgColor = document.getElementById("bbdd_hd_area").style.backgroundColor;
//     var scAreaBgColor = document.getElementById("bbdd_sc_area").style.backgroundColor;
//     var ftAreaBgColor = document.getElementById("bbdd_ft_area").style.backgroundColor;
//     var navBgColor = document.getElementById("bbdd_nav").style.backgroundColor;

//     bodyBgColor = bgColor;
//     scAreaBgColor = bgColor;
//     ftAreaBgColor = bgColor;

//     hdAreaBgColor = pointColor;

//     navBgColor = navColor;

//     var megaTitleAll = document.querySelectorAll(".mega_title");
//     var mta;
//     for(mta=0; mta < megaTitleAll.length; mta++) {
//         megaTitleAll[mta].style.color = titleColor;
//         megaTitleAll[mta].style.borderBottom = "2px dashed" + titleColor;
//         document.a.style.color = titleColor;
//     }

//     var navCloseBtn = document.querySelectorAll(".close");
//     var ncb;
//     for(ncb=0; ncb < navCloseBtn.length; ncb++) {
//         navCloseBtn[ncb].style.color = pointColor;
//     }

//     var navPortalBtn = document.querySelectorAll(".portal_btn");
//     var npb;
//     for(npb=0; npb < navPortalBtn.length; npb++) {
//         navPortalBtn[npb].style.color = pointColor;
//     }

//     var navMain = document.querySelectorAll(".nav_main");
//     var nMn;
//     for(nMn=0; nMn < navMain.length; nMn++) {
//         navMain[nMn].style.border = "2px dashed" + pointColor;
//     }

//     var navFontColor = document.querySelectorAll(".nav_font");
//     var nfc;
//     for(nfc=0; nfc < navFontColor.length; nfc++) {
//         navFontColor[nfc].color = pointColor;
//     }
// }

// frontListColor("<?php //echo $zin_color; ?>", "<?php //echo $title_color; ?>", "<?php //echo $point_color; ?>", "<?php //echo $nav_color; ?>");

</script>