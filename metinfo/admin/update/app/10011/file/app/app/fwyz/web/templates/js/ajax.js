$(".ui-from").submit(function () {
    return false;
});
$(".yy_submit").click(function () {
    if($("#sscenter").length == 0){
        $("#input").after('<div id="sscenter" class="yy_bottom"></div>');
    }
    var code = $("input[name=code]").val();
    $.ajax({
        type: "POST",
        url: $(".ui-from").attr('action'),
        data: {"code": code},
        dataType: "text",
        success: function (dtext) {
            $("#sscenter").empty().append(dtext);
        },
        error: function (jqXHR, textStatus, errorMsg) {
            $("#sscenter").empty();
            alert("error:" + errorMsg);
        }
    });
});