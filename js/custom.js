/** Loader Funktion **/
$.fn.customLoader = function (action, image) {
    if (action == "start") {
        if (image == true) {
            return $(this).html('<div class="loadingImageContainerParent"><img id=loadingImageContainer src="imgs/loader.gif" /></div>');
        } else {
            $(this).children().hide();
            return $(this).addClass('loadingImageWrapper');
        }
    } else if (action == "stop") {
        if (image == true) {
            return $("#loadingImageContainer").remove();
        } else {
            $(this).children().show();
            return $(this).removeClass('loadingImageWrapper');
        }
    }
};

/** App **/
$(document).ready(function () {
    $("body").on("click", ".klein", function (event) {
        event.preventDefault();
    });
    $("body").on("click", "#scrollUp", function () {
        $("section").scrollTo($("#seite1"), 800);
    });
    $("body").on("click", "#scrollDown", function () {
        $("section").scrollTo($("#seite2"), 800);
    });

    $("body").on("click", "#uebersichtButton", function (event) {
        event.preventDefault();
        $.ajax({
            type: 'GET',
            url: 'fwlk.php?action=zeigeUebersicht',
            dataType: 'html',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Ajax-Request", "true");
                $("#view").customLoader("start", true);
            },
            success: function (reply) {
                $("#view").customLoader("stop", true);
                $(".klein").parent().remove();
                $("#dialog_fwlk").dialog('destroy').remove();
                $('#nav_sites, #menu_left').hide();
                $('#view').html(reply);
            }
        });
    });

    $("body").on("click", ".bmzLink a", function () {
        $bmz = $(this).data("bmz");
        $.ajax({
            type: 'GET',
            url: 'fwlk.php?action=zeigeGruppen&bmz=' + $bmz,
            dataType: 'html',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Ajax-Request", "true");
                $("#view").customLoader("start", true);
            },
            success: function (reply) {
                $("#view").customLoader("stop", true);
                $("#bmzUebersichtButton").remove();
                $("#mgOberLink").remove();
                $("#dialog_fwlk").dialog('destroy').remove();
                $('#nav_sites, #menu_left').hide();
                $("#nav_mg ul").append("<li class='bmzLink' id='bmzUebersichtButton'><a class='klein' data-bmz=" + $bmz + " href='#'>BMZ<br/>" + $bmz + "</a></li>");
                $('#bmzUebersichtButton a').addClass("active");
                $('#view').html(reply);

            }
        });
    });

    $("body").on("click", ".mgLink a, .alarmCenterLink", function () {
        $bmzNummer = $(this).data("bmz");
        $mg = $(this).data("mg");
        $bmz = "";
        if ($(this).data("bmz")) {
            $bmz = '&bmz=' + $(this).data("bmz");

        }
        $.ajax({
            type: 'GET',
            url: 'fwlk.php?action=zeigeMeldegruppe&mg=' + $mg + $bmz,
            dataType: 'json',
            beforeSend: function (xhr) {
                xhr.setRequestHeader("Ajax-Request", "true");
                $("#view").customLoader("start", true);
            },
            success: function (reply) {
                $('#nav_sites').show();
                $("#view").customLoader("stop", true);
                $("#mgOberLink").remove();
                $("#bmzUebersichtButton").remove();
                if ($("#uebersichtButton").data("modus") == "bmz") {
                    $("#nav_mg ul").append("<li class='bmzLink' id='bmzUebersichtButton'><a class='klein' data-bmz=" + $bmzNummer + " href='#'>BMZ<br/>" + $bmzNummer + "</a></li>");
                    $('#bmzUebersichtButton a').addClass("active");
                }
                $("#nav_mg ul").append("<li id='mgOberLink'><a class='klein' data-mg=" + $mg + " href='#'>MG<br/>" + $mg + "</a></li>");
                $('#mgOberLink a').addClass("active");

                $('#view').html(reply.view);
                $('#menu').html(reply.menu);
                $('#menu_left').show();
            }
        });
    });


    $("body").on("click", "#openVersion", function () {
        $('#dialog_version').dialog('open');
    });
});
