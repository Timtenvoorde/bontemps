<?php

class Database {

	private $dbname;
	private $dbhost;
	private $dbpass;
	private $dbuser;
	protected $dbh; // database host

	public function __construct($dbname, $dbhost, $dbpass, $dbuser) {

		$this->dbname = $dbname;
		$this->dbhost = $dbhost;
		$this->dbpass = $dbpass;
		$this->dbuser = $dbuser;
	}

	public function getConnection() {

		$this->dbh = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);

		if ($this->dbh->connect_error) {
			die("Geen connectie gevonden: " . $this->dbh->connect_error);
		}
	}
}

$database = new Database("bontemps", "localhost", "", "root");
$database->getConnection();

?>