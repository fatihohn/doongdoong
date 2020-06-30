<!DOCTYPE html>
<html lang="ko">
<head>
  <?php
session_start();
 include "bbdd_head.php"; ?>
  
</head>
<body>
    <div id="bbdd_body">
        <header id="bbdd_hd">
     
            <?php include "front_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
        <?php
include 'bbdd_db_conn.php';

$q = intval($_GET['q']);
$r = intval($_GET['r']);
$rVal = $_GET['r'];
$sql = "SELECT * FROM thumbs WHERE id = $q";
$result = $conn->query($sql) or die($conn->error);
$rows = mysqli_fetch_assoc($result);

$author = $rows['author'];

// $sqlAuth = "SELECT author, auth_detail FROM user_data WHERE author = '$author'";
$sqlAuth = "SELECT author, auth_detail FROM user_data WHERE author = ?";

$stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlAuth)) {
                // echo "sqlAuth error";
        } else {
                mysqli_stmt_bind_param($stmt, "s", $author);
                mysqli_stmt_execute($stmt);
                $resultAuth = mysqli_stmt_get_result($stmt);
        }


// $resultAuth = $conn->query($sqlAuth) or die($conn->error);
$rowsAuth = mysqli_fetch_assoc($resultAuth);

$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();

$zinTitle = $rowZinNow['title'];

?>


<div class="view_wrap">
    <div class="view_wrap_line">

        <div class = 'view_img'>
            <img src = '<?php echo $rows['img_dir']?>'>
          
        </div>
        
        
        
        <div class = 'view_category'><?php echo $rows['category']?></div>
        <div class = 'view_author'><?php echo $rows['author']?></div>
        
        <ul class = 'view_contList'>
            <?php 
            //모든 매거진 콘텐츠
            $thisCat = $rows['category'];
            // $sqlCont = "SELECT * FROM contents WHERE display = 'on'  AND category = '$thisCat' ORDER BY sess*1 DESC";
            $sqlCont = "SELECT * FROM contents WHERE display = 'on'  AND category = ? ORDER BY sess*1 DESC";
           
            $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCont)) {
                // echo "sqlCont error";
        } else {
                mysqli_stmt_bind_param($stmt, "s", $thisCat);
                mysqli_stmt_execute($stmt);
                $resultCont = mysqli_stmt_get_result($stmt);
        }



            // $resultCont = $conn->query($sqlCont) or die($conn->error);
            
            if($resultCont->num_rows >0){
                while($rowCont = $resultCont->fetch_assoc()) {
                    $created_dateTime = $rowCont['created'];
                    $created_date = explode(" ", $created_dateTime)[0];
                    echo "
                    <li class='cont_li'>
                    <a class = 'frontCont' id = '";
                    echo $rowCont['id'];
                    echo "' name = '";
                    echo $rVal;
                    // echo $rows['id'];
                    echo "' onclick = 'frontAllContShow(this.id, this.name)'>
                    <div class='cont_li_title'>
                    <span class='li_number'>
                    <p>";
                    echo $rowCont['sess'];
                    echo '회</p>
                    </span>
                    
                    <p>[';
                    echo $rowCont['zin'];
                    echo "] ";
                    echo $rowCont['title'];
                    echo '</p>
                    </div>
                    <div class="li_created">
                    <span>';
                    // echo $rowCont['created'];
                    echo $created_date;
                    echo '</span>
                    </div>
                    
                    </a>
                    </li>';
                }
            }
            
            
            ?>
        </ul>
                    <div class = 'view_detail'>
                        <div class = 'view_auth_detail'><?php echo $rowsAuth['auth_detail']?></div>
                        <div class = 'view_cat_detail'><?php echo $rows['cat_detail']?></div>
                    </div>


                    <div class="func_btn">
                        <div class="share_btn" title="공유하기">
                            <img src="static/img/share.png" alt="공유하기">
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



</body>
</html>




















    

