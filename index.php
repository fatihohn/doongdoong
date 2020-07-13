<!DOCTYPE html>
<html>
<head>
  <?php include "bbdd_head.php"; 
  
  include "bbdd_db_conn.php";
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
  $sqlStandingZin = "SELECT * FROM zin WHERE publish = 'standing'";
$resultStandingZin = $conn->query($sqlStandingZin) or die($conn->error);
$rowStandingZin = $resultStandingZin->fetch_assoc();
$zin_column = $rowStandingZin['zin_column'];
$zin_color = $rowStandingZin['zin_color'];
$title_color = $rowStandingZin['title_color'];
$point_color = $rowStandingZin['point_color'];
$nav_color = $rowStandingZin['nav_color'];

  ?>
  
</head>
<body oncontextmenu="return false" ondragstart="return false" onselectstart="return false">
    <div id="bbdd_body">
        <header id="bbdd_hd">
        
            <?php include "front_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <div class="sc_contain">
                <!-- <div class="sc_list_area"> -->
                    <!-- <ul class="sc_list_contain"> -->
                        <?php include "frontList.php"; ?>
                           
                
                
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
        
    
    frontListColor("<?php echo $zin_color; ?>", "<?php echo $title_color; ?>", "<?php echo $point_color; ?>", "<?php echo $nav_color; ?>");
    
    </script>


</body>
</html>