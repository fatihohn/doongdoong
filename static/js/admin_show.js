function adminCatShow(str, cat) {
    // location.href = "adminCat.php?q="+str+"&?r="+cat;
    location.href = "admin_frontCat.php?q=" + str + "&r=" + cat;
}

function adminContShow(str, cat) {
    location.href = "admin_frontCont.php?q=" + str + "&r=" + cat;

}

function adminAllCatShow(str, cat) {
    // location.href = "admin_frontCat.php?q="+str+"&?r="+cat;
    location.href = "admin_frontAllCat.php?q=" + str + "&r=" + cat;
}

function adminAllContShow(str) {
    location.href = "admin_frontAllCont.php?q=" + str;

}
// function adminAllContShow(str, cat) {
//     location.href = "admin_frontAllCont.php?q=" + str + "&r=" + cat;

// }
// function viewCatShow(str, cat) {
//     // location.href = "adminCat.php?q="+str+"&?r="+cat;
//     location.href = "./adminCat.php?q="+str+"&r="+cat;
// }

// function viewContShow(str, cat) {
//     location.href = "./adminCont.php?q="+str+"&r="+cat;

// }


function adminIntroShow(str) {
    location.href = "admin_frontIntro.php?q=" + str;
}

function adminNoticeShow() {
    location.href = "admin_frontNotice.php";
}
// function adminNoticeShow(str) {
//     location.href = "admin_frontNotice.php?q=" + str;
// }

function adminNoticeSlctShow(str) {
    location.href = "admin_frontNoticeSlct.php?q=" + str;
}