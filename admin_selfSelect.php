<?php

include 'bbdd_db_conn.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$q = $_SESSION['username'];

$sql = "SELECT * FROM user_data WHERE username='$q'";
$result = $conn->query($sql) or die($conn->error);


echo "<tr>
<th onclick='sortTable(0)'>번호</th>
<th onclick='sortTable(1)'>아이디</th> 
<th onclick='sortTable(2)'>이메일</th> 
<th onclick='sortTable(3)'>필명</th>
<th onclick='sortTable(4)'>이름</th>
       
<th onclick='sortTable(5)'>등급</th>           
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
        "<tr id='{$row["id"]}' >
        <td class='{$row["id"]}'>{$row['id']}</td>    
        <td class='{$row["id"]}'>{$row['username']}</td>

            <td class='{$row["id"]}'>{$row['email']}</td>
            <td class='{$row["id"]}'>{$row['author']}</td>
            <td class='{$row["id"]}'>{$row['realname']}</td>
            <td class='{$row["id"]}'>{$row['cast']}</td>
            <td class='{$row["id"]}'><button class='view_btn1' name='{$row["id"]}' onclick='userModi(this.name)'>수정</button>";
// echo " | ";
echo             "
        </tr>";
        
    }
} else {
    echo "0 results";
}
$conn->close();
?>
<script src="imgList.js"></script>
<script src="sortTable.js"></script>
<!-- <td id='{$row["id"]}' class='{$row["id"]}' onclick = 'imgList(this.id)'>{$row['title']}</td> -->