
function loadLink(link, area){
    $("#" + area).fadeOut(500, function(){
        $.ajax({
            url: $(link).attr("href"),
            cache: false,
            success: function(html){
                $("#" + area).fadeIn(500).html(html);
            }
        });
    });
}

$(document).ready(function(){
    $("#appnav li").blend();
    $('#appnav').hide();
    $('#appnav').fadeIn("fast");
	
	
	
    //******* ajax load link data *******************************************************
    $(".ajax_anchor_load").live("click", function(){
        loadLink(this, "content");
        return false;
    });

    $("a[rel]").live('click', function (e) {
        e.preventDefault(); //prevent default link action

        $(this).overlay({
            mask: '#3B5872',
            api: true,
            onBeforeLoad: function () {
                var wrap = this.getOverlay().find(".contentWrap");
                wrap.load(this.getTrigger().attr("href"));
            },
            load: true
        });
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
        $ca.fadeOut(function(){
            $.ajax({
                url: link,
                cache: false,
                success: function(html){
                    $ca.html(html);
                    $ca.contentcarousel();
                    $ca.fadeIn();
                }
            }); 
        });   
        return false;
    });
    
    $('#searchForm').submit(function() {
        $("#content").fadeOut(500, function(){
            var search = "searchBoxInput="+$("#searchBoxInput").val();
            $.ajax({
                type: 'POST',
                url: $('#searchForm').attr("action"),
                data: search,
                success: function(html){
                    $("#content").fadeIn(500).html(html);
                }
            });
        });
        return false;
    });
	
})//end ready function
