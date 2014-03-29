<?php
class perfume_Template_Collection implements Iterator {
	
	protected $mapper;
	public $total = 0;
	protected $raw = array();
	
	protected $result;
	protected $pointer = 0;
	protected $objects = array();
	
	function __construct($user, $used) {
		$pdo = database::getInstance();
		//echo $user;
		if ($used) {
			$query = "select distinct perfume_Template.id as id from perfume_Template left join (perfume_Template as a join (select * from perfume_users where perfume_users.user_id = ?) as b on b.perfume = a.id) using (id) where b.perfume IS NULL;";
		}else { 
			$query = "select distinct perfume_Template.id as id from perfume_Template join perfume_users on perfume_users.perfume = perfume_Template.id where perfume_users.user_id = ?;";
		}
		$stmt = $pdo->prepare($query);
		if (!$stmt->execute(array($user))) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}
	
		while ($row = $stmt->fetch()) {
			//echo $row['perfume'];
			$this->objects[] = new perfume_Template($row['id']);
			$this->total = $this->total + 1;
	
	
		}
	
	}
	
	private function getObject($num) {
		return $this->objects[$num];
		//need to finish this function
	}
	
	public function valid() {
		return ( ! is_null($this->current()));
	}
	
	public function next() {
		$object = $this->getObject($this->pointer);
		if ($object) {$this->pointer++;}
		return $object;
	}
	
	public function current() {
		return $this->getObject($this->pointer);
	}
	
	public function rewind() {
		$this->pointer = 0;
	}
	
	public function key() {
		return $this->pointer;
	}
	
	public function jsonList() {
		$list = array();
		return $list;
	}
	
	public function getTotal() {
		return $this->total;
	}
}

?>