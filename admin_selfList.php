<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
 
    <section>
    <div>
            <br>

            <div>
                <center>
                    <h2>필진 목록</h2>
                </center>
            </div>

            <div id="adImgList">
                <!-- <div>
                    <button class="view_btn1" onclick="location.href='./admin_create_user.php'">회원추가</button>
                    <input type="text" class="searchInput" onkeyup="searchInput()" placeholder="이름 검색..">
                </div> -->
                <div id="includeTable">
                <table class="imgTable sortTable"><?php include 'admin_selfSelect.php'; ?></table>
                </div>
                <div id="tableBox"></div>

              
<br>
<br>
            </div>

        </div>
    </section>
    <footer>
        <?php include 'admin_footer.php'; ?>

    </footer>

    <?php include "admin_jsGroup.php";?>

</body>

</html>


