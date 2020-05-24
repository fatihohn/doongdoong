//관리자, 에디터
function userModi(str) {

    location.href = './admin_modify_user.php?id=' + str;

}

function zinModi(str) {

    location.href = './admin_modify_zin.php?id=' + str;

}

function catModi(str) {

    location.href = './admin_modify_thumbs.php?id=' + str;

}
//관리자, 에디터, 작가
// function contModi(str, name) {
function contModi(str) {

    // location.href='./admin_modify_cont.php?id='+str+'&username='+name+'';
    location.href = './admin_modify_cont.php?id=' + str;

}

function notiModi(str) {

    location.href = './admin_modify_noti.php?id=' + str;

}