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



?>


<div class="view_wrap">
    <div class="view_wrap_line">

       <div class = 'view_category'>'둥둥' 지난호</div>
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



</body>
</html>




















    

