<!DOCTYPE html>
<html>

<head>
<?php include 'admin_head.php'; ?>

</head>

<body>
    <!-- <header> -->
        <?php 
        // include 'admin_header.php'; 
        ?>
<!-- </header> -->
        
    <!-- <article class="adArticle  adminMenu"> -->
        <?php 
        // include 'admin_article.php'; 
        ?>

    <!-- </article> -->
    <section id="bbdd_sc">
    <div id="bbdd_sc_wrap">
        <div id="bbdd_sc_area">
            <div class="sc_contain">
                <div class="sc_list_area">

        <div class="adLogInProcess">
    
            <div class='ad_logInLogo' onclick='location.href="./admin_login.php"'>
            <img src='static/img/editor_logo.png' alt='변방둥둥'>      
            </div>

            <br>
            
            <div align='center'>
        <span>로그인</span>
 
        <form method='post' action='admin_login_action.php'>
        <!-- <form method='get' action='login_action.php'> -->
                <p>ID: <input name="username" type="text" required></p>
                <p>PW: <input name="password" type="password" required></p>
                <input type="submit" value="로그인">
        </form>
        <br />
        <button id="join" onclick="location.href='./admin_create_user.php'">회원가입</button>
 
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>


    </section>
    <footer>
        <?php include 'admin_footer.php'; ?>

    </footer>

    <?php include "admin_jsGroup.php";?>

</body>

</html>


