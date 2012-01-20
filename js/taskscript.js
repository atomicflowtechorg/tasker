
var currentAjaxContent = individual_url;

function loadLink(link, area, type) {
     type = typeof(type) != 'undefined' ? type: '#';
     
    $(type + area).animate({opacity:0}, function(){
        currentAjaxContent = $(link).attr("href");
        $.ajax({
            url: $(link).attr("href"),
            cache: false,
            success: function(html){
                $(type + area).animate({opacity:1}).html(html);
            }
        });
    });
}

$(document).ready(function(){
    $("#appnav li").blend();
    $('#appnav').hide();
    $('#appnav').animate({opacity:1});
    //******* ajax load link data *******************************************************
    $(".ajax_anchor_load").live("click", function(){
        loadLink(this, "listView", '.');
        return false;
    });

    $('#ca-container').contentcarousel({
        // speed for the sliding animation
        sliderSpeed		: 500,
        // easing for the sliding animation
        sliderEasing	: 'easeOutExpo',
        // speed for the item animation (open / close)
        itemSpeed		: 500,
        // easing for the item animation (open / close)
        itemEasing		: 'easeOutExpo',
        // number of items to scroll at a time
        scroll			: 1
    });   
    $("#selectTeamOption").live("change", function(){
        var teamName = $(this).val();
        teamName = teamName.replace(/\s/g,"-");
        var $ca = $(".ca-container");
        var link = "teams/show/" + teamName;
        $ca.animate({opacity:0},function () {
            $.ajax({
                url: link,
                cache: false,
                success: function (html) {
                    $ca.html(html);
                    $ca.contentcarousel();
                    $ca.animate({opacity:1});
                }
            });
        });
        return false;
    });
    $('#searchForm').submit(function () {
        var socket = io.connect();
        $(".listView").animate({opacity:0}, function () {
            var search = "searchBoxInput=" + $("#searchBoxInput").val();
            currentAjaxContent = $('#searchForm').attr("action") + "/" + $("#searchBoxInput").val();
            $.ajax({
                type: 'POST',
                url: $('#searchForm').attr("action"),
                data: search,
                success: function (html) {
                    $(".listView").animate({opacity:1}).html(html);
                }
            });
        });
        return false;
    });
}); // end ready function
