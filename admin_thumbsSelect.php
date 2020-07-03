<?php

include 'bbdd_db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
session_start();

$adminCast = "admin";
$editorCast = "editor";
$authorCast = "author";

$uname = $_SESSION['username'];

// $sql = "SELECT * FROM zin ORDER BY id DESC";


$URL = "./admin_index.php";
if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다.");
                            location.replace("<?php echo $URL?>");
                    </script>
    <?php   }
            //cast: admin인 경우
            else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {

                // $sql = "SELECT * FROM thumbs ORDER BY id DESC";
                $sql = "SELECT * FROM thumbs ORDER BY created DESC";
                
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']==$authorCast) {
                
                // $sql = "SELECT * FROM thumbs WHERE display = 'on' OR display='ok' ORDER BY id DESC";
                $sql = "SELECT * FROM thumbs WHERE display = 'on' OR display='ok' ORDER BY created DESC";

            
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']!==$authorCast) {
                
                // $sql = "SELECT * FROM thumbs WHERE display = 'on' OR display='ok' ORDER BY id DESC";
                ?>              <script>
                alert("권한이 없습니다.");
                location.replace("<?php echo $URL?>");
                </script>
                <?php
            }










$result = $conn->query($sql) or die($conn->error);


echo "<tr>
<th onclick='sortTable(0)'>번호</th>
<th onclick='sortTable(1)'>연재작가</th> 
<th onclick='sortTable(2)'>연재물 제목</th> 
<th onclick='sortTable(3)'>공개상태</th>   
<th onclick='sortTable(4)'>연재상태</th>           
<th >관리</th>        
</tr>";


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
                        
        // echo "<li id='{$row["id"]}' onclick = 'showClickedObject(this.id)'>"/*."<a href='VisitContentClick()'>"*/.
        
        // "<h3>{$row['title']}</h3>".
        // "<img src='{$row['img0_dir']}' width='210px' heigit='70px'>".
        // "  ".
        // $row["username"].
        // "  ".
        // $row["created"].
        // "</a>".
        // "</li>";
        // <td class='{$row["id"]}'><img src='{$row['img_dir']}' width='90px' heigit='60px'></td>
echo
        "<tr >
        <td class='{$row["id"]}' onclick='thumbsToTop(this.className)' title='맨 위로'>{$row['id']}</td>    
        <td class='{$row["id"]}'>{$row['author']}</td>
        <td class='{$row["id"]}' id='{$row["id"]}' onclick='adminAllCatShow(this.id)'>{$row['category']}</td>
        <td class='{$row["id"]} {$row['display']}'>{$row['display']}</td>
        <td class='{$row["id"]} {$row['publish']}'>{$row['publish']}</td>
        <td class='{$row["id"]}'><button class='view_btn1' name='{$row["id"]}' onclick='catModi(this.name)'>수정</button>";
echo " | ";
echo             "<button class='view_btn1' name='{$row["id"]}' onclick='catDel(this.name)'>삭제</button></td>
        </tr>";
        
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<!-- <script src="imgList.js"></script> -->
<!-- <script src="sortTable.js"></script> -->
<!-- <td id='{$row["id"]}' class='{$row["id"]}' onclick = 'imgList(this.id)'>{$row['title']}</td> -->