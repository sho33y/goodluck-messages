/*----------------------------------------
 Init
 ----------------------------------------*/


$(function() {

    slabTextHeadlines();
    fadePage();
    fadeLink();
    targetBlank();
    deleteLink();
    goTop();
    infinitescroll();


})



/*----------------------------------------
 Function
 ----------------------------------------*/

//TextResize
function slabTextHeadlines(){

    $(".slab, #rightContent .articleList .article a, div#rightContent div.catch").slabText({
        // Don't slabtext the headers if the viewport is under 480px
        "viewportBreakpoint":480
    });

}


//Fade In-Out(Page)
function fadePage(){

    $('#rightContent').after('<div id="fade"><div class="loading"></div></div>');

    $(document).ready(function(){
        $('#fade').fadeOut(1000);
        $('header h2.copy,#rightContent').animate( { opacity: '1',}, { duration: 1000, easing: 'swing', } )
    });

}


//Fade In-Out(Link)
function fadeLink(){

    $(document).ready(function(){
        $(".siteTitle a:not(:animated),#pageTop a:not(:animated),#nav a:not(:animated)").hover(function(){
            $(this).stop().animate({'opacity' : '0'}, 100);
        }, function(){
            $(this).stop().animate({'opacity' : '1'}, 100);
        });
    });

}


//infinitescroll
function infinitescroll(){

    $('#rightContent .articleList').infinitescroll({
        navSelector  : "#page-nav",
        nextSelector : "#page-nav .next a",
        itemSelector : "#rightContent .articleList .article"
    },function(arrayOfNewElems){
        $(".article a").slabText();
    });

}


//target_blank

function targetBlank(){

    $(document).ready(function(){
        $(".facebook a,aside.explore a").click(function(){
            this.target = "_blank";
        });
    });
}


//Delete LinkLine
function deleteLink(){

    $(document).ready(function() {
        $("a").bind("focus",function(){if(this.blur)this.blur();
        });
    });

}


//GotoPageTop
function goTop(){

    $(function() {
        var topBtn = $('#pageTop');
        topBtn.hide();
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                if ($(window).width() > 800) { //480px以上でのみ表示
                    topBtn.fadeIn();
                }
            } else {
                topBtn.fadeOut();
            }
        });

        if($.browser.safari) bodyelem = $("body")
        else bodyelem = $("html,body")

        topBtn.click(function () {
            bodyelem.animate({
                scrollTop: 0
            }, 500);
            return false;
        });
    });

}

