$(document).ready(function() {

    $('a[href="#"]').click(function(e) {
        e.preventDefault();
    });


    function menubars() {
        $(".hd_bars > a").click(function() {
            $("#new_body").addClass("blur");
            $("#body_bg").fadeIn(200);
            $("#new_nav").animate({
                right: 0
            }, 200);
        });


        $(".nav_top").find(".close").click(function() {
            $("#new_body").removeClass("blur");
            $("#body_bg").fadeOut(200);
            $("#new_nav").animate({
                right: "-100%"
            }, 200);
        });

        $("#body_bg").click(function() {
            $("#new_body").removeClass("blur");
            $(this).fadeOut(200);
            $("#new_nav").animate({
                right: "-100%"
            }, 200);
        });
    }
    menubars();

    // 주석 넘버링
    $(".content a.sup").each(function(idx) {
        let no = idx + 1;
        $(this).append($("<span>" + no + "</span>").addClass("sup_no"));
    });


    function txtbtn() {
        let opened = 0;
        $(".sup").on("click", function() {
            let footnoteNo = $(this).children(".sup_no").text();
            if (opened !== footnoteNo) {
                let footnoteText = $(this).data("footnote");
                let $newBotTxt = $(".new_bot_txt");

                let $botNumber = $("<span/>").addClass("bot_number").text(footnoteNo + ")");
                $newBotTxt.find("p").html("")
                    .append($botNumber)
                    .append(" " + footnoteText);

                $newBotTxt.animate({
                    bottom: 0
                }, 200);
                opened = footnoteNo;
            } else {
                $(".new_bot_txt").animate({
                    bottom: "-50%"
                }, 200);
                opened = 0;
            }
        });

        $(".new_bot_txt").click(function() {
            $(".new_bot_txt").animate({
                bottom: "-50%"
            }, 200);
            opened = 0;
        });
    }
    txtbtn();

    // F12 버튼 방지
    $(document).bind('keydown', function(e) {
        if (e.keyCode === 123 /* F12 */ ) {
            e.preventDefault();
            e.returnValue = false;
        }
    });

    // 우측 클릭 방지
    document.onmousedown = function(event) {
        if (event.button === 2) {
            alert("무단도용 방지를 위하여 마우스 오른쪽버튼을 이용하실 수 없습니다.");
            return false;
        }
    };

    // 드래그, 블럭 방지
    $("body").on("contextmenu", function() {
            return false;
        })
        .on("selectstart dragtstart selectionchange touchstart", function() {
            return false;
        });

    // 가운데 정렬 + 들여쓰기 문제
    $("#new_sc_area .cont_txt_area .cont_txt_box > .content > p").each(function() {
        if ($(this).css("text-align") === "center") {
            $(this).css("text-indent", "0");
        }
    });

    // top nav bar 스크롤 작동
    $("#new_hd_area").scrollupbar({
        exitViewport: true,
    });
});