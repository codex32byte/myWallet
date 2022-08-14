<?php
class Database {

	const USERNAME = '‪mmmymailer@gmail.com';
	const PASSWORD = '0104052698yy';

	private $host = 'localhost';
	private $user = 'root';
	private $pswd = '';
	private $dbName = 'mwallet';
	private $option = array(

		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
		);
	
	public $conn;

	public function __construct(){

		
		try{

			$dsn = 'mysql:host='. $this->host . ';dbname=' . $this->dbName;

			$this->conn = new PDO($dsn,$this->user, $this->pswd,$this->option); // $this-> conn because its construt function
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

			

		}catch(PDOException $e) {

			echo 'Error:' . $e->getMessage();

		}

		return $this->conn;

	}

	// checking inputs function
	public function test_input($data){

		$data = trim($data);
		$data = stripcslashes($data);
		$data = htmlspecialchars($data);

		return $data;



	}



	// Error Success Message Alert

	public function showMessage($type,$message){


		return '<div class="alert alert-'.$type.' alert-dismissible">

		<button type="button" class="close" 
		data-dismiss="alert">&times; </button>

		<strong class="text-center">'.$message.'</strong>		



	</div>';



}



}



?>