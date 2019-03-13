// JS for create button
$(document).on('click', "#create-item", function(e) {
  $('#the-modal').attr('data-id', "");
    let options = {
      'backdrop': 'static'
    };
    $('#the-modal').modal(options);
  })

// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");
})

// submit form
$('#submitModal').on("click",  function() {
  $("#modal-form").submit();
});