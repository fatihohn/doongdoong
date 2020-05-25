<?php
include "bbdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}




$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();

$zinTitle = $rowZinNow['title'];
$zinDetail = $rowZinNow['zin_detail'];

//이번호 연재물(category) 목록
$sqlCatNow = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY author DESC";
// $sqlCatNow = "SELECT * FROM thumbs WHERE zin= '$zinTitle' AND display = 'on' ORDER BY author DESC";
// $sqlCatNow = "SELECT * FROM thumbs WHERE publish='now' AND zin= '$zinTitle' AND display = 'on' ORDER BY author DESC";
$resultCatNow = $conn->query($sqlCatNow) or die($conn->error);
// $rowCatNow = $resultCatNow->fetch_assoc();


//이번호 연재물별 게시물 리스트
if ($resultCatNow->num_rows > 0) {
    echo "
        <div class = 'mega_title'>
            <h2 class = 'gg-batang zin_title' title='";
    echo $zinDetail;
    echo"'>";
    echo $zinTitle;
    echo "</h2>
        </div>";
    // output data of each row
    while($rowCatNow = $resultCatNow->fetch_assoc()) {
        // echo "{$rowCatNow['category']}";
        $catTitle = $rowCatNow['category'];
        $sqlRowCatNowCont = ${"sqlContNow".$catTitle};
        $resultCatNowCont = ${"resultContNow".$catTitle};
        $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on'  AND zin= '$zinTitle' AND category = '$catTitle' ORDER BY sess*1 DESC LIMIT 2";
        // $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on' AND publish='now' AND zin= '$zinTitle' AND category = '$catTitle' ORDER BY sess*1 DESC LIMIT 2";
        $resultCatNowCont = $conn->query($sqlRowCatNowCont) or die($conn->error);
        $rowCatNowCont = ${"rowCatNow".$catTitle};
        // $sqlRowCatNowCont = ${"sqlContNow".$rowCatNow['category']};
        // $resultCatNowCont = ${"resultContNow".$rowCatNow['category']};
        // $sqlRowCatNowCont = "SELECT * FROM contents WHERE display = 'on' AND publish='now' AND zin= '$zinTitle' AND category = '{$rowCatNow['category']}' ORDER BY sess*1 DESC LIMIT 2";
        // $resultCatNowCont = $conn->query($sqlRowCatNowCont) or die($conn->error);
        // $rowCatNowCont = ${"rowCatNow".$rowCatNow['category']};

        $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        // $sqlCatOfNowCont = "SELECT * FROM thumbs WHERE display='on' AND publish='now' AND zin='$zinTitle' AND category = '$catTitle' ORDER BY id DESC LIMIT 1";
        $resultCatOfNowCont = $conn->query($sqlCatOfNowCont) or die($conn->error);
        $rowCatOfNowCont = $resultCatOfNowCont->fetch_assoc();
        $catId = $rowCatOfNowCont['id'];
        
        if($resultCatNowCont->num_rows >0) {
        echo "
        <div class='category'>
        
        
          
                                
                                    <div class='category_list'>
                                        <a id='{$rowCatNow["id"]}' class='cat frontCat' name='$catId' onclick='frontCatShow(this.id, this.name)' >";
                                        // <a href='#' id='{$rowCatNow["id"]}' class='txt frontCat' onclick = 'frontCatList(this.id)'>";
        echo "<div class='cat_img' style=background-image:url(";
        echo '"';
        echo $rowCatNow['img_dir'];
        echo '");';
        echo "'>";
        echo '
        <div class="cat_title">
            <h2 class="gg-bold">';
        echo $rowCatNow['category'];
        echo '</h2>

                <div class="cat_author">
                    <p>';
        echo $rowCatNow['author'];
        echo '</p>
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
                echo $rowCatNowCont['sess'];
                echo '회</p>
                                                            </div>
                                                            <div class="li_title">
                                                                <p>';
                echo $rowCatNowCont['title'];
                echo '</p>
                                                            </div>
                                                        
                                                    </a>
                </li>';

            }
            echo '</ul>
            </div>
            </div>
            
            ';
        }
    
    
    
    
    }

};

echo "</ul>
        </div>";

        


// //완결 SQL
        
// //완결 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE publish='past' AND display = 'on' ORDER BY author DESC";
// // $sqlCatPast = "SELECT * FROM thumbs WHERE publish='past' OR zin != '$zinTitle' AND display = 'on' ORDER BY author DESC";
// $resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


// //완결 연재물별 게시물 리스트
// if ($resultCatPast->num_rows > 0) {
//     echo "
//     <div class = 'sc_mega_area'>
//         <div class = 'sc_mega_con'>
//             <div class = 'mega_title'>
//                 <h2 class = 'sm3-kk'>완결 연재물</h2>
//             </div>
//     <ul class = 'mega_list'>
//     ";
//     // output data of each row
//     while($rowCatPast = $resultCatPast->fetch_assoc()) {
//         // echo "{$rowCatPast['category']}";
//         $sqlRowCatPastCont = ${"sqlContPast".$rowCatPast['category']};
//         $resultCatPastCont = ${"resultContPast".$rowCatPast['category']};
//         $sqlRowCatPastCont = "SELECT * FROM contents WHERE display = 'on' AND category = '{$rowCatPast['category']}' ORDER BY sess*1 DESC LIMIT 3";
//         $resultCatPastCont = $conn->query($sqlRowCatPastCont) or die($conn->error);
//         $rowCatPastCont = ${"rowCatPast".$rowCatPast['category']};
        
//         echo "
//         <li class='mega_box'>
//         <a  id='{$rowCatPast["id"]}' class='txt cat' name='$catId' onclick = 'frontCatShow(this.id, this.name)'>";
//         // <a  id='{$rowCatPast["id"]}' class='txt cat' name='$catId' onclick = 'frontPastCatShow(this.id, this.name)'>";
//         echo "      <div class='mega_box_sub' style='background-image:url(";
//         echo '"';
//         echo    $rowCatPast['img_dir'];
//         echo    '");';
//         echo    "'>";
        
//         echo '   
//         <div class="mega_list_wrap">
        
//         <div class="mega_list_title">
//                         <h2 class="gg-bold">';
//         echo $rowCatPast['category'];
//         echo '</h2>
//         </div>
//         <div class="mega_list_auther">
//         <p>';
//         echo $rowCatPast['author'];
//         echo '</p>
//         </div>
//         </div>
//         ';
        
        
        
//         echo '
//         </div>
//         </a>
//         </li>
        
//         ';
        
        
        
//     }
    
    
// };
// echo "</ul>";

// echo "</div>
// </div>";




//과월호 SQL
        
//과월호 연재물(category) 목록
// $sqlCatPast = "SELECT * FROM thumbs WHERE publish='past' AND display = 'on' ORDER BY author DESC";
// $sqlCatPast = "SELECT * FROM thumbs WHERE publish='now' AND zin != '$zinTitle' AND display = 'on' ORDER BY author DESC";
$sqlCatPast = "SELECT * FROM thumbs WHERE  display = 'on' ORDER BY author DESC";
// $sqlCatPast = "SELECT * FROM thumbs WHERE zin != '$zinTitle' AND display = 'on' ORDER BY author DESC";
$resultCatPast = $conn->query($sqlCatPast) or die($conn->error);


//과월호 연재물별 게시물 리스트
if ($resultCatPast->num_rows >= 1) {
    echo "
    <div class = 'sc_mega_area'>
        <div class = 'sc_mega_contain'>
            <div class = 'mega_title'>
                <h2 class = 'gg-batang'>지난호 연재물</h2>
            </div>
    <ul class = 'mega_list'>
    ";
    // output data of each row
    while($rowCatPast = $resultCatPast->fetch_assoc()) {
        // echo "{$rowCatPast['category']}";
        $sqlRowCatPastCont = ${"sqlContPast".$rowCatPast['category']};
        $resultCatPastCont = ${"resultContPast".$rowCatPast['category']};
        $sqlRowCatPastCont = "SELECT * FROM contents WHERE display = 'on' AND category = '{$rowCatPast['category']}' ORDER BY sess*1 DESC LIMIT 3";
        $resultCatPastCont = $conn->query($sqlRowCatPastCont) or die($conn->error);
        $rowCatPastCont = ${"rowCatPast".$rowCatPast['category']};
        
        $catTitlePast = $rowCatPast['category'];
        $sqlContPast = "SELECT * FROM contents WHERE zin!='$zinTitle' AND category='$catTitlePast' AND display='on'";
        $resultContPast = $conn->query($sqlContPast) or die($conn->error);
       
        if ($resultContPast->num_rows > 0) {


        echo "
        <li class='mega_box'>
        <a  id='{$rowCatPast["id"]}' class='txt cat' name='$catId' onclick = 'frontAllCatShow(this.id, this.name)'>";
        // <a  id='{$rowCatPast["id"]}' class='txt cat' name='$catId' onclick = 'frontCatShow(this.id, this.name)'>";
        echo "      <div class='mega_box_sub' style='background-image:url(";
        echo '"';
        echo    $rowCatPast['img_dir'];
        echo    '");';
        echo    "'>";
        
        echo '   
        <div class="mega_list_wrap">
        
        <div class="mega_list_title">
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
        
        } 
        
    }
    
    
};
echo "</ul>";

echo "</div>
</div>";


?>
