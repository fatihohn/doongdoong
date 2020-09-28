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



$URL = "./admin_index.php";
if(!isset($_SESSION['username'])) {
    ?>              <script>
                            // alert("권한이 없습니다.");
                            location.replace("<?php echo $URL?>");
                    </script>
    <?php   }
            //cast: admin인 경우
            else if($_SESSION['cast']==$adminCast || $_SESSION['cast']==$editorCast) {

                $sql = "SELECT * FROM zin ORDER BY id DESC";
                
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']==$authorCast) {
                
                $sql = "SELECT * FROM zin WHERE display = 'on' OR display='ok' ORDER BY id DESC";
            } else if ($_SESSION['cast']!==$adminCast && $_SESSION['cast']!==$editorCast && $_SESSION['cast']!==$authorCast) {
                
                // $sql = "SELECT * FROM zin WHERE display = 'on' ORDER BY id DESC";
                ?>              <script>
                alert("권한이 없습니다.");
                location.replace("<?php echo $URL?>");
                </script>
                <?php
            }










$result = $conn->query($sql) or die($conn->error);


// <th onclick='sortTable(1)'>에디터</th> 
echo "<tr>
<th onclick='sortTable(0)'>번호</th>
<th onclick='sortTable(1)'>표지</th> 
<th onclick='sortTable(2)'>매거진 제목</th> 
<th onclick='sortTable(3)'>설명</th>
<th onclick='sortTable(4)'>공개상태</th>   
<th onclick='sortTable(5)'>발행상태</th>           
<th >관리</th>        
</tr>";


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
                        
        // <td class='{$row["id"]}'>{$row['author']}</td>
echo
        "<tr id='{$row["id"]}' >
        <td class='{$row["id"]}'>{$row['id']}</td>    
        <td class='{$row["id"]}'><img style='max-width:100px; height:auto;' src='{$row['img_dir']}'></td>

            <td class='{$row["id"]}'>{$row['title']}</td>
            <td class='{$row["id"]}'>{$row['zin_detail']}</td>
            <td class='{$row["id"]} {$row['display']}'>{$row['display']}</td>
            <td class='{$row["id"]} {$row['publish']}'>{$row['publish']}</td>
            <td class='{$row["id"]}'><button class='view_btn1' name='{$row["id"]}' onclick='zinModi(this.name)'>수정</button>";
echo " | ";
echo             "<button class='view_btn1' name='{$row["id"]}' onclick='zinDel(this.name)'>삭제</button></td>
        </tr>";
        
    }
} else {
    echo "0 results";
}
$conn->close();
?>