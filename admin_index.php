<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>

       <?php

include 'bbdd_db_conn.php';
session_start();
if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다. 로그인하세요.");
                            
                    </script>

    <?php  
    echo "<section id='bbdd_sc'>
    <div id='bbdd_sc_wrap'>
        <div id='bbdd_sc_area'>
            <div class='sc_contain'>
                <div class='sc_list_area'>
    
    
        <div>";
            echo "<a><div class = 'ad_logIn' onclick='";
            echo 'location.href="./admin_login.php"';
            echo "'>
            <img src='static/img/editor_logo.png' alt='변방둥둥'><h4>LogIn</h4></a>";    
            // include "admin_editor_index.php";
     echo "</div>
     </div>
     </div>
     </div>
     </div>
        </section>";
            }
            else {

echo "<div id='bbdd_body'>
        <header id='bbdd_hd'>";
           include 'admin_header.php'; 
echo    "</header>";

            include "admin_editor_index.php";

// <!-- </div> -->


}


        
            ?>
   

    <?php include "admin_jsGroup.php";?>

</body>

</html>