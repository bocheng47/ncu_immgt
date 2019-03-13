// on modal show
$('#the-modal').on('show.bs.modal', function() {
  // prevent modal appear under background
  $('#the-modal').appendTo("body");

  if($('#the-modal').attr('data-id') == "")
  {
    $('#modal-label').text("新增資料");
    if($("#modal-input-date").val() == "")
    {
	    let today = new Date();
		let dd = today.getDate();
		let mm = today.getMonth()+1; //January is 0!
		let yyyy = today.getFullYear();

		if(dd<10) {
		    dd = '0'+dd
		} 

		if(mm<10) {
		    mm = '0'+mm
		} 

		today = yyyy + '-' + mm + '-' + dd;
		$("#modal-input-date").val(today);
	}
  }else
  {
    let el = $(".edit-item-trigger-clicked");
    let row = el.closest(".data-row");

    // get the data
    let title = row.children(".course-Title").text();
    let date = row.children(".create_date").text();

    if(el.length != 0) // the first time calling this
    {
      // fill the data in the input fields
      $("#modal-input-title").val(title);
      $("#modal-input-date").val(date);
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
  $("#modal-form").attr('action', $('#modal-label').text() === "新增資料" ? "/course/waiver" : "/course/waiver/" + id);
  $("#method").val($('#modal-label').text() === "新增資料" ? "POST" : "PATCH");
  $("#modal-form").submit();
});