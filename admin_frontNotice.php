<!DOCTYPE html>
<html lang="ko">
<head>
<?php include "admin_head.php"; ?>
  
</head>
<body>
    <div id="bbdd_body">
        <header id="bbdd_hd">
            <?php include "admin_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
        <?php
include 'bbdd_db_conn.php';

$sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
// $zin_column = $rowStandingZin['zin_column'];
// $zin_color = $rowStandingZin['zin_color'];
// $title_color = $rowStandingZin['title_color'];
// $point_color = $rowStandingZin['point_color'];
// $nav_color = $rowStandingZin['nav_color'];

$sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
$resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
$rowZinNow = $resultZinNow->fetch_assoc();
$zin_column = $rowZinNow['zin_column'];
$zin_color = $rowZinNow['zin_color'];
$title_color = $rowZinNow['title_color'];
$point_color = $rowZinNow['point_color'];
$nav_color = $rowZinNow['nav_color'];


?>


<div class="view_wrap">
    <div class="view_wrap_line">

       <div class = 'view_category front_point_color'>'둥둥' 지난호</div>
        <div class = 'view_author'>
            
        </div>
        <ul class = 'view_contList'>
            <?php 
            // $sql = "SELECT * FROM notice WHERE category = 'notice' AND display='on' ORDER BY id DESC";
            $sql = "SELECT * FROM zin WHERE publish = 'ready' AND display='on' ORDER BY id DESC";
            $result = $conn->query($sql) or die($conn->error);
            
            if($result->num_rows >0){
                while($rows = $result->fetch_assoc()) {
                    $published_date = $rows['date'];
                    echo "
                            <li class='cont_li'>
                                <a class = 'frontCont' id = '";
                    echo        $rows['id'];
                    echo        "'";
                    echo "      onclick = 'adminNoticeSlctShow(this.id)'>
                                    <div class='cont_li_title'>
                                        <p>";
                    echo                    $rows['title'];
                    echo '              </p>
                                    </div>
                                    <div class="li_created">
                                        <span>';
                    // echo $rows['created'];
                    echo                    $published_date;
                    echo '              </span>
                                    </div>
                                    <div class="zin_cover">';
                    // echo "          <div class='zin_cover' style='background-image:url(";
                    // echo            '"';
                    // echo            $rows['img_dir'];
                    // echo            '");';
                    // echo            "'>";
                    echo "              <img src=";
                    echo                '"';
                    echo                $rows['img_dir'];
                    echo                '" alt="';
                    echo                $rows['title'];
                    echo                '">  ';
                    echo '          </div>  
                                </a>
                            </li>';
                }
            }
            
            ?>
        </ul>
                   
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
        <?php include "admin_nav.php"; ?>
    </nav>
    <div id="body_bg"></div>
    <?php include "jsGroup.php"; ?>
    <?php include "admin_jsGroup.php"; ?>

<script>
    document.querySelector(".view_wrap").style.boxShadow = "0 4px 8px 0 rgba(0, 0, 0, 0.2)";
        
    frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    
</script>

</body>
</html>




















    

