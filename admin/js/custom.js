(function($){
	$(document).ready(function(){
		/**
		 * User Management
		 */
		//Dash Menu Active
		// $(document).on('click', 'ul#dashmenu li', function(){
		// 	$('ul#dashmenu li').removeClass('active');
		// 	$(this).addClass('active');
		// });  sayed sodrul shuvo

		/**
		 * Message Alert Function
		 */
		function msgAlert(msg, type = 'success'){
			return '<p class="alert alert-' + type + '">' + msg + ' !<button class="close" data-dismiss="alert">&times;</button></p>';
		}

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

		//Add new student
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
						allStudent();
					},
				});
			}
		});

		//Show all student
		function allStudent(){
			$.ajax({
				url : 'templates/ajax/student_all.php',
				success : function(data){
					$('tbody#all_student').html(data);
				},
			});
		}
		allStudent();

		/**
		 * Result Management
		 */

		 //Add Result modal
		$(document).on('click', 'a#add_result_btn', function(){
			$('#add_result_modal').modal('show');

			return false;
		});

		//Student Search
		$(document).on('keyup', 'input#search_student', function(){
			let stu_val = $(this).val();

			$.ajax({
				url : 'templates/ajax/student_search.php',
				method : "POST",
				data : { stu_val : stu_val },
				success : function(data){
					$('.stu_reg').html(data);
				},
			});			
		});

		//Select a Student
		$('.student-reg-data').hide();
		$(document).on('click', 'li#student_select', function(){
			//Get all values
			let stu_id 		= $(this).attr('student_id');
			let stu_name 	= $(this).attr('student_name');
			let stu_roll 	= $(this).attr('student_roll');
			let stu_reg 	= $(this).attr('student_reg');
			let stu_pic 	= $(this).attr('student_pic');

			//Set Values
			$('input#search_student').val(stu_id);			
			$('.stu_reg').hide();
			$('label#idstudent').text('student ID');
			$('input#search_student').attr('disabled', '');

			//Single student data
			$('.student-reg-data').show();
			$('.student-reg-data img').attr('src', 'students/' + stu_pic);
			$('.student-reg-data h3').html(stu_name);
			$('.student-reg-data h4').html("<strong>Roll - </strong>" + stu_roll + ",<strong> Reg - </strong>" + stu_reg);		
		}); 

		//Student Result submit
		$(document).on('submit', 'form#add_student_result', function(e){
			e.preventDefault();
			$('input#search_student').removeAttr('disabled');

				$.ajax({
					url : 'templates/ajax/result_add.php',
					method : "POST",
					data : new FormData(this),
					contentType : false,
					processData : false,
					success : function(data){
						$('form#add_student_result')[0].reset()
						$('.student-reg-data').hide();
						$('#add_result_modal').modal('hide');
						$('.mess').html( msgAlert('Result added successfull') );
						//alert(data);
						// ;
						// $('#add_student_modal').modal('hide');
						// 
						// allStudent();
					},
				});		
		});

	});
})(jQuery)