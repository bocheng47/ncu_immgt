// JS for changing file type (url or upload)
$( "#modal-select-uploadtype" )
  .change(function () {
    $('#modal-input-fileurl').val("");
    $('#modal-input-file').val("");
    $('.filearea').hide();
    $( "select option:selected" ).each(function() {
      $('#' + $( this ).val()).show();
    });
  })
  .change();

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
    $('#file-input-label').text("上傳檔案");
    if (!$('#errordiv').length) 
    {
      var type = $($.find('.tab-pane.active')[0]).attr('id').slice(-1);
      // set selected for filetype
      $('#modal-select-filetype').val(type);
    }
  }else
  {
    var el = $(".edit-item-trigger-clicked");
    var row = el.closest(".data-row");

    // get the data
    var fileYear = row.children(".fileYear").text();
    var title = row.children(".FileTitle").text();

    if(el.length != 0)
    {
       // we're editing an existing row fo rthe first time, 
       // meaning that the fields should be filled by data on the row.
       // For fail validation, old function on the blade will take care of it.

      // fill the data in the input fields
      $("#modal-input-fileYear").val(fileYear);
      $("#modal-input-title").val(title);
      var type = $($.find('.tab-pane.active')[0]).attr('id').slice(-1);
      // set selected for filetype
      $('#modal-select-filetype').val(type);

      if (row.hasClass('ext_url')) 
      {
        $('.filearea').hide();
        $('#modal-select-uploadtype').val('fileurl');
        $("#fileurl").show();

        $("#modal-input-fileurl").val(row.data("url"));
      }
      else
      {
        $('.filearea').hide();
        $('#modal-select-uploadtype').val('file');
        $("#file").show();
      }
    }

    $('#modal-label').text("編輯資料");
    $('#file-input-label').text("上傳檔案 (若無需更新請留空)");
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
    var id = $(".edit-item-trigger-clicked").closest(".data-row").data("id");
    if(id == undefined)
    {
      id = $("#the-modal").data("id");
    }
    $("#modal-form").attr('action', $('#modal-label').text() === "新增資料" ? "/files" : "/files/" + id);
    $("#method").val($('#modal-label').text() === "新增資料" ? "POST" : "PATCH");
    $("#modal-form").submit();
  });

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

