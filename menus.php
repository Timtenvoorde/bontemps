<html>
<center>
<?php

require_once 'core/init.php';
include_once 'includes/header.php';


if(isset($_GET['id'])){
		$bontemps = new Functions();

$tafel_id = $_GET['id'];

?>
 		<h1><a href="index.php">Menu's</a></h1>
			<table>
			<form>
				<tr> 
				<td>
					<label>Menu:</label>
				</td> 
				<td> 

				<form method="post" action="menus.php">	
					<select name="menus">
						<?php
							$row = $bontemps->getMenu_id();

							foreach($row as $key => $value)
							{
								echo"
							<option value=" . $value['menu_id'] . ">" . $value['menu_id'] . "</option>
							";
							$menu_id = $value['menu_id'];
							}


						?>
					  
					</select>
					<input type="submit" value="kies">
				 </form>
				 </td>

<?php
}
if(isset($_GET['menus'])){
			$menu_id = $_GET['menus'];

	$bontemps = new Functions();
	$row = $bontemps->getMenu($menu_id);

	foreach($row as $key => $value)
	{


?>

		<center>


		<h1><a href="index.php">Menu's</a></h1>
			<table>
					<tr> 
				<td>
					<label>Voorgerecht:</label>
				</td> 
				<td> 
					<input type="text" name="voorgerecht" value="<?php echo $value['voorgerecht']; ?>" readonly />
				</td> 
			</tr> 
			<tr> 
				<td>
					<label>Hoofdgerecht:</label>
				</td> 
				<td> 
					<input type="text" name="hoofdgerecht" value="<?php echo $value['hoofdgerecht']; ?>" readonly /> 
				</td> 
			</tr>
			<tr>
			<tr> 
				<td>
					<label>Nagerecht:</label>
				</td> 
				<td> 
					<input type="text" name="nagerecht" value="<?php echo $value['nagerecht']; ?>" readonly /> 
				</td> 
			</tr>
			<tr> 
				<td>
					<label>Prijs:</label>
				</td> 
				<td> 
					<input type="text" name="prijs" value="<?php echo $value['prijs']; ?>" readonly /> 
				</td> 
			</tr>
		</tbody>
	</table>
		
		
	</form>
	</center>
<?php
}
if(isset($_POST['verstuur'])) {
	$voorgerecht = $_POST['voorgerecht'];
	$hoofdgerecht = $_POST['hoofdgerecht'];
	$nagerecht = $_POST['nagerecht'];
	$prijs = $_POST['prijs'];

}
}
?>
	</center>
</html>