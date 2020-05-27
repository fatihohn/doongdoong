// // 연재물 결정 확인--수정용
// if(document.getElementById("authCat") && document.getElementById("catSess")) {
// function checkAuthCatRem(){
//     let authCatRem = document.getElementById("authCat").value;
//     let authCatRemId = document.getElementById("catSess").name;

//     if(authCatRem) {

//     if (authCatRem == "") {
//     document.getElementById("authCatRem").innerHTML = "";
//     return;
//     }
//     if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
//         xmlhttp = new XMLHttpRequest();
//     } else { // code for IE6, IE5
//         xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
//     }
//     xmlhttp.onreadystatechange = function() {
//         if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
//             document.getElementById("authCatRem").innerHTML = xmlhttp.responseText;
//         }
//     }
//     xmlhttp.open("POST", "admin_checkAuthCatRem.php?q=" + authCatRem + '&r=' + authCatRemId, true);
//     xmlhttp.send();
//     } else {
//         alert("연재물을 골라주세요");
//     }

//     }

// document.getElementById("authCat").addEventListener("change", checkAuthCatRem);
// }


//연재물 결정 확인
if (document.getElementById("authCat") && !document.getElementById("authCatRem")) {
    function checkAuthCat() {
        let authCat = document.getElementById("authCat").value;

        if (authCat) {

            if (authCat == "") {
                document.getElementById("authCatConf").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("authCatConf").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_checkAuthCat.php?q=" + authCat, true);
            xmlhttp.send();
        } else {
            alert("연재물을 골라주세요");
        }

    }

    document.getElementById("authCat").addEventListener("change", checkAuthCat);
}




//연재물 제목 중복체크
if (document.getElementById("category")) {
    function checkCategory() {
        let category = document.getElementById("category").value;

        if (category) {

            if (category == "") {
                document.getElementById("catConf").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("catConf").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_checkCategory.php?q=" + category, true);
            xmlhttp.send();
        } else {
            alert("연재물 제목을 입력하세요");
        }

    }

    document.getElementById("category").addEventListener("change", checkCategory);
}


//매거진타이틀 중복체크
if (document.getElementById("zin_title")) {
    function checkZinTitle() {
        let zinTitle = document.getElementById("zin_title").value;

        if (zinTitle) {

            if (zinTitle == "") {
                document.getElementById("zinTitleConf").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("zinTitleConf").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_checkZinTitle.php?q=" + zinTitle, true);
            xmlhttp.send();
        } else {
            alert("매거진 제목을 입력하세요");
        }

    }

    document.getElementById("zin_title").addEventListener("change", checkZinTitle);
}
//아이디 중복체크
if (document.getElementById("username")) {
    function checkId() {
        let userid = document.getElementById("username").value;

        if (userid) {

            if (userid == "") {
                document.getElementById("userConf").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("userConf").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_checkId.php?q=" + userid, true);
            xmlhttp.send();
        } else {
            alert("아이디를 입력하세요");
        }

    }

    document.getElementById("username").addEventListener("change", checkId);
}

//필명 중복체크
if (document.getElementById("author")) {
    function checkAuthor() {
        let authorName = document.getElementById("author").value;

        if (authorName) {

            if (authorName == "") {
                document.getElementById("authorConf").innerHTML = "";
                return;
            }
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("authorConf").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "admin_checkAuthor.php?q=" + authorName, true);
            xmlhttp.send();
        } else {
            alert("필명을 입력하세요");
        }


    }

    document.getElementById("author").addEventListener("change", checkAuthor);
}

//비밀번호 체크
if (document.getElementById("pwOne") && document.getElementById("pwTwo")) {
    function checkPw() {
        let pwOne = document.getElementById("pwOne").value;
        let pwTwo = document.getElementById("pwTwo").value;

        if (pwTwo) {

            if (pwOne == "") {
                document.getElementById("pwConf").innerHTML = "";
                return;
            } else if (pwOne === pwTwo) {
                document.getElementById("pwConf").innerHTML = "비밀번호가 일치합니다.";
                document.getElementById("pwConf").style.color = "green";
            } else {
                document.getElementById("pwConf").innerHTML = "비밀번호가 일치하지 않습니다.";
                document.getElementById("pwConf").style.color = "red";

            }
        }

        function chekPassword() {

            let mbrId = document.getElementById("username").value; // id 값 입력

            let mbrPwd = pwOne; // pw 입력

            let check1 = /^(?=.*[a-zA-Z])(?=.*[0-9]).{8,12}$/.test(mbrPwd); //영문,숫자

            let check2 = /^(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9]).{8,12}$/.test(mbrPwd); //영문,특수문자

            let check3 = /^(?=.*[^a-zA-Z0-9])(?=.*[0-9]).{8,12}$/.test(mbrPwd); //특수문자, 숫자

            // let check1 = /^(?=.*[a-zA-Z])(?=.*[0-9]).{10,12}$/.test(mbrPwd);   //영문,숫자

            // let check2 = /^(?=.*[a-zA-Z])(?=.*[^a-zA-Z0-9]).{10,12}$/.test(mbrPwd);  //영문,특수문자

            // let check3 = /^(?=.*[^a-zA-Z0-9])(?=.*[0-9]).{10,12}$/.test(mbrPwd);  //특수문자, 숫자

            if (!(check1 || check2 || check3)) {

                document.getElementById("pwOne").value = "";
                document.getElementById("pwTwo").value = "";
                alert("사용할 수 없는 조합입니다.\n다시 입력해 주세요.");
                return false;


            }

            if (/(\w)\1\1/.test(mbrPwd)) {

                document.getElementById("pwOne").value = "";
                document.getElementById("pwTwo").value = "";
                alert('같은 문자를 3번 이상 사용하실 수 없습니다.\n다시 입력해 주세요.');
                return false;


            }

            if (mbrPwd.search(mbrId) > -1) {

                document.getElementById("pwOne").value = "";
                document.getElementById("pwTwo").value = "";
                alert("비밀번호에 아이디가 포함되었습니다.\n다시 입력해 주세요.");
                return false;


            }

            return true;

        }
        if (pwOne && pwTwo) {

            chekPassword();
        }




    }

    // document.getElementById("username").addEventListener("change", checkPw);
    document.getElementById("pwOne").addEventListener("change", checkPw);
    document.getElementById("pwTwo").addEventListener("change", checkPw);
}