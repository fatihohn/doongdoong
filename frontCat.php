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

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$zin_column = $rowStandingZin['zin_column'];
$zin_color = $rowStandingZin['zin_color'];
$title_color = $rowStandingZin['title_color'];
$point_color = $rowStandingZin['point_color'];
$nav_color = $rowStandingZin['nav_color'];

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
        
        
        
        <div class = 'view_category' title='전체 게시물 보기' id='<?=$rows["id"]?>' name='<?=$rows["id"]?>' onclick='frontAllCatShow(this.id, this.name)'><?php echo $rows['category']?></div>
        <div class = 'view_author front_point_color'><?php echo $rows['author']?></div>
        
        <ul class = 'view_contList'>
            <?php 
            //발행중 매거진 콘텐츠만
            $thisCat = $rows['category'];
            // $sqlCont = "SELECT * FROM contents WHERE display = 'on' AND zin = '$zinTitle' AND category = '$thisCat' ORDER BY sess*1 DESC";
            $sqlCont = "SELECT * FROM contents WHERE display = 'on' AND zin = ? AND category = ? ORDER BY sess*1 DESC";
            
            $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sqlCont)) {
                // echo "sqlCont error";
        } else {
                mysqli_stmt_bind_param($stmt, "ss", $zinTitle, $thisCat);
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
                    echo "' onclick = 'frontContShow(this.id, this.name)'>
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
                    <?php 
                    echo    "<div class = 'view_auth_detail front_point_color'>";
                    if($rowsAuth['auth_detail']) {
                    echo "글쓴이 | ".$rowsAuth['auth_detail'];
                    }
                    echo "</div>";
                    ?>
                    <?php 
                    echo "<div class = 'view_cat_detail'>";
                    if($rows['cat_detail']) {
                        echo "코너 소개 | ".$rows['cat_detail'];
                    }
                    echo "</div>";
                    ?>
                    </div>
                    <div class="func_btn">
                        <div class="share_btn" title="공유하기">
                            <img src="static/img/share.png" alt="공유하기" style="width:40px;">
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
<script>
    document.querySelector(".view_wrap").style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2)";
    frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    
</script>


</body>
</html>




















    

