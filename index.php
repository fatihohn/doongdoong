<!DOCTYPE html>
<html>
<head>
  <?php include "bbdd_head.php"; ?>
  
</head>
<body oncontextmenu="return true" ondragstart="return true" onselectstart="return true">
    <div id="bbdd_body">
        <header id="bbdd_hd">
        
            <?php include "front_header.php"; ?>
        </header>

        
<section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <div class="sc_contain">
                <div class="sc_list_area">
                    <ul class="sc_list_contain">
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



</body>
</html>