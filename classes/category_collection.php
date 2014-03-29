<?php

class category_collection implements Iterator {
	protected $mapper;
	public $total = 0;
	protected $raw = array();
	
	protected $result;
	protected $pointer = 0;
	protected $objects = array();
	
	function __construct() {
		$pdo = database::getInstance();
		$query = "select * from category";
		$stmt = $pdo->prepare($query);
		if (!$stmt->execute()) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}
		
		while ($row = $stmt->fetch()) {
			//echo $row['perfume'];
			$this->objects[] = new category($row{id});
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