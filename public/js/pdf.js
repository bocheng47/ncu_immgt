// JS for create button
$(document).on('click', "#create-item", function(e) {
  $('#the-modal').attr('data-id', "");
    var options = {
      'backdrop': 'static'
    };
    $('#the-modal').modal(options);
  })

// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");
})

// on modal hide
$('#the-modal').on('hide.bs.modal', function() {
  $("#modal-form").trigger("reset");
})

// submit form
$('#submitModal').on("click",  function() {
    $("#modal-form").submit();
  });
