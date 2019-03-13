// JS for delete button
$(document).on("click", "#delete-item", function(e) {
  e.stopPropagation();
});

// JS for create button
$(document).on('click', "#create-item", function(e) {
  $('#the-modal').attr('data-id', "");
    let options = {
      'backdrop': 'static'
    };
    $('#the-modal').modal(options);
  })

// JS for edit button
$(document).on('click', "#edit-item", function(e) {
  e.stopPropagation();
  $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
  let options = {
    'backdrop': 'static'
  };
  $('#the-modal').attr('data-id', $(".edit-item-trigger-clicked").closest(".data-row").data("id"));
  $('#the-modal').modal(options)
})

// JS for share button
$(document).on("click", ".btn.btn-social-icon", function(e) {
  e.stopPropagation();
});

// on modal hide
$('#the-modal').on('hide.bs.modal', function() {
  $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
  $("#modal-form").trigger("reset");
  $('#modal-form').find("input[type=text]").val("");
  $('#modal-form').find("select").val("0");
})

$('.modal').on('hide.bs.modal', function() {
  $('.alert').hide();
})

// credit goes to @Powerlord
// https://stackoverflow.com/u/15880
jQuery.fn.fadeThenSlideToggle = function(speed, easing, callback) {
  if (this.is(":hidden")) {
    return this.slideDown(speed, easing).fadeTo(speed, 1, easing, callback);
  } else {
    return this.fadeTo(speed, 0, easing).slideUp(speed, easing, callback);
  }
};

// disappear success div after .8 secs
$( document ).ready(function() {
  if($("#successdiv").length <= 0)
  {
    return;
  }

  $("#successdiv").delay(800).fadeThenSlideToggle(1000);
});

