
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha512-bnIvzh6FU75ZKxp0GXLH9bewza/OIw6dLVh9ICg0gogclmYGguQJWl8U30WpbsGTqbIiAwxTsbe76DErLq5EDQ==" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha512-c4wThPPCMmu4xsVufJHokogA9X4ka58cy9cEYf5t147wSw0Zo43fwdTy/IC0k1oLxXcUlPvWZMnD8be61swW7g==" crossorigin="anonymous"></script>

<script type="text/javascript">
	$(document).ready(function(){

		$("#register-link").click(function(){

			$("#login-box").hide();
			$("#register-box").show();

		});

		$("#login-link").click(function(){

			$("#register-box").hide();
			$("#login-box").show();

		});

		$("#forgot-link").click(function(){

			$("#login-box").hide();
			$("#forgot-box").show();




		});

		$("#back-link").click(function(){

			$("#forgot-box").hide();
			$("#login-box").show();

		});

	// register Ajax Request
	$("#register-btn").click(function(e){

		if($("#register-form")[0].checkValidity()){
			e.preventDefault();
			$("#register-btn").val('Please Wait...');

			if($("#rpassword").val() != $("#cpassword").val()){

				$("#passError").text('* Password Did not Matched!');

				$("#register-btn").val('Sign Up');

			}else{
				
				$("#passError").text('');

				$.ajax({
					url: 'themes/php/action.php',
					method: 'post',
					data: $("#register-form").serialize()+'&action=register',
					success:function(response){
						$("#register-btn").val('Sign Up');
						if(response === 'register'){
							window.location = 'home.php';
						}else{
							$("#regAlert").html(response);
						}

					}

				});


			}


		}


	});
	
	// Login Ajax code

	$("#login-btn").click(function(e){

		if($("#login-form")[0].checkValidity()){

			e.preventDefault(); // it means .. when user click submit .. u tell the browser stop let me do some proccess b4 redirect to page

			$("#login-btn").val('Please Wait...');


			$.ajax({
				url: 'themes/php/action.php',
				method: 'post',
				data: $("#login-form").serialize()+'&action=login',
				success:function(response){
					$("#login-btn").val('Sign In');
					if(response === 'login'){
						window.location = 'home.php';

					}else{
						$("#loginAlert").html(response);
					}

				}

			});





		}


	});

	/// Forgot Password Ajax Code

	$("#forgot-btn").click(function(e){

		if($("#forgot-form")[0].checkValidity()){
			e.preventDefault();
			$("#forgot-btn").val('Please Wait ...');

			$.ajax({
				url:'themes/php/action.php',
				method: 'post',
				data: $("#forgot-form").serialize()+'&action=forgot',
				success:function(response){

					$("#forgot-btn").val('Reset Password');

					$("#forgot-form")[0].reset();

					$("#forgotAlert").html(response);
					

				}



			});

		}


	});





}); 
</script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(document).ready(function(){

		

		// Add New Month Ajax Request

		$("#addMonthBtn").click(function(e){

			if($("#add-Month-form")[0].checkValidity()){

				e.preventDefault();


				$("#addMonthBtn").val('Please Wait ...');

				$.ajax({
					url:'themes/php/process.php',
					method:'post',
					data: $("#add-Month-form").serialize()+'&action=add_month',
					success:function(response){
						$("#addMonthBtn").val('Add New Month');
						$("#add-Month-form")[0].reset();
						$("#addMonthModal").modal('hide');
						Swal.fire({
							title: 'Month Added successfully!',
							type: 'success'		

						});
						displayAllMonths();

					}

				});
			}
		});





		


		/// handle month id and deleiver to add form

		$("body").on("click",".itemBtn", function(e){

			e.preventDefault();

			month_id = $(this).attr('id');

			$.ajax({

				url: 'themes/php/process.php',
				method: 'post',
				data: { month_id: month_id },
				success:function(response){

					//alert(response);
					data = JSON.parse(response);

					//console.log(response);
					

				$("#month_id").val(data.id);        // fetch the data in input


			}

		});


		});





		// Add New item Ajax Request

		$("#addItemBtn").click(function(e){

			if($("#add-Item-form")[0].checkValidity()){

				e.preventDefault();

				

				$("#addItemBtn").val('Please Wait ...');

				$.ajax({
					url:'themes/php/process.php',
					method:'post',
					data: $("#add-Item-form").serialize()+'&action=add_item',
					success:function(response){
						$("#addItemBtn").val('Add New Item');
						$("#add-Item-form")[0].reset();
						$("#addItemModal").modal('hide');
						Swal.fire({
							title: 'Item Added successfully!',
							type: 'success'		

						});
						displayAllMonths();
						
						

					}

				});
			}
		});

		/// handle month id and deleiver to add Balance Form
		$("body").on("click",".walletBalance", function(e){

			e.preventDefault();

			month_id = $(this).attr('id');

			$.ajax({

				url: 'themes/php/process.php',
				method: 'post',
				data: { month_id: month_id },
				success:function(response){

					//alert(response);
					data = JSON.parse(response);

					//console.log(response);
					

				$("#balance_month_id").val(data.id);        // fetch the data in input


			}

		});


		});


			// Add New item Ajax Request

			$("#addBalanceBtn").click(function(e){

				if($("#add-Balance-form")[0].checkValidity()){

					e.preventDefault();



					$("#addBalanceBtn").val('Please Wait ...');

					$.ajax({
						url:'themes/php/process.php',
						method:'post',
						data: $("#add-Balance-form").serialize()+'&action=edit_balance',
						success:function(response){
							$("#addBalanceBtn").val('Add To Wallet');
							$("#add-Balance-form")[0].reset();
							$("#addBalanceModal").modal('hide');
							Swal.fire({
								title: 'New Balance Added successfully!',
								type: 'success'		

							});
							displayAllMonths();



						}

					});
				}
			});

			// Delete item of User ajax Request

			$('body').on("click", ".deleteItemBtn",function(e){

				e.preventDefault();

				del_id = $(this).attr('id');

				Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url:'themes/php/process.php',
							method: 'post',
							data: {del_id: del_id},
							success:function(response){
								Swal.fire(
									'Deleted!',
									'Your Item has been deleted Successfully!.',
									'success'
									)
								displayAllMonths();
							}

						});

					}
				})

			});


			$('body').on("click", ".deleteMonthBtn",function(e){

				e.preventDefault();

				del_month_id = $(this).attr('id');

				Swal.fire({
					title: 'Are you sure?',
					text: "You won't be able to revert this!",
					type: 'warning',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes, delete it!'
				}).then((result) => {
					if (result.value) {
						$.ajax({
							url:'themes/php/process.php',
							method: 'post',
							data: {del_month_id: del_month_id},
							success:function(response){
								Swal.fire(
									'Deleted!',
									'Your Month has been deleted Successfully!.',
									'success'
									)
								displayAllMonths();
							}

						});

					}
				})

			});


			/// handle Edit Form display item details in edit item form
			

			
			$("body").on("click",".EditItemBtn", function(e){

				e.preventDefault();

				items_id = $(this).attr('id');

				$.ajax({

					url: 'themes/php/process.php',
					method: 'post',
					data: { items_id: items_id },
					success:function(response){

						data = JSON.parse(response);


					$("#itemid").val(data.id);        // fetch the data in input
					$("#nameEdit").val(data.item_name);
					$("#itemPriceEdit").val(data.item_price);

				}

			});


			});



			// Add New item Ajax Request

			$("#addEditItemBtn").click(function(e){

				if($("#Edit-Item-form")[0].checkValidity()){

					e.preventDefault();



					$("#addEditItemBtn").val('Please Wait ...');

					$.ajax({
						url:'themes/php/process.php',
						method:'post',
						data: $("#Edit-Item-form").serialize()+'&action=edit_item',
						success:function(response){
							$("#addEditItemBtn").val('Add To Wallet');
							$("#Edit-Item-form")[0].reset();
							$("#EditItemModal").modal('hide');
							Swal.fire({
								title: 'New Item Updated successfully!',
								type: 'success'		

							});
							displayAllMonths();



						}

					});
				}
			});



			displayAllMonths();

			function displayAllMonths(){

				$.ajax({

					url: 'themes/php/process.php',
					method: 'post',
					data: {action:'display_months'},
					success:function(response){
						$('#showMonths').html(response);

					}

				});

			}

		// Edit Notes Of user , Ajax Request


		/*$("body").on("click",".editBtn", function(e){

			e.preventDefault();

			edit_id = $(this).attr('id');

			$.ajax({

				url: 'themes/php/process.php',
				method: 'post',
				data: { edit_id: edit_id },
				success:function(response){

					data = JSON.parse(response);

					$("#id").val(data.id);        // fetch the data in input
					$("#title").val(data.title);
					$("#note").val(data.note);

				}

			});


		});*/



		// Update Note of current user, Ajax Request

		/*$("#editNoteBtn").click(function(e){

			if($("#edit-note-form")[0].checkValidity()){

				e.preventDefault();

				$.ajax({

					url: 'themes/php/process.php',
					method: 'post',
					data: $("#edit-note-form").serialize()+"&action=update_note",

					success:function(response){

						Swal.fire({
							title: 'Note Updated successfully!',
							type: 'success'		
						});
						$("#editNoteModal").modal('hide');
						displayAllNotes();

					}


				});

			}		


		});*/



		// Delete Note of User ajax Request

		/*$('body').on("click", ".deleteBtn",function(e){

			e.preventDefault();

			del_id = $(this).attr('id');

			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				type: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value) {
					$.ajax({
						url:'themes/php/process.php',
						method: 'post',
						data: {del_id: del_id},
						success:function(response){
							Swal.fire(
								'Deleted!',
								'Your Note has been deleted Successfully!.',
								'success'
								)
							displayAllNotes();
						}

					});
					
				}
			})

		});

		// Display All notes of User in View Section


		$("body").on("click",".infoBtn", function(e){

			e.preventDefault();

			info_id = $(this).attr('id');

			$.ajax({

				url: 'themes/php/process.php',
				method: 'post',
				data: { info_id: info_id},
				success:function(response){
					data = JSON.parse(response);
					
					Swal.fire({
						title: '<strong>Note : ID('+data.id+')</strong>',
						type :  'info',
						html: '<b>Title : </b>'+data.title+'<br><br><b>Note : </b>'+data.note+'<br><br><b>Created On: </br>'+data.created_at+
						'<br><br><b> Update On : </b>'+data.updated_at,
						showCloseButton:true,


					});
				}


			});




		});*/








		// Display All Months of User
		


	});
</script>
</body>
</html>