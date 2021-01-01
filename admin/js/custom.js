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

		//Add new user form submit
		$(document).on('submit', 'form#add_user_form', function(event){
			event.preventDefault();

			$.ajax({
				url : 'templates/ajax/user_add.php',
				method : "POST",
				data : new FormData(this),
				contentType : false,
				processData : false,
				success : function(data){
					$('form#add_user_form')[0].reset();
					$('#add_user_modal').modal('hide');
					$('.mess').html(data);
				},
			});
		});
	});
})(jQuery)