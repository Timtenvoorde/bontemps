<?php
require_once 'core/init.php';

echo '
	<table class="table table-striped table-hover">
		<thead>
			<tr>
				 <th>#</th>
				 <th>Plekken</th>
				 <th>Beschikbaarheid</th>
				 <th></th>
				 <th>Geboekt vanaf</th>
				 <th>Beschikbaar over</th>
				 <th>Info</th>
				 <th>Clear</th>
			</tr>
		</thead>
		<tbody>
	';

$bontemps = new Functions();
$row = $bontemps->getTafels();

foreach($row as $key => $value)
{
	$tafel_id = $value['tafel_id'];
	$aantal_plekken = $value['aantal_plekken'];
	$beschikbaarheid = $value['beschikbaarheid'];
	$eindtijd = $value['eindtijd'];
	$begintijd = $value['begintijd'];

	echo 
		"<tr>
		 	<td><center>" . $tafel_id . "</td>
		 	<td><center>" . $aantal_plekken . "</td>";
		 	if($beschikbaarheid < 1) {

			 	echo "<td class='success'><center>Beschikbaar</td>
			 	<td>
			 	<a href='invoer.php?id=" . $tafel_id . "'><button type='button'>Kies</button></a></td>";

			 	if($begintijd <= 0){
			 		echo"<td>vrij</td>";
			 	}
		 	}

		 	else if($beschikbaarheid >= 1){
		 		echo "<td class='danger'><center>Niet beschikbaar</td>
		 		<td><button onclick='myFunction()'>Kies</button>

		 		<script>
					function myFunction() {
					    alert('Deze tafel is niet beschikbaar!');
					}
					</script></td>
					<td>" . $begintijd . " tot " . $eindtijd . "</td>";


						$time = strtotime($eindtijd);

						$remaining = $time - time();
						$days_remaining = floor($remaining / 86400);
						$hours_remaining = floor(($remaining % 86400) / 3600);
						$min = floor(($remaining % 3600) / 60);
						$sec = ($remaining % 60);
						
					echo "<td> " . $hours_remaining . " uur " .  $min . " minuten " .  $sec . " seconden</td>";
					if($min <= 0){
						if($sec <= 0){
						$bontemps = new Functions();
						$bontemps->resetTafel($tafel_id);
						$bontemps->delReservering($tafel_id);
						}
					}

				echo "
					<td><a href='info.php?id=" . $tafel_id . "'><span class='label label-default'>Info</span></a>
					<td><a href='clear.php?id=" . $tafel_id . "'><span class='label label-default'>Clear</span></a>";
		 		}
	}
	echo '</tbody>';

?>