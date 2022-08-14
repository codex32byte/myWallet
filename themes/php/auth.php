<?php


require_once'config.php';

/**
* 
*/
class Auth extends Database{
	// Regsiter New User
	public function register($name,$email,$password){

		$sql = "INSERT INTO users (name,email,password) VALUES (:name, :email, :pass)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['name'=>$name, 'email'=>$email, 'pass'=>$password]);
		return true;	

	}

	//check if user already registered

	public function user_exist($email){
		$sql = "SELECT email FROM users WHERE email =:email";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);

		$result = $stmt->fetch();
		return $result;
	}



	// login existing user

	public function login($email){

		$sql = "SELECT email, password FROM users WHERE email = :email  AND deleted != 0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		return $row;


	}

	// getting session data

	public function currentUser($email){

		$sql = "SELECT * FROM users WHERE email = :email AND deleted !=0";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email]);
		$row = $stmt->fetch();

		return $row;

	}



	/// Forgot Password 


	public function forgot_password($token,$email){


		$sql = "UPDATE users SET token = :token, token_expire = DATE_ADD(NOW(), INTERVAL 10 MINUTE) WHERE email = :email"; 
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['token'=>$token, 'email'=>$email]);

		return true;


	}



	// Reset password Auth

	public function reset_pass_auth($email,$token){

		$sql = "SELECT id FROM users WHERE email = :email AND token = :token  AND token !='' AND token_expire > NOW() AND deleted !=0 ";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['email'=>$email, 'token'=>$token ]);

		$row = $stmt->fetch();

		return $row;

	}


	//Update New  Password

	public function update_new_pass($pass,$email){

		$sql  = "UPDATE users SET token ='' , password = :pass WHERE email =:email AND deleted !=0 ";
		$stmt= $this->conn->prepare($sql);
		
		$stmt->execute(['pass'=>$pass, 'email'=> $email]);

		return true;



	}


	//Add New Month

	public function add_new_month($uid,$walletLimit){

		$sql = "INSERT INTO months(u_id,month_date,month_balance, month_limit) VALUES(:uid, now(), :balance, :mlimit)";
		$stmt=$this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid, 'balance'=>$walletLimit, 'mlimit'=>$walletLimit]);

		return true;
	}


	// FetchAll (Get All) User items

	public function get_items($uid){

		$sql = "SELECT * FROM items WHERE u_id =:uid  ORDER BY item_date DESC";
		$stmt= $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid]);
		$result = $stmt->fetchAll();


		return $result;
	}	

// FetchAll (Get All) User Months created

	public function get_months($uid){

		$sql = "SELECT * FROM months WHERE u_id =:uid ORDER BY month_date DESC";
		$stmt= $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$uid]);
		$result = $stmt->fetchAll();

		return $result;
	}	


	// get the id of month to deleiver add form

	public function get_items_id($id){

		$sql = "SELECT * FROM months WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch();

		return $result;


	}


	//  add  item to user month

	public function add_item($userID,$monthID,$item_name,$item_price){


		$sql = "INSERT INTO items(u_id, m_id, item_name, item_price, item_date) VALUES(:uid, :mid, :itemName, :itemPrice, now())";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['uid'=>$userID, 'mid'=>$monthID, 'itemName'=>$item_name, 'itemPrice'=>$item_price ]);

		return true;



	}

	//  Calculation proccess of Final Balance

	public function insert_lastBalance($LastBalance,$mid,$cid){


		$sql = "UPDATE months SET month_balance = :balanceMonth WHERE id =:mid AND u_id = :uid ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['balanceMonth'=>$LastBalance, 'mid'=>$mid, 'uid'=>$cid]);

		return true;



	}

	//  Insert Edited Balance To month

	public function insert_EditedBalance($MonthLastBalance,$MonthLimitBalance,$Bmid,$cid){


		$sql = "UPDATE months SET month_balance = :balanceMonth, month_limit =:balanceLimit WHERE id =:Bmid AND u_id = :uid ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['balanceMonth'=>$MonthLastBalance,'balanceLimit'=>$MonthLimitBalance, 'Bmid'=>$Bmid, 'uid'=>$cid]);

		return true;



	}



	//Delete User item

	public function delete_item_from_month($id,$cid){

		$sql = "DELETE FROM items WHERE id =:id AND u_id = :uid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id,'uid'=>$cid]);

		return true;





	}


// get the pprice of item to minus it from total balance

	public function get_items_by_id($id){

		$sql = "SELECT * FROM items WHERE id = :id";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id]);

		$result = $stmt->fetch();

		return $result;


	}

// get the total  balaance of  month

	public function get_month_balance($monthID,$cid){

		$sql = "SELECT * FROM months WHERE id = :mid AND u_id = :cid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['mid'=>$monthID,'cid'=>$cid]);

		$result = $stmt->fetch();

		return $result;


	}


//  Insert New Balance After  Deleted items  To month

	public function insert_NewBalance($inserted_balance,$mid,$cid){


		$sql = "UPDATE months SET month_balance = :balanceMonth WHERE id =:mid AND u_id = :uid ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['balanceMonth'=>$inserted_balance, 'mid'=>$mid, 'uid'=>$cid]);

		return true;



	}



	//Delete User Month

	public function delete_month($id,$cid){

		$sql = "DELETE FROM months WHERE id =:id AND u_id = :uid";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['id'=>$id,'uid'=>$cid]);

		return true;





	}

//  Insert Item Edit user

	public function insert_editItem($item_name,$item_price,$item_id,$cid){


		$sql = "UPDATE items SET item_name = :itemName, item_price = :itemPrice WHERE id =:itemid AND u_id = :uid ";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['itemName'=>$item_name,'itemPrice'=>$item_price, 'itemid'=>$item_id, 'uid'=>$cid]);

		return true;



	}


// count the realttime balance

	public function realtime_balance($cid,$mid){

		$sql = "SELECT  SUM(item_price) AS Total_i_price, m_id AS Month FROM items WHERE u_id = :cid AND m_id = :mid Group By Month";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['cid'=>$cid,'mid'=>$mid]);
		$row = $stmt->fetch();

		return $row;

	}






}

?>
