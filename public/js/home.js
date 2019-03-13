$('.modal').on('show.bs.modal', function() {
    // prevent modal appear under background
    $(this).appendTo("body");
});

$(".welcome-tab-ul a").on('click',function(){
    $(".tab-pane").hide();
    $($(this).attr("href")).show();
});

$(document).ready(function(){$(".tab-pane").hide();$('#welcometab0').show();});

$( "#home-new-homes" )
  .change(function () {
    if( $( "#home-new-homes" ).val() == "演講訊息")
    {
        $("#home-new-homes-time").text("過期時間");
    }
    else
    {
        $("#home-new-homes-time").text("活動時間");
    }
  })
  .change();