<html>
<?php
require_once 'core/init.php';
require_once 'includes/header.php';

if($user->isLoggedIn()) {

if(isset($_GET['id'])){
		$bontemps = new Functions();
		($row = $bontemps->getTafelID($_GET['id']));
		foreach($row as $key => $value){

?>
<head>   
</head>
<center>

<h1><a href="index.php">Bontemps</a></h1>
	<div></div>

	<form name="verstuur" method="POST" action="invoer.php">

	<table>
		<tbody>
			<tr> 
				<td>
					<label>Tafel:</label>
				</td> 
				<td> 
					<input type="text" name="tafel_id" value="<?php echo $value['tafel_id']; ?>"  readonly />
				</td> 
			</tr>
			<tr> 
				<td>
					<label>Aantal plekken:</label>
				</td> 
				<td> 
					<input type="text" name="aantal_plekken" value="<?php echo $value['aantal_plekken']; ?>"  readonly />
				</td> 
			</tr>
						<tr> 
				<td>
					<label>naam:</label>
				</td> 
				<td> 
					<input type="text" name="naam" required /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>adres:</label>
				</td> 
				<td> 
					<input type="text" name="adres" required /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>postcode:</label>
				</td> 
				<td> 
					<input type="text" name="postcode" required /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>woonplaats:</label>
				</td> 
				<td> 
					<input type="text" name="woonplaats" required /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>telefoonnummer:</label>
				</td> 
				<td> 
					<input type="text" name="telefoonnummer" required /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>emailadres:</label>
				</td> 
				<td> 
					<input type="text" name="emailadres" required /> 
				</td> 
			</tr>
			<tr> 
				<td>  
					<label>begintijd:</label>
				</td>
				<td> 
					<input type="text" name="begintijd" required /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>eindtijd:</label>
				</td> 
				<td> 
					<input type="text" name="eindtijd" required /> 
				</td> 
			</tr>
				<p><input type="submit" value="Verzenden" name="verstuur"></p>
			</tbody></table></form>

				
<?php
}
}

if(isset($_POST['verstuur'])) {

	$naam = $_POST['naam'];
	$adres = $_POST['adres'];
	$postcode = $_POST['postcode'];
	$woonplaats = $_POST['woonplaats'];
	$telefoonnummer = $_POST['telefoonnummer'];
	$emailadres = $_POST['emailadres'];

	$tafel_id = $_POST['tafel_id'];
	$begintijd = $_POST['begintijd'];
	$eindtijd = $_POST['eindtijd'];

$bontemps = new Functions();
$bontemps->insertKlant($naam, $adres, $postcode, $woonplaats, $telefoonnummer, $emailadres);

$row = $bontemps->getKlant_id();
foreach($row as $key => $value)
					{ 
						$klant_id = $value['klant_id'];
					}
$bontemps->insertReservering($klant_id, $tafel_id, $begintijd, $eindtijd);

header('Refresh: 1; url=menus.php?id=' . $tafel_id . '');

}
}
?>
</html>