// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");

  if($('#the-modal').attr('data-id') == "")
  {
    $('#modal-label').text("新增資料");
  }else
  {
    let el = $(".edit-item-trigger-clicked");
    let row = el.closest(".data-row");

    // get the data
    let title = row.children(".course-Title").text();

    if(el.length != 0) // the first time calling this
    {
      // fill the data in the input fields
      $("#modal-input-title").val(title);
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
  $("#modal-form").attr('action', $('#modal-label').text() === "新增資料" ? "/course/paperrule" : "/course/paperrule/" + id);
  $("#method").val($('#modal-label').text() === "新增資料" ? "POST" : "PATCH");
  $("#modal-form").submit();
});