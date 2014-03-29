<?php

//namespace classes;

class user {
	protected $id;
	protected $username;
	protected $password;


/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $username
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param mixed $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

public static function login( $id, $password) {

	$pdo=database::getInstance();

	$query = "select id from users where username = ? and password = md5( ? )";
	$stmt = $pdo->prepare($query);

	if (! $stmt->execute( array($id, $password))) {
	$error=$stmt->errorInfo();
	die( "failed: " . $error[2]);
	}

	$row = $stmt->fetch();

	if (empty($row)) {
		
	return false;
			
	}else{
		$user = new user($row['id']);
		return $user;
		}
}

function __construct($id) {
	
	if (is_null($id)) {
		$error = 'No ID given';
    	throw new Exception($error);
		
	}
	
	$pdo = database::getInstance();
	$query = "select * from users where id = ?";
	$stmt = $pdo->prepare($query);
	$stmt->execute(array($id));
	$row = $stmt->fetch();
	if (!$row) {
		//throw new Exception();
		return false;
	}
	$this->id     = $row['id'];
	$this->username     = $row['username'];
	
}

}
?>