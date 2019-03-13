// on modal hide
$('#the-modal').on('hide.bs.modal', function() {
  $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
  $("#modal-form").trigger("reset");
  $('#modal-form').find("input[type=text]").val("");
  $('#modal-form').find("select").val("0");
  $('#modal-select-acadType').val(null);
})

$('.modal').on('hide.bs.modal', function() {
  $('.alert').hide();
})

// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");

  if($('#the-modal').attr('data-id') == "")
  {
    $('#modal-label').text("新增資料");
    $('#file-input-label').text("上傳檔案");
    if (!$('#errordiv').length) 
    {
      let type = $($.find('.tab-pane.active')[0]).attr('id').slice(-1);
      // set selected for acadType
      $('#modal-select-acadType').val(type);
    }
  }else
  {
    let el = $(".edit-item-trigger-clicked");
    let row = el.closest(".data-row");

    // get the data
    let acadYear = row.children(".acadYear").text();
    let title = row.children(".course-Title").text();

    if(el.length != 0)
    {
       // we're editing an existing row fo rthe first time, 
       // meaning that the fields should be filled by data on the row.
       // For fail validation, old function on the blade will take care of it.

      // fill the data in the input fields
      $("#modal-input-acadYear").val(acadYear);
      $("#modal-input-title").val(title);
      let type = $($.find('.tab-pane.active')[0]).attr('id').slice(-1);
      // set selected for acadType
      $('#modal-select-acadType').val(type);
    }

    $('#modal-label').text("編輯資料");
    $('#file-input-label').text("上傳檔案 (若無需更新請留空)");
  }
})

// submit form
$('#submitModal').on("click",  function() {
  let id = $(".edit-item-trigger-clicked").closest(".data-row").data("id");
  if(id == undefined)
  {
    id = $("#the-modal").data("id");
  }
  $("#modal-form").attr('action', $('#modal-label').text() === "新增資料" ? "/course/rule" : "/course/rule/" + id);
  $("#method").val($('#modal-label').text() === "新增資料" ? "POST" : "PATCH");
  $("#modal-form").submit();
});