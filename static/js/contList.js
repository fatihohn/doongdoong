function frontContList(str) {

    if (str == "") {
        document.querySelector("#bbdd_sc_area").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.querySelector("#bbdd_sc_area").innerHTML = xmlhttp.responseText;
            // document.querySelector(".proj_content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "frontCont_showClickedObject.php?q=" + str, true);
    xmlhttp.send();


    document.getElementById("bbdd_sc_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.getElementById("bbdd_ft_area").style.backgroundColor = "rgb(255, 255, 255)";
    document.querySelector("body").style.backgroundColor = "rgb(255, 255, 255)";
    
//     let url = 'content_'+str;
// //   addCurrentClass(str);
// //   history.replaceState(str, null, url);
//   history.pushState('frontCont_showClickedObject.php?q='+str, null, url);
// //   updateText(str);
// //   requestContent(url);
// //   document.title = "변방의북소리 둥둥 | " +  str;

}


function frontCatList(str) {
    
    if (str == "") {
        document.querySelector("#bbdd_sc_area").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.querySelector("#bbdd_sc_area").innerHTML = xmlhttp.responseText;
            // document.querySelector(".proj_content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "./frontCat_showClickedObject.php?q=" + str, true);
    xmlhttp.send();
    

    
//     let url = str;
// //   addCurrentClass(str);
// //   history.replaceState(str, null, url);
//   history.pushState('frontCat_showClickedObject.php?q='+str, null, url);
// //   updateText(str);
// //   requestContent(url);
// //   document.title = "변방의북소리 둥둥 | " +  str;
 


}

function frontThumbsList(str) {

    if (str == "") {
        document.querySelector("#bbdd_sc_area").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.querySelector("#bbdd_sc_area").innerHTML = xmlhttp.responseText;
            // document.querySelector(".proj_content").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("POST", "./frontThumbs_showClickedObject.php?q=" + str, true);
    xmlhttp.send();
}