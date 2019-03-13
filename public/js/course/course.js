// JS for adding link
$(document).on("click", ".content-table tbody tr", function() {
  window.location = $(this).data("url");
  $(this).removeClass('active');
});

// scroll to shared row
$( document ).ready(function() {
  if(window.location.hash === "")
  {
    return;
  }

  let target_offset = $(window.location.hash).offset();
  let target_top = target_offset.top;

  $('html, body').animate({scrollTop:target_top-110}, 500);
      
  $("a[id='"+window.location.hash.substr(1)+"']").closest(".data-row").addClass('active');
});