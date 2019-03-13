// JS for edit button
// $(document).on('click', "#edit-activity-{{$activity->id}}", function(e) {
//     e.stopPropagation();
//     $(this).addClass('edit-item-trigger-clicked'); //useful for identifying which trigger was clicked and consequently grab data from the correct row and not the wrong one.
  //   var options = {
  //     'backdrop': 'static'
  //   };
  //   $('#the-modal').modal(options)
  // })

// on modal show
// $('#the-modal').on('show.bs.modal', function() {
//   var el = $(".edit-item-trigger-clicked");
//   var row = el.closest(".data-row");

//   // get the data
//   var acadYear = row.children(".acadYear").text();
//   var title = row.children(".title").text();
//   var filename = row.children(".filename").text();

  // prevent modal appear under background
  // $('#the-modal').appendTo("body");

  // // fill the data in the input fields
  // $("#modal-input-acadYear").val(acadYear);
  // $("#modal-input-title").val(title);
  // $("#modal-input-filename").val(filename);

  // var type = $($.find('.tab-pane.fade.in.active')[0]).attr('id').slice(-1);

  // set selected for eduType
//   $('#eduType').val(type);
// })

// on modal hide
// $('#the-modal').on('hide.bs.modal', function() {
//   $('.edit-item-trigger-clicked').removeClass('edit-item-trigger-clicked')
//   $("#modal-form").trigger("reset");
// })