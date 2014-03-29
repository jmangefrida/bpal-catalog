<?php

//namespace classes;

// The Database class represents our global DB connection
class database extends PDO {
	// A static variable to hold our single instance
	private static $_instance = null;
	
	// Make the constructor private to ensure singleton
	function __construct()
	{
		// Call the PDO constructor
		parent::__construct('mysql:host=localhost;dbname=bpal2', 'bpal', 'Bpal!');
	}
	
	// A method to get our singleton instance
	public static function getInstance()
	{
		if (!(self::$_instance instanceof Database)) {
			self::$_instance = new Database();
		}
	
		return self::$_instance;
	}
}

?>