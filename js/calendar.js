$(document).ready(function() {
	$('.calendar .day').click(function(){
		day_num = $(this).find('.day_number').html();
		day_data = prompt('Unesite događaj.', $(this).find('.content').html());
		if (day_data != null ) {
			$.ajax({
				url: window.location,
				type: 'POST',
				data: {
					day: day_num,
					data: day_data
				},
				success: function(msg){
					location.reload();
				}
			});
		};
	});
//});