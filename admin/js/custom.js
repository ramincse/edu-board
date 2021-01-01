(function($){
	$(document).ready(function(){
		//Dash Menu Active
		// $(document).on('click', 'ul#dashmenu li', function(){
		// 	$('ul#dashmenu li').removeClass('active');
		// 	$(this).addClass('active');
		// });
		
		//Add new user modal
		$(document).on('click', 'a#add_user_btn', function(){
			$('#add_user_modal').modal('show');

			return false;
		});
	});
})(jQuery)