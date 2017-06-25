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
    sharrre_count();


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
        nextSelector : "#page-nav a:first",
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


//SNS
function get_social_count(url, postid) {
    $.ajax({
        url      : 'https://graph.facebook.com/' + url,
        dataType : 'jsonp',
        success  : function(json){ $('#' + postid + ' .facebook .count').text( json.shares || 0 ); }
    });
    // $.ajax({
    // 		url      : 'http://urls.api.twitter.com/1/urls/count.json?url=' + url,
    // 		dataType : 'jsonp',
    // 		success  : function(json){ $('#' + postid + ' .twitter .count').text( json.count || 0 ); }
    // });
    $.ajax({
        url      : 'http://api.b.st-hatena.com/entry.count?url='+ url,
        dataType : 'jsonp',
        success  : function(json){ $('#' + postid + ' .hatena .count').text( json || 0 ); }
    });
    $.ajax({
        cache: false,
        type: "POST",
        url: "https://clients6.google.com/rpc?key=AIzaSyCKSbrvQasunBoV16zDH9R33D88CeLr9gQ",
        data: [{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"http://www.test.com","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}],
        dataType: "jsonp",
        success  : function(json){ $('#' + postid + ' .google .count').text( json || 0 ); }
    });
}

window.___gcfg = {lang: 'ja'};
(function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
})();



//SNS
function sharrre_count() {
// $('#twitter').sharrre({
//   share: {
//     twitter: true
//   },
//   enableHover: false,
//   enableTracking: true,
//   click: function(api, options){
//     api.simulateClick();
//     api.openPopup('twitter');
//   }
// });
    $('#facebook').sharrre({
        share: {
            facebook: true
        },
        enableHover: false,
        enableTracking: true,
        click: function(api, options){
            api.simulateClick();
            api.openPopup('facebook');
        }
    });
    $('#googleplus').sharrre({
        share: {
            googlePlus: true
        },
        enableHover: false,
        enableTracking: true,
        click: function(api, options){
            api.simulateClick();
            api.openPopup('googlePlus');
        }
    });
}



//Category List
$(function() {
    $('div#rightContent .categoryName li a').prepend('<i></i>');
})
