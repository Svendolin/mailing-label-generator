<?php
// Adresseingaben und Adressliste sowie GOOGLE MAPS API Zugang
session_start();

// Diese Seite ist nur im EINGELOGGTEN ZUSTAND sichtbar!
if (!isset($_SESSION['useruid'])) {
  header("location: logreg.php");
  exit();
}

/* LESEFILE = READ */
require('prefs/credentials.php');
require('class/menu.class.php');
// Instanz der Subklasse
$myInstance = new SimpleCRUD($host,$user,$passwd,$dbname);
// INstanz 
$recordArray = $myInstance -> readMethod();

?>

<!---------- Header + Navigation ---------------------------------------------------------------------------------------->
<?php
include('includes/html/header.html.php');
?>
<!-----x---- Header + Navigation ----x----------------------------------------------------------------------------------->


<?php

// Checke, ob der Submit-Button geklickt wurde
if (isset($_POST['go'])) {
	// ja
	// Hier müssten unbedingt Sicherheitsvorkehrungen getroffen werden...
	$vornameValue = $_POST['vorname'];
	$nachnameValue = $_POST['nachname'];
	$emailAdresseValue = $_POST['emailAdresse'];
	//$ortValue = $_POST['ort'];
	$bemerkungenValue = $_POST['bemerkungen'];
	
	// Methode aufrufen, createMethod(sowie die passenden Variablen aus $query)
	$lastID = $myInstance -> createMethod($vornameValue,$nachnameValue,$emailAdresseValue,$bemerkungenValue);
	
	echo "<div class=\"feedback_positiv\">";
	echo "Der Datensatz wurde aufgenommen. Die ID des eingefügten Datensatzes ist ".$lastID;
	echo "</div>\n";
	
}
else {
	// nein, setzte die Variablen leer, damit beim ersten Affenschwanz-Durchgang kein Fehler generiert wird
	$vornameValue = "";
	$nachnameValue = "";
	$emailAdresseValue = "";
	// $ortValue = "";
	$bemerkungenValue = "";
}
?>

<hr>
	<p class="explanation">
		<a href="read.php"><strong>R</strong>ead</a> | 
		<a href="read_erweitert.php">Read erweitert</a>
	</p>
	<hr>

	<form action="menu.php" method="post">
		<div>
			<label for="vorname">Vorname:</label><br>
			<input type="text" id="vorname" name="vorname" value="<?=$vornameValue?>">
		</div>
		<br>
		<div>
			<label for="nachname">Nachname:</label><br>
			<input type="text" id="nachname" name="nachname" value="<?=$nachnameValue?>">
		</div>
		<br>
		<div>
			<label for="emailAdresse">E-Mail-Adresse:</label><br>
			<input type="email" id="emailAdresse" name="emailAdresse" value="<?=$emailAdresseValue?>">
		</div>
		<br>
		<div>
		<!-- <div>
			<label for="ort">Ort:</label><br>
			<input type="text" id="ort" name="ort" value="">
		</div> -->
		<!-- <br> -->
		<div>
			<label for="bemerkungen">Bemerkungen:</label><br>
			<textarea id="bemerkungen" name="bemerkungen" cols="50" rows="6"><?=$bemerkungenValue?></textarea>
		</div>
		<button type="submit" name="go">Datensatz speichern</button>
	</form>

  <?php foreach ($recordArray as $row): ?>
		<p class="explanation">
			<?=$row['vorname']?> <strong><?=$row['nachname']?></strong> (ID: <?=$row['ID']?>)<br>
 			<a href="mailto:<?=$row['email']?>"><?=$row['email']?></a>
			 <br>
			 <!-- Ort: <=$row['ort']?><br> -->
 		</p>
 		<p class="explanation"><?=nl2br($row['bemerkungen'])?></p> <!-- New line to break = nl2br = Neuer Zeilenumbruch darstellen -->
 		<hr>
 	<?php endforeach; ?>


<!---------- footer ----------------------------------------------------------------------------------------------------->
<?php
include('includes/html/footer.html.php');
?>
<!-----x---- footer ----x------------------------------------------------------------------------------------------------>