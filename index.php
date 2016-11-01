<?php
require_once 'core/init.php';
include_once 'includes/header.php';
?>
<center>
<div class="container">
<?php

?>
<style>
		#green {
			background-color: green;
		}
	
		#red {
			background-color: red;
		}

		.green{color:green;}
 
		h1 {
			font-size:3em;
			font-weight:bold;
			font-family:Arial, Helvetica, sans-serif;
		}
 
</style>
<?php
	if(Session::exists('home')) {
		echo Session::flash('home');
	}

	if($user->isLoggedIn()) {

		if($user->hasPermission('admin')) {
			  echo 'wajo <div id="tableHolder"></div>';
			}
		}
	?>
</div>