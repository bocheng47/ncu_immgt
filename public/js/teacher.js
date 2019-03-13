var count = 1;

$(".add_detail").on("click", function () {
	count++;
    $(".detail_edit_table").append('<tr class="detail_bar" id="detail_'+count+'">'+
                        '<td><input type="text" class="detail_add_bar" name="title[]"></td>'+
                        '<td><input type="text" class="detail_year" name="year[]"></td>'+
                        '<td><a type="button" class="detail_delete" id="detail_delete'+count+'">&nbsp<span class="glyphicon glyphicon-remove-circle"></span></a></td>'+
                    	'</tr>');
    $("#detail_delete"+count+"").on("click",function(){
		$("#detail_"+count+"").remove();
	});
});

$("#detail_delete1").on("click",function(){
	$("#detail_1").remove();
});
