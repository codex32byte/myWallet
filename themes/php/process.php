<?php
require_once('session.php');


// Handle Add New Note Ajax Request
if(isset($_POST['action']) && $_POST['action'] == 'add_month'){

	$walletLimit = $cuser->test_input($_POST['MonthWalletLimit']);
	

	$cuser->add_new_month($cid,$walletLimit);

}


//Display All user Notes 

if(isset($_POST['action']) && $_POST['action'] == 'display_months'){

	$output = "";


	

	$months = $cuser->get_months($cid);
	$items = $cuser->get_items($cid);




	if($months){

		foreach ($months as $month) {
			$created = $month['month_date'];
			$regs_on = date('d M Y', strtotime($created));
			$month_id = $month['id'];
			$total_expenses = $month['month_limit'] - $month['month_balance'];
			
		


			$output .= '<div class="col-md-6 mt-4">
			<div class="card">
				<div class="card-body">

					<input type ="hidden" value ="'.$month_id.'" id="month_id">
					<h6 class="card-subtitle text-center text-right">Month: '.$regs_on;






						$output  .= '</h6>
						
						
						<div><br></div>
						<h1 class="card-title text-center bg-success bg-gradient text-light text-center lead"> '."My Balance is : ".$month['month_balance'].' RB</h1>   <!-- My Wallet Balance -->
						<div></div>
						<h2 class="card-subtitle  text-light bg-danger">
							'." My Wallet Limit is: ".$month['month_limit'].'
						</h2>  <!-- My Wallet Limit -->
						
						<div  class="my-2"><div class="card-subtitle mb-2 text-muted">
							'." My Total Expenses is: ".$total_expenses.'
							<!-- My Wallet Limit --></div>';

							if($month["month_balance"] > "1"){
								$output  .='<div class="itemBtn" id="'.$month_id.'">
								<input type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#addItemModal" value="add item">

							</div>';
						}else{
							$output  .='<div class="text-center walletBalance" id="'.$month_id.'"">
							Sorry You Cant Add More item , Your balance is Minus ! <br>
							You Should Add More Balance<br>

							<input type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#addBalanceModal" value="add balance">

						</div>';

					}

					$output  .='</div>

					<br>
					<p class="card-text"> <!-- My items Details -->
						';	


							foreach($items as $item){ // anoher idea .. make query about select items compare itetm month id witth recnet id then echo

								if($item['m_id'] == $month['id'] ){

									$date = date('d-m-Y h:i A', strtotime($item['item_date']));
									$output .='<p class="card-text p-2 m-1 rounded" style="border:1px solid #0275d8;"><b>'.$item['item_name'] .'</b> | Price <b>'.$item['item_price'].' RB  | Date </b>'.
									$date;
									$output .= '<br>
									<a href="#" id=" '.$item['id'].'"  class="btn btn-danger  btn-sm deleteItemBtn">Delete</a>
									<a href="#" id=" '.$item['id'].'"  class="btn btn-primary btn-sm EditItemBtn"  data-toggle="modal" data-target="#EditItemModal" >Edit</a>';
								}
							}



							


							$output  .= '</p>
							<br>
							
							<div class="">
								<a href="#" id="'.$month['id'].'"class=" btn btn-secondary btn-sm deleteMonthBtn">Delete Month !</a>
							</div>
						</div>	
					</div>
				</div>';


			}

			

			echo $output;
		}else{
			echo '<h3 class="text-center text-secondary">:( You Dont Have any Inserted Months Wallet Yet! Create New Wallet Now !</h3>';
		}

	}


// handle Add item with id  Ajax Request

	if(isset($_POST['action']) && $_POST['action'] == 'add_item'){



		$mid = $cuser->test_input($_POST['month_id']);
		$item_name = $cuser->test_input($_POST['itemName']);
		$item_price = $cuser->test_input($_POST['itemPrice']);

		//  Calculation proccess of Final Balance
		$MonthBalance = $cuser->get_items_id($mid);
		$LastBalance = $MonthBalance['month_balance'] - $item_price;


		$cuser->add_item($cid,$mid,$item_name,$item_price);


		$cuser->insert_lastBalance($LastBalance,$mid,$cid);



		


		

	}





// Handle Add item ID Ajax Request
	if(isset($_POST['month_id'])){

		$id = $cuser->test_input($_POST['month_id']);

		$row = $cuser->get_items_id($id);

		echo json_encode($row);




	}


// handle Edit Month Balance Ajax Request

	if(isset($_POST['action']) && $_POST['action'] == 'edit_balance'){

		$Bmid = $cuser->test_input($_POST['balance_month_id']);
		$MonthAddedBalance = $cuser->test_input($_POST['month_balance']); // pure Added Balance

		$MonthBalance = $cuser->get_items_id($Bmid);	 // Get Month Limit @ Balance

		$MonthLimitBalance = $MonthAddedBalance + $MonthBalance['month_limit']; // New Month Limit

		$MonthLastBalance  = $MonthAddedBalance + $MonthBalance['month_balance']; // New Month Balance

		$cuser->insert_EditedBalance($MonthLastBalance,$MonthLimitBalance,$Bmid,$cid);  // insert Data



	}


//Handle delete item from month Action Ajax Requuest
	if(isset($_POST['del_id'])){

		$id = $cuser->test_input($_POST['del_id']);
		
		$items = $cuser->get_items_by_id($id);

		$item_price =  $items['item_price'];       /** Current Item Price**/

		$monthID = $items['m_id'];

		$months = $cuser->get_month_balance($monthID,$cid);

		$month_balance = $months['month_balance'];        /** Current Month Balance**/

		$inserted_balance = $month_balance + $item_price;   /** restore the item price to Balance again **/

		$cuser->insert_NewBalance($inserted_balance,$monthID,$cid); /** Insert New Month Balance**/


		$cuser->delete_item_from_month($id,$cid);
	}

//Handle delete month from user
	if(isset($_POST['del_month_id'])){

		$id = $cuser->test_input($_POST['del_month_id']);
		
		$cuser->delete_month($id,$cid);
	}




// Handle Display Item Details in Edit item Form  Ajax Request
	if(isset($_POST['items_id'])){

		$id = $_POST['items_id'];

		$rows = $cuser->get_items_by_id($id);

		echo json_encode($rows);



	}


// handle update the edit of Item-Editt-Form Ajax Request

	if(isset($_POST['action']) && $_POST['action'] == 'edit_item'){

		$item_id = $cuser->test_input($_POST['itemid']); 				// Get item  id  from the post form
		$item_name = $cuser->test_input($_POST['nameEdit']);			// Get item  name from the post form
		$item_priceNew = $cuser->test_input($_POST['itemPriceEdit']);   // Get item  price new from the post form

		$items = $cuser->get_items_by_id($item_id);                    // Get item current price from fetch DB
		$item_price = $items['item_price'];

		$item_price_official =   $item_priceNew - $item_price ;         // official pure price after edited should  be the result of both variables

		$monthID = $items['m_id'];
		$months = $cuser->get_month_balance($monthID,$cid);                   // ** Get Month current balance from fetch DB ** //

		$current_month_balance = $months['month_balance'];

		$inserted_balance = $current_month_balance - $item_price_official;    /** cut offical item  price from current month balance**/

		$cuser->insert_NewBalance($inserted_balance,$monthID,$cid);

		$cuser->insert_editItem($item_name,$item_priceNew,$item_id,$cid);


	



	}


//Handle Display Item in View Section Ajax Requuest

	if(isset($_POST['info_id'])){

		$id = $cuser->test_input($_POST['info_id']);

		$row = $cuser->edit_note($id);
		echo json_encode($row);
	}


	?>


