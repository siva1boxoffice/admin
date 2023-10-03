function filter_search(filter = "", pageno = "") {
	var action = base_url + "game/orders/my_sales/upcoming/filter_search/" + pageno;
	$.ajax({
		type: "POST",
		dataType: "json",
		url: action,
		data: { "filter": filter },
		success: function (list) {
			//$('#search_flag').val(filter);
			$('#no-more-tables').html("");
			$('#no-more-tables').html(list.sales);
		}
	});
}


function load_sales(pageno = '',row='',seller_id='') {
	$.ajax({
		type: "POST",
		dataType: "json",
		data : {'seller_id' : seller_id},
		url: base_url + 'game/orders/my_sales/upcoming/load_sales/' + pageno,
		success: function (list) {
			$('#no-more-tables').html("");
			$('#no-more-tables').html(list.sales);
		}
	})

}

function load_filtersales(pageno = "") {
	$.ajax({
		type: "POST",
		dataType: "json",
		url: base_url + 'game/orders/my_sales/upcoming/filter_sales/' + pageno,
		data: $('#filter-formsales').serialize(),
		success: function (list) {			
			$('#no-more-tables').html("");
			$('#no-more-tables').html(list.sales);
			$('.close-panel').trigger("click");
		}
	})

}
$( "#filter-formsales" ).submit(function( event ) {
	event.preventDefault();
	load_filtersales();
  });

