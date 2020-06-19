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

// $q = intval($_GET['q']);
// $r = intval($_GET['r']);
// $rVal = $_GET['r'];
// session_start();
// $sql = "SELECT * FROM notice WHERE category = 'notice' AND display='on' OR (category = 'notice' AND display='ok')";
// $result = $conn->query($sql) or die($conn->error);
// $rows = mysqli_fetch_assoc($result);

// $author = $rows['author'];

// $sqlAuth = "SELECT author, auth_detail FROM user_data WHERE author = '$author'";
// $resultAuth = $conn->query($sqlAuth) or die($conn->error);
// $rowsAuth = mysqli_fetch_assoc($resultAuth);

// $sqlZinNow = "SELECT * FROM zin WHERE publish='now' AND display = 'on' ORDER BY id DESC LIMIT 1";
// $resultZinNow = $conn->query($sqlZinNow) or die($conn->error);
// $rowZinNow = $resultZinNow->fetch_assoc();

// $zinTitle = $rowZinNow['title'];

?>


<div class="view_wrap">
    <div class="view_wrap_line">

       <div class = 'view_category'>공지사항</div>
        <div class = 'view_author'>
            <div class = 'cs_box_front'>
            <button class="view_btn1" onclick="location.href='./admin_create_noti.php'">공지 작성</button>
            </div>
        </div>
        <ul class = 'view_contList'>
            <?php 
            //발행중 매거진 콘텐츠만
            $sql = "SELECT * FROM notice WHERE category = 'notice' AND display='on' OR (category = 'notice' AND display='ok') ORDER BY id DESC";
            $result = $conn->query($sql) or die($conn->error);
            
            if($result->num_rows >0){
                while($rows = $result->fetch_assoc()) {
                    $created_dateTime = $rows['created'];
                    $created_date = explode(" ", $created_dateTime)[0];
                    echo "
                    <li class='cont_li'>
                    <a class = 'frontCont' id = '";
                    echo $rows['id'];
                    echo "'";
                    // echo $rVal;
                    // echo $rows['id'];
                    echo " onclick = 'adminNoticeSlctShow(this.id)'>
                    <div class='cont_li_title'>
                    <p>";
                 
                    echo $rows['title'];
                    echo '</p>
                    </div>
                    <div class="li_created">
                    <span>';
                    // echo $rows['created'];
                    echo $created_date;
                    echo '</span>
                    </div>
                    
                    </a>
                    </li>';
                }
            }
            //         echo "
            //     <li class='cont_li'>
            //                                         <a href='#' id = '{$rows['id']}' onclick = 'frontContList(this.id)'>
            
            //                                                 <div class='li_number'>
            //                                                     <p>";
            //     echo $rows['sess'];
            //     echo '</p>
            //                                                 </div>
            //                                                 <div class="li_title">
            //                                                     <p>';
            //     echo $rows['title'];
            //     echo '</p>
            //                                                 </div>
            //                                                 <div class="li_created">
            //                                                     <p>';
            //     echo $rows['created'];
            //     echo '</p>
            //                                                 </div>
            
            //                                         </a>
            //     </li>';
            //     }
            // }
            
            
            ?>
        </ul>
                    <!-- <div class = 'view_detail'>
                        <div class = 'view_auth_detail'><?php 
                        // echo $rowsAuth['auth_detail']?></div>
                        <div class = 'view_cat_detail'><?php 
                        // echo $rows['cat_detail']?></div>
                    </div> -->
    </div>
</div>


        </div>
    </div>
</section>


        <footer id="bbdd_ft">
            <!-- <div id="bbdd_ft_wrap">
                <div id="bbdd_ft_area">
                    <div class="ft_con">
                        <p class="sm3-kk">
                            COPYRIGHT 2020 변방의북소리.
                        </p>
                    </div>
                </div>
            </div> -->
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




















    

