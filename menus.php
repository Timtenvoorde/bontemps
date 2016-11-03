<html>
<center>
<?php
require_once 'core/init.php';
include_once 'includes/header.php';

if(isset($_GET['id'])){
		$bontemps = new Functions();
		$res_id = $_GET['id'];
		echo "wajoooo" . $res_id;
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
				<input type="hidden" name="res_id" value="<?php echo $res_id; ?>">
					<input type="submit" value="kieks">
				 </form>
				 </td>
<?php
}

if(isset($_GET['menus'])) {
	$menu_id = $_GET['menus'];

	$bontemps = new Functions();
	$row = $bontemps->getMenu($menu_id);

	foreach($row as $key => $value)
	{
?>
		<center>
		<h1><a href="index.php">Menu's</a></h1>
		<form name="kies" method="POST" action="">
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
			<p><input type="submit" value="Kies" name="kies"></p>
		</tbody>
	</table>
		<input type="hidden" name="res_id" value="<?php echo $res_id; ?>">
	</form>
	</center>
<?php
	}
}
$res_id = $_GET['reservering_id'];

if(isset($_POST['kies'])) {
	echo $res_id;
	echo "MOOIIIIII $res_id";
	}
?>
	</center>
</html>