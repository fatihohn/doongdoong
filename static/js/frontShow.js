function frontCatShow(str, cat) {
    // location.href = "frontCat.php?q="+str+"&?r="+cat;
    location.href = "frontCat.php?q=" + str + "&r=" + cat;
}

function frontContShow(str, cat) {
    location.href = "frontCont.php?q=" + str + "&r=" + cat;

}

function frontAllCatShow(str, cat) {
    // location.href = "frontCat.php?q="+str+"&?r="+cat;
    location.href = "frontAllCat.php?q=" + str + "&r=" + cat;
}

function frontAllContShow(str, cat) {
    location.href = "frontAllCont.php?q=" + str + "&r=" + cat;

}
// function viewCatShow(str, cat) {
//     // location.href = "frontCat.php?q="+str+"&?r="+cat;
//     location.href = "./frontCat.php?q="+str+"&r="+cat;
// }

// function viewContShow(str, cat) {
//     location.href = "./frontCont.php?q="+str+"&r="+cat;

// }


function frontIntroShow(str) {
    location.href = "frontIntro.php?q=" + str;
}

function frontNoticeShow() {
    location.href = "frontNotice.php";
}

function frontNoticeSlctShow(str) {
    location.href = "frontNoticeSlct.php?q=" + str;
}