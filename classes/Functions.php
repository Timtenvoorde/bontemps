<?php
class Functions extends database {

	public function __construct() {
		parent::__construct("sql7142634", "sql7.freemysqlhosting.net", "zwfcyFrGfd", "sql7142634");
		$this->getConnection();
	}

	public function getTafels(){
		$res = $this->dbh->query("SELECT t.tafel_id, t.aantal_plekken, t.beschikbaarheid, r.eindtijd, r.begintijd FROM tafels AS t
									LEFT JOIN reserveringen AS r
									ON t.tafel_id = r.tafel_id
									ORDER BY t.tafel_id");
		if($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				$text_array[] = $row;
			}
			return $text_array;
		}
	}

	public function getInfo($tafel_id){
		$res = $this->dbh->query("SELECT k.klant_id, k.naam, k.adres, k.postcode, k.woonplaats, k.telefoonnummer, k.emailadres, r.reservering_id, r.klant_id, r.tafel_id, r.begintijd, r.eindtijd, rm.reserveringmenu_id, rm.menu_id, rm.aantal, m.menu_id, m.omschrijving, m.voorgerecht, m.hoofdgerecht, m.nagerecht, m.prijs FROM klanten AS k
			LEFT JOIN reserveringen AS r
			ON k.klant_id = r.klant_id
			LEFT JOIN reserveringmenu AS rm
			ON r.reservering_id = rm.reservering_id
			LEFT JOIN menus AS m
			ON rm.menu_id = m.menu_id
			WHERE r.tafel_id = $tafel_id
            ORDER BY k.klant_id");
		if($res->num_rows > 0) {
			while($row = $res->fetch_assoc()) {
				$text_array[] = $row;
			}
			return $text_array;
		}
	}
	

	public function insertKlant($naam, $adres, $postcode, $woonplaats, $telefoonnummer, $emailadres){
		$res = $this->dbh->query("INSERT INTO klanten (naam, adres, postcode, woonplaats, telefoonnummer, emailadres) VALUES ('$naam', '$adres', '$postcode', '$woonplaats', '$telefoonnummer', '$emailadres')");
	}

	public function insertReservering($klant_id, $tafel_id, $begintijd, $eindtijd){
		$res = $this->dbh->query("INSERT INTO reserveringen (klant_id, tafel_id, begintijd, eindtijd) VALUES ('$klant_id', '$tafel_id', '$begintijd', '$eindtijd')");
	}

	public function clearTafel($tafel_id){
		$res = $this->dbh->query("UPDATE reserveringen
									SET begintijd = '00:00:00', eindtijd = '00:00:00'
									WHERE tafel_id = '$tafel_id'");
	}


	public function resetTafel($tafel_id){
		$res = $this->dbh->query("UPDATE tafels
									SET beschikbaarheid = 0
									WHERE tafel_id = '$tafel_id'");
	}

	public function delReservering($tafel_id){
		$res = $this->dbh->query("DELETE FROM reserveringen
									WHERE tafel_id = '$tafel_id'");
	}

	public function setBeschikbaarheid($tafel_id){
		$res = $this->dbh->query("UPDATE tafels
									SET beschikbaarheid = 1
									WHERE tafel_id = '$tafel_id'");
	}

	public function getMenu_id(){
		$res = $this->dbh->query("SELECT menu_id FROM menus");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
	}
	return $text_array;
}
}
	public function getKlant_id(){
		$res = $this->dbh->query("SELECT klant_id FROM klanten ORDER BY klant_id DESC LIMIT 1");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
	}
	return $text_array;
}
}

	public function getEindtijd($tafel_id){
		$res = $this->dbh->query("SELECT eindtijd FROM reserveringen WHERE tafel_id = '$tafel_id'");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
	}
	return $text_array;
}
}
public function insertMenu($menu_id) {
		$res = $this->dbh->query("INSERT INTO reserveringmenu (menu_id) VALUES ('$menu_id')");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
	}
	return $text_array;
}
}

public function getMenu($id) {
		$res = $this->dbh->query("SELECT voorgerecht, hoofdgerecht, nagerecht, prijs FROM menus WHERE menu_id = '$id'");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
	}
	return $text_array;
}
}
	public function getTafelID($id){
		$res = $this->dbh->query("SELECT * FROM tafels WHERE tafel_id = '$id'");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
		}
		return $text_array;
	}
}

	public function getReserveringId($tafel_id){
		$res = $this->dbh->query("SELECT reservering_id FROM reserveringen WHERE tafel_id = '$tafel_id'");
		if ($res->num_rows > 0) {
		    while($row = $res->fetch_assoc()) {
		    	$text_array[] = $row;
	}
	return $text_array;
}
}


}

?>