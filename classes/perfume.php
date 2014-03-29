<?php

//namespace classes;

/**
 *
 * @author jim
 *        
 */

//use classes\perfume;

/**
 *
 * @author jim
 *        
 */
class perfume {
	// TODO - Get rid of perfumeId
	protected $id;
	protected $rating;
	protected $status;
	protected $imps;
	protected $bottles;
	protected $location;
	protected $notes;
	//protected $perfumeId;
	protected $name;
	protected $category;
	protected $picture;
	protected $description;
	protected $discontinued;
	
	public function getId() {
		return $this->id;
	}

	public function getRating() {
		return $this->rating;
	}

	public function getStatus() {
		return $this->status;
	}

	public function getImps() {
		return $this->imps;
	}

	public function getBottles() {
		return $this->bottles;
	}

	public function getLocation() {
		return $this->location;
	}

	public function getNotes() {
		return $this->notes;
	}

	public function setId($id) {
		$this->id = $id;
	}

	public function setRating($rating) {
		$this->rating = $rating;
	}

	public function setStatus($status) {
		$this->status = $status;
	}

	public function setImps($imps) {
		$this->imps = $imps;
	}

	public function setBottles($bottles) {
		$this->bottles = $bottles;
	}

	public function setLocation($location) {
		$this->location = $location;
	}

	public function setNotes($notes) {
		$this->notes = $notes;
	}
	
	
	/**
	 * @return the $discontinued
	 */
	public function getDiscontinued() {
		return $this->discontinued;
	}
	
	/**
	 * @param field_type $discontinued
	 */
	public function setDiscontinued($discontinued) {
		$this->discontinued = $discontinued;
	}
	
	/**
	 * @return the $perfumeId
	 */
	public function getPerfumeId() {
		return $this->perfumeId;
	}
	
	/**
	 * @return the $name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @return the $category
	 */
	public function getCategory() {
		return $this->category;
	}
	
	public function getCategoryName() {
		return $this->category->name;
	}
	
	/**
	 * @return the $picture
	 */
	public function getPicture() {
		return $this->picture;
	}
	
	/**
	 * @return the $description
	 */
	public function getDescription() {
		return $this->description;
	}
	
// 	/**
// 	 * @param field_type $perfumeId
// 	 */
// 	public function setPerfumeId($perfumeId) {
// 		$this->perfumeId = $perfumeId;
// 	}
	
	/**
	 * @param field_type $name
	 */
	public function setName($name) {
		$this->name = $name;
	}
	
	/**
	 * @param field_type $category
	 */
	public function setCategory($category) {
		$this->category = $category;
	}
	
	/**
	 * @param field_type $picture
	 */
	public function setPicture($picture) {
		$this->picture = $picture;
	}
	
	/**
	 * @param field_type $description
	 */
	public function setDescription($description) {
		$this->description = $description;
	}
	
	
	public function toJSON() {
		
		//$output = array('id' => $this->getId(), 'name' => $this->getName(), );
		$output = get_object_vars($this);
		return json_encode($output);
	}

	/**
	 */
	public function __construct($id) {
		
		if ($id == "") {
			exit();
		}
//		parent::__construct ($perfume_id);
		
		//echo "test";
		
		$pdo = database::getInstance();
		$query = "select * from perfume where id = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array($id));
		$row = $stmt->fetch();
		if (!$row) {
			//throw new Exception();
			return false;
		}
		$this->id = $row['id'];
		//$this->category = $row['category_id'];
		$this->category = new category($row['category_id']);
		$this->name = $row['name'];
		$this->picture = $row['picture'];
		$this->description = $row['description'];
		$this->discontinued = $row['discontinued'];
		$this->rating = $row['rating'];
		$this->status = stripslashes($row['status']);
		$this->imps = $row['imps'];
		$this->bottles = $row['bottles'];
		$this->location = stripslashes($row['location']);
		$this->notes = stripslashes($row['notes']);
		// TODO - Insert your code here
	}
	
	public static function doesPerfumeExist($name) {
		$pdo = database::getInstance();
		$query = "select id from perfume where name = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array($name));
		$row = $stmt->fetch();
		if (empty($row)) {
			return false;
		}else {
			return true;
		}
	}
	
	public static function createPerfume( $category, $name, $description, $discontinued, $rating, $imps, $bottles, $status, $location, $notes) {
		if (self::doesPerfumeExist($name)) {
			return false;
		}
		$pdo = database::getInstance();
		$query = "insert into perfume (category_id, name, description, discontinued, rating, imps, bottles, status, location, notes) values(?,?,?,?,?,?,?,?,?,?)";
		$stmt = $pdo->prepare($query);
		if (! $stmt->execute(array($category, $name, $description, $discontinued, $rating, $imps, $bottles, $status, $location, $notes))) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}
	
		$query = "select id from perfume where name = ?";
		$stmt = $pdo->prepare($query);
		$stmt->execute(array($name));
		$row = $stmt->fetch();
		if (!$row) {
			//throw new Exception();
			return false;
		}
		
		$perfumeInstance = new perfume($row['id']);
		return $perfumeInstance;
	}
	
	public static function updatePerfume($id, $category, $name, $description, $discontinued, $rating, $imps, $bottles, $status, $location, $notes) {
// 		if (self::doesPerfumeExist($perfume, $user)) {
// 			return false;
// 		}
		$pdo = database::getInstance();
		$query = "update perfume set category_id = ?, name = ?, description = ?, discontinued = ?, rating = ?, imps = ?, bottles = ?, status = ?, location = ?, notes =? where id = ?";
		$stmt = $pdo->prepare($query);
		if (! $stmt->execute(array($category, $name, $description, $discontinued, $rating, $imps, $bottles, $status, $location, $notes, $id))) {
			$error=$stmt->errorInfo();
			die( "failed: " . $error[2]);
		}
	
		$perfumeInstance = new perfume($id);
		return $perfumeInstance;
	}
	
}



?>