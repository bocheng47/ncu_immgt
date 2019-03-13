// JS for tables
$('.content-table tbody tr').each(function(){
  $(this).find('th').first().addClass('first');
  $(this).find('th').last().addClass('last');
  $(this).find('td').first().addClass('first');
  $(this).find('td').last().addClass('last');
});

$('.content-table tbody tr').first().addClass('row-first');
$('.content-table tbody tr').last().addClass('row-last');

// scroll to shared row
$( document ).ready(function() {
  if(window.location.hash === "")
  {
    return;
  }

    $('[href="#tabAcadType'+$("a[id='"+window.location.hash.substr(1)+"']").closest(".tab-pane")[0].id.substr(-1)+'"]').tab('show');

    $("a[id='"+window.location.hash.substr(1)+"']").closest(".data-row").addClass('active');

  checkForChanges();
  
});

function checkForChanges()
{
    if ($("#preloader").css('display') == "none")
    {

      $('html, body').animate({scrollTop:$(window.location.hash).offset().top-110}, 500);
    }
    else
        setTimeout(checkForChanges, 100);
}