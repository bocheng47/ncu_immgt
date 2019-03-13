// JS for create button
$(document).on('click', "#create-item", function(e) {
  $('#the-modal').attr('data-id', "");
    var options = {
      'backdrop': 'static'
    };
    $('#the-modal').modal(options);
  })

// JS for delete button
$(document).on("click", "#delete-item", function(e) {
  e.stopPropagation();
});

// JS for edit button
$(document).on('click', "#edit-item", function(e) {
  e.stopPropagation();
  $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
  var options = {
    'backdrop': 'static'
  };
  $('#the-modal').attr('data-id', $(".edit-item-trigger-clicked").closest(".user-row").data("id"));
  $('#the-modal').modal(options)
})


// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");

  if($('#the-modal').attr('data-id') == "")
  {
    $('#modal-label').text("新增帳號");
    $("#usermanage-type").show();
  }else
  {
    var el = $(".edit-item-trigger-clicked");
    var row = el.closest(".user-row");

    // get the data
    var name = row.children(".name").text();
    var userid = row.children(".userid").text();
    var usertype = (row.children(".usertype").text() == "系辦帳號" ? 0 : 1);

    if(el.length != 0)
    {
       // we're editing an existing row fo rthe first time, 
       // meaning that the fields should be filled by data on the row.
       // For fail validation, old function on the blade will take care of it.

      // fill the data in the input fields
      $("#name").val(name);
      $("#username").val(userid);
      $("#usertype").val(usertype);
    }

    $('#modal-label').text("編輯帳號");
    $("#usermanage-type").hide();
  }
})

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

// submit form
$('#submitModal').on("click",  function() {
    var id = $(".edit-item-trigger-clicked").closest(".user-row").data("id");
    if(id == undefined)
    {
      id = $("#the-modal").data("id");
    }
    $("#modal-form").attr('action', $('#modal-label').text() === "新增帳號" ? "/register" : "/usermanage/edit/" + id);
    $("#method").val($('#modal-label').text() === "新增帳號" ? "POST" : "PATCH");
    $("#modal-form").submit();
  });

