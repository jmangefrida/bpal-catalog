<?php

//namespace classes;

/**
 *
 * @author jim
 *        
 */
class category {
	// TODO - Insert your code here
	public $id;
	public $name;
	
	function __construct($id) {
	
		if ($id == '') {
			exit();
		}
		$pdo = database::getInstance();
		$query = "select * from category where id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array($id));
		$row = $stmt->fetch();
		if (!$row) {
			//throw new Exception();
			return false;
		}
		$this->id = $row['id'];
		$this->name = stripslashes($row['name']);
	}
	
	public static function confirm($id) {
		$pdo = database::getInstance();
		$query = "select count(id) as confirmed from category where id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array());
		$row = $stmt->fetch();
		$result = $row['confirmed'];
		if ($result == 1) {
			return true;
		}else {
			return FALSE;
		}
		
	}
	
	public static function doesCategoryExist($name) {
		$pdo = database::getInstance();
		$query = "select id from category where name = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array($name));
		$row = $stmt->fetch();
		if (empty($row)) {
			return false;
		}else {
			return true;
		}
	}
	
	public static function createCategory($name) {
		if (self::doesCategoryExist($name)) {
			return false;
		}
		
		$pdo = database::getInstance();
		$query = "insert into category (id, name) values('',?)";
		$stmt = $pdo->prepare($query);
		if (! $stmt->execute(array($name))) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}
		return true;
	}
	
	public static function updateCategory($id, $name){
		$pdo = database::getInstance();
		$query = "update category set name = ? where id = ?";
		$stmt = $pdo->prepare($query);
		if (! $stmt->execute(array($name, $id))) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}
		return true;
	}
	
	public function toJSON() {
	
		//$output = array('id' => $this->getId(), 'name' => $this->getName(), );
		$output = get_object_vars($this);
		return json_encode($output);
	}
	
}

?>