<?php


class Post{
	private $conn;
	private $table='mem';

	public $NO;
	public $Account;
	public $Password;
	public $New_Password;

	public function __construct($db){
		$this->conn= $db;
	}

	public function read(){
		$query="SELECT * FROM `$this->table`";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		return $stmt;
	}

	public function read_single(){ 
		$query='SELECT * FROM '.$this->table.' WHERE NO= ? AND Password= ? LIMIT 1';
		$stmt=$this->conn->prepare($query);

		$stmt->bindParam(1, $this->NO);
		$stmt->bindParam(2, $this->Password);
		$stmt->execute();

		$row=$stmt->fetch(PDO::FETCH_ASSOC);
		$this->NO=$row['NO'];
		$this->Account=$row['Account'];
		$this->Password=$row['Password'];


	}

	public function login_check(){ 
		$val_account= $this->Account;
		$val_password= $this->Password;
		$mark='';
		$query="SELECT * FROM `$this->table` WHERE Account='$val_account'";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$result=$stmt;
		while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
			if ($row['Account']==$val_account) {
				$Real_Account=$row['Account'];
				$Real_password=$row['Password'];
				$mark='Correct';
			}
			else{
				$mark='NULL';
			}
		}
		if ($mark =='Correct') {
			if($val_account != null && $val_password != null && $val_account == $Real_Account && $val_password  == $Real_password){	
				//printf('Correct');
				return true;
			}
			else{
				printf('Wrong password');		
			}
		}
		else{
			printf('Wrong account');	
		}
	}


	public function create(){
		$val= $this->Account;
		$mark=0;
		$query="SELECT * FROM `$this->table`";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$result=$stmt;
		while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
			if ($row['Account']==$val) {
				printf('Same Account !!');
				$mark=$mark+1;
			}
		}
		if ($mark=='0') {
			$query='INSERT INTO '.$this->table.' SET Account = :Account,Password = :Password';
			$stmt=$this->conn->prepare($query);
			$this->Account=htmlspecialchars(strip_tags($this->Account));//show code symbol  ( remove code symbol() )
			$this->Password=htmlspecialchars(strip_tags($this->Password));

			$stmt->bindParam(':Account',$this->Account);
			$stmt->bindParam(':Password',$this->Password);

			if ($stmt->execute()) {
				return true;
			}
			printf('error in create function',$stmt->error);
			return false;
		}	
	}

	public function update(){
		//check same account
		$val= $this->Account;
		$val_password= $this->Password;

		$mark=0;
		$query="SELECT * FROM `$this->table`";
		$stmt=$this->conn->prepare($query);
		$stmt->execute();
		$result=$stmt;
		while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
			if ($row['Account']==$val) {
				$mark=$mark+1;
			}
		}
		// have this account
		$pass_isok=0;
		if ($mark>'0') {
			//check password
			$query="SELECT * FROM `$this->table` WHERE `Account`='$val' ";
			$stmt=$this->conn->prepare($query);
			$stmt->execute();
			$result=$stmt;
			while ($row=$result->fetch(PDO::FETCH_ASSOC)) {
				if ($row['Password']==$val_password) {
					$pass_isok=$pass_isok+1;
				}
			}

			if ($pass_isok==1) {//password is coorect

				//$query='UPDATE '.$this->table.' SET Account = :Account,Password = :Password WHERE `NO` = :NO';
				$query='UPDATE '.$this->table.' SET Password = :New_Password WHERE  `Account` = :Account';
				$stmt=$this->conn->prepare($query);
				//clean
				$this->Account=htmlspecialchars(strip_tags($this->Account));//show code symbol  ( remove code symbol() )
				$this->New_Password=htmlspecialchars(strip_tags($this->New_Password));
				//$this->NO=htmlspecialchars(strip_tags($this->NO));

				$stmt->bindParam(':Account',$this->Account);
				$stmt->bindParam(':New_Password',$this->New_Password);
				//$stmt->bindParam(':NO',$this->NO);

				if ($stmt->execute()) {
					return true;
				}
				//function error
				printf('error in update function',$stmt->error);
				return false;

			}else{//password is wrong
				printf('password is wrong');
				return false;
			}

		}else{
			printf('No this Account!');
			return false;
		}
	}

	public function remove(){
		$query='DELETE FROM ' .$this->table. ' WHERE `Account` = :Account';
		$stmt=$this->conn->prepare($query);
		//clean
		$this->Account=htmlspecialchars(strip_tags($this->Account));
		$stmt->bindParam(':Account',$this->Account);

		if ($stmt->execute()) {
			return true;
		}
		printf('error in remove function',$stmt->error);
		return false;
	}


}


?>