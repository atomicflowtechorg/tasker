/* Author: Lucas Paulger*/
var dashboard = {
    loadLink: function loadLink(link, area, type) {
        type = typeof(type) != 'undefined' ? type: '#';
     
        $(type + area).animate({
            opacity:0
        }, function(){
            $.ajax({
                url: $(link).attr("href"),
                cache: false,
                success: function(html){
                    $(type + area).animate({
                        opacity:1
                    }).html(html);
                }
            });
        });
        return false;
    },
    slideLink: function slideLink(url){
        $.ajax({
            url: url,
            cache: false,
            success: function(html){
                $('.listView').hide("slide", {
                    direction: "left"
                }, 1000, function(){
                    $(this).html(html)
                }).show("slide", {
                    direction: "left"
                }, 1000);
            }
        });
        $container = $(this).parent('.listView');
        $container.show('slide', {
            direction: 'right'
        }, 1000);
        
        return false;     
    },
    teamSelect: function teamSelect(teamName){
        teamName = teamName.replace(/\s/g,"-");
        var $ca = $(".ca-container");
        var link = "teams/show/" + teamName;
        $ca.animate({
            opacity:0
        },function () {
            $.ajax({
                url: link,
                cache: false,
                success: function (html) {
                    $ca.html(html);
                    $ca.contentcarousel();
                    $ca.animate({
                        opacity:1
                    });
                }
            });
        });
        return false;
    },
    submit: function submit(){
        var socket = io.connect();
        $(".listView").animate({
            opacity:0
        }, function () {
            var search = "searchBoxInput=" + $("#searchBoxInput").val();
            currentAjaxContent = $('#searchForm').attr("action") + "/" + $("#searchBoxInput").val();
            $.ajax({
                type: 'POST',
                url: $('#searchForm').attr("action"),
                data: search,
                success: function (html) {
                    $(".listView").animate({
                        opacity:1
                    }).html(html);
                }
            });
        });
        return false;
    },
    
    taskUpdate: function taskUpdate(url, form){
        var task = JSON.stringify($(form).serializeObject());
        $.ajax({
            type: 'POST',
            url: url,
            data: task,
            dataType: json,
            success: function(data){
               $('.listView').hide("slide", {
                    direction: "left"
                }, 1000, function(){
                    $(this).html(data)
                }).show("slide", {
                    direction: "left"
                }, 1000);
            }
        });
        return false;
    }
}


$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};



$(document).ready(function(){
    $("#appnav li").blend();
    $('#appnav').hide();
    $('#appnav').animate({
        opacity:1
    });
    
    $('.slide').live('click', function(){
        var url = $(this).attr("href");
        return dashboard.slideLink(url);
    });
    
    $(".ajax_anchor_load").live("click", function(){
        return dashboard.loadLink(this, "listView", '.');
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
        return dashboard.teamSelect(teamName);
    });
    
    $('#searchForm').submit(function () {
        return dashboard.submit();
    });
    
    $('.taskUpdate').live("submit",function(){
        var form = $(this);
        var url = $(this).attr("action");
        dashboard.taskUpdate(url, form); 
        return false;
    });
}); // end ready function
