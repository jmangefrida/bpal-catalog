<?php
class perfume_Collection implements Iterator {
	protected $mapper;
	public $total = 0;
	protected $raw = array();

	protected $result;
	protected $pointer = 0;
	protected $objects = array();

	function __construct($swap, $discontinued) {
		$pdo = database::getInstance();
		//echo $user;
		if ($swap == true) {
			$where = " where perfume.status = '1'";
		} elseif ($discontinued == true) {
			$where = " where perfume.discontinued = 1";
		}
		
		if ($swap == true && $discontinued == true) {
			$where = " where perfume.status = '1' and perfume.discontinued = 1";
		}
		
		$query = "select perfume.id from perfume join category on (category_id = category.id) " . $where . " order by category.name asc, perfume.name asc";

		$stmt = $pdo->prepare($query);
		if (!$stmt->execute(array())) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}

		while ($row = $stmt->fetch()) {
			//echo $row['perfume'];
			$this->objects[] = new perfume($row['id']);
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
	
	public function sortCategory() {
		
		//$this->sortName();
		usort($this->objects,array(perfume_Collection,'cmpCategory'));
	}
	
	function cmpCategory( $a, $b )
	{
		//$aCat = $a->getCategory();
		//$bCat = $b->getCategory();
		//echo $a->getCategoryName();
		if( $a->getCategoryName() == $b->getCategoryName() ){ return 0 ; }
		return ($a->getCategoryName() < $b->getCategoryName() ) ? -1 : 1;
	}
	
	function sortName() {
		usort($this->objects,array(perfume_Collection,'cmpName'));
	}
	
	function cmpName( $a, $b) {
		if( $a->getName() == $b->getName() ){ return 0 ; }
		return ($a->getName() < $b->getName() ) ? -1 : 1;
	}
	
	function sortRating() {
		usort($this->objects,array(perfume_Collection,'cmpRating'));
	}
	
	function cmpRating($a, $b) {
		if( $a->getRating() == $b->getRating() ){ return 0 ; }
		return ($a->getRating() < $b->getRating() ) ? -1 : 1;
	}
	
	
}

?>