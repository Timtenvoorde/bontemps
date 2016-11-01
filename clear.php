<?php
require_once 'core/init.php';
require_once 'includes/header.php';

		if(isset($_GET['id'])){
		$tafel_id = $_GET['id'];
		$bontemps = new Functions();
		$bontemps->clearTafel($tafel_id);
		$bontemps->delReservering($tafel_id);
		header('location:index.php');
}
		?>