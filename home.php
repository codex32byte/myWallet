<?php
require_once('themes/php/session.php');
require_once('includes/templates/header.php');


$user = new Auth();
?>
<div class="container">


	<!-- Button trigger modal -->
	<div class="text-center">
		<button type="button" class="my-5 btn btn-primary btn-lg "  data-toggle="modal" data-target="#addMonthModal">
			Start New Month
		</button>
	</div>


	<!-- Modal -->
	<!-- Start Add New Note Modal -->

	<div class="modal fade" id="addMonthModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary bg-gradient">
					<h4 class="modal-title text-light">Add New Month</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post" id="add-Month-form" class="px-3">
						<div class="form-group text-center">
							<?php
							$date = date('d-m-Y');

							echo "Today Is: " .$date;

							?>
						</div>
						<div class="form-group">
							<input type="number" name="MonthWalletLimit" class="form-control form-control-lg" placeholder="Enter Wallet Limits" required>
						</div>
						<div class="form-group">
							<input type="submit" name="addMonth" id="addMonthBtn" value="Add New Month" class="btn btn-primary btn-block btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- Start Add New item Modal -->		

	<div class="modal fade" id="addItemModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary bg-gradient">
					<h4 class="modal-title  text-light">Add New item</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post" id="add-Item-form" class="px-3">
						<input type ="hidden" name ="month_id" id="month_id">
						<div class="form-group">
							<input type="text" name="itemName" class="form-control form-control-lg" placeholder="Type Kind Name" required>
						</div>
						<div class="form-group">
							<input type="number" name="itemPrice" class="form-control form-control-lg" placeholder="Enter Item Price" required>
						</div>
						<div class="form-group">
							<input type="submit" name="addItem" id="addItemBtn" value="Add New Item" class="btn btn-primary btn-block btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>





	<!-- End Add New item Modal -->



	<!-- Start Edit item Modal -->		

	<div class="modal fade" id="EditItemModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-primary bg-gradient">
					<h4 class="modal-title  text-light">Edit item</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post" id="Edit-Item-form" class="px-3">
						<input type ="hidden" name ="itemid" id="itemid">
						<div class="form-group">
							<input type="text" name="nameEdit" id="nameEdit" class="form-control form-control-lg" placeholder="Type Kind Name" required>
						</div>
						<div class="form-group">
							<input type="number" name="itemPriceEdit" id="itemPriceEdit" class="form-control form-control-lg" placeholder="Enter Item Price" value="" required>
						</div>
						<div class="form-group">
							<input type="submit" name="addItemEdit" id="addEditItemBtn" value="Update Item" class="btn btn-primary btn-block btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>





	<!-- End Edit item Modal -->


	<!-- End Add New Note Modal -->



	<div class="row" id="showMonths">



	</div>



	
	<!-- End Add New Note Modal -->



	<!-- Start Edit Wallet Balance Note Modal -->

	<div class="modal fade" id="addBalanceModal">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header bg-success text-light">
					<h4 class="modal-title ">Edit Wallet Balance</h4>
					<button type="button" class="close text-light" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					<form action="#" method="post" id="add-Balance-form" class="px-3">
						<input type ="hidden" name ="balance_month_id" id="balance_month_id">
						
						<div class="form-group">
							<input type="number" name="month_balance" class="form-control form-control-lg" placeholder="Add Balance" required>
						</div>
						<div class="form-group">
							<input type="submit" name="addBalance" id="addBalanceBtn" value="Add To Wallet" class="btn btn-success btn-block btn-lg">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>





	<!-- End Edit Wallet Balance Modal -->




















	<?php

	require_once('./includes/templates/footer.php');

	?>