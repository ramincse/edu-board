(function($){
	$(document).ready(function(){
		/**
		 * User Management
		 */
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

		//All user data fetch
		function allUsers(){
			$.ajax({
				url : 'templates/ajax/user_all.php',
				success : function(data){
					$('tbody#all_users_tbody').html(data);
				}
			});
		}
		allUsers();

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
					allUsers();
				},
			});
		});

		//Delete User Data
		$(document).on('click', 'a#delete_user', function(e){
			e.preventDefault();

			let del = confirm('Are you sure ?');
			let id = $(this).attr('user_id');

			if ( del == true ) {
				$.ajax({
					url : 'templates/ajax/user_delete.php',
					method : "POST",
					data : { id : id },
					success : function(data){
						$('div.mess').html(data);
						allUsers();
					},
				});
			}else{
				return false;
			}
			
		});

		/**
		 * Student Management
		 */
		//Add new Student modal
		$(document).on('click', 'a#add_student_btn', function(){
			$('#add_student_modal').modal('show');

			return false;
		});

		//
		$(document).on('submit', 'form#add_student_form', function(e){
			e.preventDefault();

			let name	= $('form#add_student_form input[name="name"]').val();
			let roll	= $('form#add_student_form input[name="roll"]').val();
			let reg		= $('form#add_student_form input[name="reg"]').val();

			if ( name == '' || roll == '' || reg == '' ) {
				$('.student-mess').html('<p class="alert alert-danger">All fields are required !<button class="close" data-dismiss="alert">&times;</button></p>');
			}else{
				$.ajax({
					url : 'templates/ajax/student_add.php',
					method : "POST",
					data : new FormData(this),
					contentType : false,
					processData : false,
					success : function(data){
						$('form#add_student_form')[0].reset();
						$('#add_student_modal').modal('hide');
						$('.mess').html('<p class="alert alert-success">Student added successfull !<button class="close" data-dismiss="alert">&times;</button></p>');
					},
				});
			}
			//alert(name + roll + reg);
		});








	});
})(jQuery)