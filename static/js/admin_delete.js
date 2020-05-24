//관리자
function userDel(str) {
    let delConfirm = confirm('삭제 후 복원이 불가능합니다. 삭제하시겠습니까?');
    if (delConfirm == true) {
        location.href = './admin_delete_user.php?id=' + str;
        alert('삭제중입니다')
    } else {
        alert('취소되었습니다');
    }
}
//관리자, 에디터
function zinDel(str) {
    let delConfirm = confirm('삭제 후 복원이 불가능합니다. 삭제하시겠습니까?');
    if (delConfirm == true) {
        location.href = './admin_delete_zin.php?id=' + str;
        alert('삭제중입니다')
    } else {
        alert('취소되었습니다');
    }
}

function catDel(str) {
    let delConfirm = confirm('삭제 후 복원이 불가능합니다. 삭제하시겠습니까?');
    if (delConfirm == true) {
        location.href = './admin_delete_thumbs.php?id=' + str;
        alert('삭제중입니다')
    } else {
        alert('취소되었습니다');
    }
}
//관리자, 에디터, 작가
function contDel(str, name) {
    let delConfirm = confirm('삭제 후 복원이 불가능합니다. 삭제하시겠습니까?');
    if (delConfirm == true) {
        location.href = './admin_delete_cont.php?id=' + str + '&username=' + name + '';
        alert('삭제중입니다')
    } else {
        alert('취소되었습니다');
    }
}

function notiDel(str, name) {
    let delConfirm = confirm('삭제 후 복원이 불가능합니다. 삭제하시겠습니까?');
    if (delConfirm == true) {
        location.href = './admin_delete_noti.php?id=' + str + '&username=' + name + '';
        alert('삭제중입니다')
    } else {
        alert('취소되었습니다');
    }
}