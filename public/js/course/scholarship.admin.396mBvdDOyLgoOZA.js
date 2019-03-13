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
    let acadYear = row.children(".acadYear").text();
    let title = row.children(".course-Title").text();
    let acadType = row.data("acadtype");

    if(el.length != 0) // the first time calling this
    {
      // fill the data in the input fields
      $("#modal-input-acadYear").val(acadYear);
      $("#modal-input-title").val(title);
      $('#modal-select-acadType').val(acadType);
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
  $("#modal-form").attr('action', $('#modal-label').text() === "新增資料" ? "/course/scholarship" : "/course/scholarship/" + id);
  $("#method").val($('#modal-label').text() === "新增資料" ? "POST" : "PATCH");
  $("#modal-form").submit();
});