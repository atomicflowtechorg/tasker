    function getTasks(data){
        $("#content article").html(data);
    }

    function checkTasks(){
        $.ajax({
            type: "GET",
            url: "http://localhost/tasker/index.php/individual",

            async: true, /* If set to non-async, browser shows page as "Loading.."*/
            cache: false,
            timeout:50000, /* Timeout in ms */

            success: function(data){ /* called when request to barge.php completes */
                getTasks(data); /* Add response to a .msg div (with the "new" class)*/
                setTimeout(
                    'checkTasks()', /* Request next message */
                    5000 /* ..after 1 seconds */
                );
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                addmsg("error", textStatus + " (" + errorThrown + ")");
                setTimeout(
                    'checkTasks()', /* Try again after.. */
                    "15000"); /* milliseconds (15seconds) */
            }
        });
    };

    $(document).ready(function(){
        var currentPage = "";
        checkTasks(); /* Start the inital request */
    });