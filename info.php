<html>
<?php
require_once 'core/init.php';
include_once 'includes/header.php';

if($user->isLoggedin()) {
	if(isset($_GET['id'])){

	$tafel_id = $_GET['id'];
?>
<body>
<center>
	<div class="container">
		<h1><a href="index.php"> Info tafel <?php echo $tafel_id; ?></a></h1>

		<?php
		$bontemps = new Functions();
		$bontemps->getInfo($tafel_id);
		($row = $bontemps->getInfo($tafel_id));
		
		foreach($row as $key => $value){
			?>
			<table class='table table-striped table-hover'>
				<thead>
					<tr>
						<th>#</th>
						<th>Naam</th>
						<th>Adres</th>
						<th>Postcode</th>
						<th>Woonplaats</th>
						<th>Telefoon</th>
						<th>Email</th>
						<th>Omschrijving</th>
						<th>Voorgerecht</th>
						<th>Hoofdgerecht</th>
						<th>Nagerecht</th>
						<th>Prijs</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><?php echo $value['tafel_id'] ?></td>
						<td><?php echo $value['naam'] ?></td>
						<td><?php echo $value['adres'] ?></td>
						<td><?php echo $value['postcode'] ?></td>
						<td><?php echo $value['woonplaats'] ?></td>
						<td><?php echo $value['telefoonnummer'] ?></td>
						<td><?php echo $value['emailadres'] ?></td>
						<td><?php echo $value['omschrijving'] ?></td>
						<td><?php echo $value['voorgerecht'] ?></td>
						<td><?php echo $value['hoofdgerecht'] ?></td>
						<td><?php echo $value['nagerecht'] ?></td>
						<td><?php echo $value['prijs'] ?></td>
					</tr>
				</tbody>
			</table>
			<?php
		}
	}
}
?>
</div>
</body>