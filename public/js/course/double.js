// JS for adding link
$(document).on("click", ".content-table tbody tr", function() {
  window.location = $(this).data("url");
});

// JS for delete button
$(document).on("click", "#delete-item", function(e) {
  e.stopPropagation();
});

// JS for create button
$(document).on('click', "#create-item", function(e) {
  $('#the-modal').attr('data-id', "");
    var options = {
      'backdrop': 'static'
    };
    $('#the-modal').modal(options);
  })

// JS for edit button
$(document).on('click', "#edit-item", function(e) {
    e.stopPropagation();
    $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
    var options = {
      'backdrop': 'static'
    };
    $('#the-modal').attr('data-id', $(".edit-item-trigger-clicked").closest(".data-row").data("id"));
    $('#the-modal').modal(options)
  })

// JS for share button
$(document).on("click", ".btn.btn-social-icon", function(e) {
  e.stopPropagation();
});

// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");

  if($('#the-modal').attr('data-id') == "")
  {
    $('#modal-label').text("新增資料");
  }else
  {
    var el = $(".edit-item-trigger-clicked");
    var row = el.closest(".data-row");

    $('#modal-label').text("編輯資料");
    $('#file-input-label').text("上傳檔案(若無需更新請留空)");
  }
})

// on modal hide
$('#the-modal').on('hide.bs.modal', function() {
  $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
  $("#modal-form").trigger("reset");
})

// submit form
$('#submitModal').on("click",  function() {
    var id = $(".edit-item-trigger-clicked").closest(".data-row").data("id");
    $("#modal-form").attr('action', $('#modal-label').text() === "新增資料" ? "/course/double" : "/course/double/" + id);
    $("#method").val($('#modal-label').text() === "新增資料" ? "POST" : "PATCH");
    $("#modal-form").submit();
  });