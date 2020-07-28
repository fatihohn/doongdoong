function displayOnRep() {
    let displayOn = document.querySelectorAll(".on");
    let i;
    for (i = 0; i < displayOn.length; i++) {
        let dpOn = displayOn[i].innerHTML.replace("on", "외부공개");
        displayOn[i].innerHTML = dpOn;
        displayOn[i].style.backgroundColor = "rgba(0, 55, 107, 0.4)";
        displayOn[i].style.color = "rgba(0, 55, 107, 1)";
    }
}
displayOnRep();

function displayOkRep() {
    let displayOk = document.querySelectorAll(".ok");
    let j;
    for (j = 0; j < displayOk.length; j++) {
        let dpOk = displayOk[j].innerHTML.replace("ok", "내부공개");
        displayOk[j].innerHTML = dpOk;
        displayOk[j].style.color = "green";
        displayOk[j].style.backgroundColor = "rgba(9, 107, 0, 0.2)";
    }
}
displayOkRep();

function displayOffRep() {
    let displayOff = document.querySelectorAll(".off");
    let k;
    for (k = 0; k < displayOff.length; k++) {
        let dpOff = displayOff[k].innerHTML.replace("off", "비공개");
        displayOff[k].innerHTML = dpOff;
        displayOff[k].style.color = "red";
        displayOff[k].style.backgroundColor = "rgba(70, 0, 0, 0.2)";
    }
}
displayOffRep();

function publishNowRep() {
    let publishNow = document.querySelectorAll(".now");
    let l;
    for (l = 0; l < publishNow.length; l++) {
        let pbNow = publishNow[l].innerHTML.replace("now", "기획발행");
        publishNow[l].innerHTML = pbNow;
    }
}
publishNowRep();

function publishNowCatRep() {
    let publishNowCat = document.querySelectorAll(".now_cat");
    let pnc;
    for (pnc = 0; pnc < publishNowCat.length; pnc++) {
        let pbNowCat = publishNowCat[pnc].innerHTML.replace("now", "연재중");
        publishNowCat[pnc].innerHTML = pbNowCat;
    }
}
publishNowCatRep();

function publishStandingRep() {
    let publishStanding = document.querySelectorAll(".standing");
    let st;
    for (st = 0; st < publishStanding.length; st++) {
        let pbStanding = publishStanding[st].innerHTML.replace("standing", "상시발행");
        publishStanding[st].innerHTML = pbStanding;
    }
}
publishStandingRep();

function publishPastRep() {
    let publishPast = document.querySelectorAll(".past");
    let m;
    for (m = 0; m < publishPast.length; m++) {
        let pbPast = publishPast[m].innerHTML.replace("past", "완결");
        publishPast[m].innerHTML = pbPast;
    }
}
publishPastRep();

function publishReadyRep() {
    let publishReady = document.querySelectorAll(".ready");
    let n;
    for (n = 0; n < publishReady.length; n++) {
        let pbReady = publishReady[n].innerHTML.replace("ready", "대기");
        publishReady[n].innerHTML = pbReady;
    }
}
publishReadyRep();

function catNoticeRep() {
    let catNotice = document.querySelectorAll(".notice");
    let o;
    for (o = 0; o < catNotice.length; o++) {
        let ctNoti = catNotice[o].innerHTML.replace("notice", "공지");
        catNotice[o].innerHTML = ctNoti;
        catNotice[o].style.backgroundColor = "rgba(255, 115, 0, 0.2)";
    }
}
catNoticeRep();

function catIntroRep() {
    let catIntro = document.querySelectorAll(".intro");
    let p;
    for (p = 0; p < catIntro.length; p++) {
        let ctIntr = catIntro[p].innerHTML.replace("intro", "웹진 소개");
        catIntro[p].innerHTML = ctIntr;
        catIntro[p].style.backgroundColor = "rgba(200, 0, 255, 0.2)";
    }
}
catIntroRep();